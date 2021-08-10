<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expensive;
use App\Models\ExpensiveDetail;
use App\Models\Budget;
use App\Models\Rounting;
use App\Models\RountingStatus;
use App\Models\Views\ViewExpenseDetail;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Auth;
use DataTables;
use DB;
use PDF;

class EmpManageExpensesController extends Controller
{
    /**
     * get submitted expenses by empoyeefor approval
     *
     */
    public function getSubmitedExpenseByEmployee(Request $request)
    {

        $expenses = (new Expensive())->getSubmitedExpensesForApproval(Auth::user()->id);
        //echo "<pre>"; print_r($expenses->toArray()); die('d');
        if ($request->ajax()) {
            $expenses = (new Expensive())->getSubmitedExpensesForApproval(Auth::user()->id)->toArray();
            return Datatables::of($expenses)
                ->addIndexColumn()
                ->addColumn('employee', function ($row) {
                    return $row['employee']['name'];
                })
                ->addColumn('expenseId', function ($row) {
                    return '<a title="View expenses" href="' . route('expenses.expenses_detail_by_employee',  $row['id']) . '">' . $row['id'] . '</a>';
                })

                ->addColumn('financialYear', function ($row) {
                    return $row['financial_year']['year'];
                })
                ->addColumn('budgetType', function ($row) {
                    return $row['budget_type']['name'];
                })
                ->addColumn('costCenter', function ($row) {
                    return $row['cost_center']['name'];
                })

                ->addColumn('projectCode', function ($row) {
                    return $row['project_code']['code'];
                })

                ->addColumn('budgetAmt', function ($row) {
                    return IND_money_format($row['budget_sum']['budget_amount']);
                })
               /*  ->addColumn('budgetAmt', function ($row) {
                    return IND_money_format($row['budget_amount']);
                }) */


                /* ->addColumn('expense_amount', function ($row) {
                    return IND_money_format($row['expense_amount']);
                }) */
                /* ->addColumn('expense_amount', function ($row) {
                    return IND_money_format($row['submitted_expenses_sum']['expense_amount']);
                }) */

                ->addColumn('expensesSum', function ($row) {
                    return IND_money_format($row['expenses_sum']['expensive_amount']);
                })

               /*  ->addColumn('balance', function ($row) {
                    return IND_money_format($row['balance']);
                }) */


                ->addColumn('balance', function ($row) {
                    return IND_money_format($row['budget_sum']['budget_amount']-$row['submitted_expenses_sum']['expense_amount']);
                })

                ->addColumn('status', function ($row) {
                    if ($row['approval_status'] == 0) {
                        $status =  'Pending';
                    } elseif ($row['approval_status'] == 1) {
                        $status =  'Approved';
                    } else {
                        $status =  'Rejected';
                    }
                    return $status;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a title="View expenses" href="' . route('expenses.expenses_detail_by_employee',  $row['id']) . '" class="edit"><i class="fas fa-eye" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['expenseId', 'budgetAmt', 'employee', 'costCenter', 'status', 'expenseCode', 'financialYear', 'action'])
                ->make(true);
        }
        return view('employee.submited-expenses.listing', ['active' => 'submited-expenses-by-employee']);
    }

    /**
     * get detail of submitted expenses by empoyee
     *
     */
    public function getSubmitedExpenses($id)
    {
        $expenses = (new Expensive())->getSubmitedExpensesForApproval($id, Auth::user()->id);
        return view('employee.submited-expenses.rounting-status-listing', ['expenses' => $expenses, 'active' => 'submited-expenses-by-employee']);
    }

    /**
     * get detail of submitted expenses by empoyee
     *
     */
    public function expensesDetailByEmployee($id)
    {
        $expensDetails = ViewExpenseDetail::get()->toArray();
        $expense = (new Expensive())->getExpensesDetailForApproval($id);
        $rounting = RountingStatus::with(array('rejectedBy'))->where(array('approver_id' => Auth::user()->id, 'expense_id' => $id))->first();
        return view('employee.submited-expenses.expense-detail', ['expense' => $expense, 'expensDetails' => $expensDetails, 'rounting' => $rounting, 'active' => 'submited-expenses-by-employee']);
    }

    /**
     * approve expense
     */
    public function approveExpenses(Request $request)
    {
        $inputs = $request->all();
        $expData= ExpensiveDetail::where(array('expensive_id'=>$inputs['id']))->select('budget_amt','expense_balance',DB::raw("SUM(expensive_amount) as expensive_amount"))->first()->toArray();
        $reason = isset($inputs['reason']) ? $inputs['reason']: NULL;
        $expense = RountingStatus::where(array('expense_id' => $inputs['id'], 'approval_status' => 0, 'approver_id' => Auth::user()->id))->first();
        $originatorId=$expense->originator_id;

        $nextLevel = $expense->level + 1;

        if ($expense->expense_amount <= $expense->maximum_amount) {
            Expensive::where(array('id' => $inputs['id']))->update(array('is_approved' => 1));
            $expense->update(array('approval_status' => 1,'reason'=>$reason));
            flash()->success('Expense approved successfully');
            return response()->json(['success' => true]);
        }

        $rounting = Rounting::where(array('level' => $nextLevel,'employee_id'=>$originatorId))->first();

        if ($rounting) {
            $user = User::where(array('id'=>$rounting->manager_id))->first();
                // submit to next level

            $data['expense_id'] = $inputs['id'];
            $data['originator_id'] = $expense->originator_id;
            $data['expense_amount'] = $expense->expense_amount;
            $data['subimtted_by'] = Auth::user()->id;
            $data['approver_id'] = $rounting->manager_id;
            $data['level'] = $rounting->level;
            $data['maximum_amount'] = $rounting->maximum_amount;
            $data['approval_status'] = 0;
            (new RountingStatus())->addForApproval($data);
            $expense->update(array('approval_status' => 1,'reason'=>$reason));
            $emailData = ['email'=>$user->email,'receiver'=>$user->name,'sender'=>Auth::user()->name,'budget'=>$expData['budget_amt'],'submission'=>$expData['expensive_amount'], 'balance'=>$expData['expense_balance']];
            dispatch(new SendEmailJob($emailData));
            flash()->success('Expense approved successfully');
            return response()->json(['success' => true]);
        } else {

            Expensive::where(array('id' => $inputs['id']))->update(array('is_approved' => 1));
            $expense->update(array('approval_status' => 1));
            flash()->success('Expense approved successfully');
            return response()->json(['success' => true]);
        }
    }


    /**
     * Reject expense
     */
    public function rejectExpensees(Request $request)
    {
        $inputs = $request->all();
        $expenses = array_column(Expensive::where(array('budget_id'=>$inputs['budgetId'],'is_approved'=>0))->select('id')->get()->toArray(),'id');
        $refund =  ExpensiveDetail::where(array('expensive_id' => $inputs['id']))->sum('expensive_amount');
        $expenseDetails =  ExpensiveDetail::whereIn('expensive_id',$expenses)->select('id','expense_balance')->get()->toArray();
        foreach($expenseDetails as $value){
            ExpensiveDetail::where(array('id'=>$value['id']))->update(array('expense_balance'=>$value['expense_balance']+$refund));
        }
        Expensive::where(array('id' => $inputs['id']))->update(array('is_approved' => 2));
        ExpensiveDetail::where(array('expensive_id'=>$inputs['id']))->update(array('is_rejected'=>1));
        RountingStatus::where(array('expense_id' => $inputs['id'],'approval_status' => 0, 'approver_id' => Auth::user()->id))->update(array('approval_status' => 2, 'reason' => $inputs['reason'], 'rejected_by' => Auth::user()->id));
        return response()->json(['success' => true]);
    }

    public function allExpenses(Request $request)
    {
        $users =  findUnderWorkingEmployee();
        /*  echo "<pre>";
        print_r($users);
        die('df'); */
        $companyIds = array_column($users, 'company_id');
        $divisionIds = array_column($users, 'division_id');
        $locationIds = array_column($users, 'location_id');
        $departmentIds = array_column($users, 'department_id');
        $sectionIds = array_column($users, 'section_id');
        // $expenses =  (new Expensive())->getAllExpensesOfEmployes($companyIds, $divisionIds, $locationIds, $departmentIds);
        if (Auth::user()->section_id == 0) {
            $sectionIds = NULL;
        }


        $expenses =  (new Expensive())->getAllExpensesOfEmployes($companyIds, $divisionIds, $locationIds, $departmentIds, $sectionIds);
        //echo "<pre>"; print_r($expenses->toArray()); die('g');
        if ($request->ajax()) {
            $expenses =  (new Expensive())->getAllExpensesOfEmployes($companyIds, $divisionIds, $locationIds, $departmentIds, $sectionIds);
            return Datatables::of($expenses)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return '<a title="View expenses" href="' . route('expenses.all_expenses_detail',  $row['id']) . '">'.$row['id'].'</a>';
                })

                ->addColumn('employee', function ($row) {
                    return $row['employee']['name'];
                })
                ->addColumn('financialYear', function ($row) {
                    return $row['financialYear']['year'];
                })
                /* ->addColumn('balance', function ($row) {
                    return IND_money_format($row['balance']);
                }) */
                ->addColumn('balance', function ($row) {
                    return IND_money_format($row['budgetSum']['budget_amount']-$row['submittedExpensesSum']['expense_amount']);
                })
                ->addColumn('expenseType', function ($row) {
                    return $row['budgetType']['name'];
                })
               /*  ->addColumn('budgetAmount', function ($row) {
                    return IND_money_format($row['budget_amount']);
                }) */
                ->addColumn('budgetAmount', function ($row) {
                    return IND_money_format($row['budgetSum']['budget_amount']);
                })

                ->addColumn('expensesSum', function ($row) {
                    return IND_money_format($row['expensesSum']['expensive_amount']);
                })
                ->addColumn('isApproved', function ($row) {
                    if ($row['is_approved'] == 0) {

                        if ($row['submited'] == 0) {
                            $isApproved = 'NS';
                        } else {
                            $isApproved = '@level- ' . count($row['pendingLevel']);
                        }
                    } elseif ($row['is_approved'] == 1) {
                        $isApproved = 'Approved';
                    } else {
                        $isApproved = 'Rejected';
                    }
                    return $isApproved;
                })
                ->addColumn('is_sumitted', function ($row) {
                    return $row['submited'];
                })

                ->addColumn('action', function ($row) {
                    if ($row['submited'] == 0) {
                        $actionBtn = '<a title="Edit expenses" href="' . route('expenses.view_to_edit_expenses',  $row['id']) . '"><i class="fas fa-edit" style="font-size: 20px;"></i></a>';
                    } else {
                        $actionBtn = '<a title="View expenses" href="' . route('expenses.all_expenses_detail',  $row['id']) . '"><i class="fas fa-eye" style="font-size: 20px;"></i></a>
                        <a title="Print" href="' . route('expenses.print_preview',  $row['id']) . '"><i class="fas fa-print" style="font-size: 20px;"></i></a>';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['is_sumitted','id','employee', 'isApproved', 'budgetAmount', 'balance', 'expenseType', 'financialYear', 'expensesSum', 'action'])
                ->make(true);
        }
        return view('employee.submited-expenses.all-expenses', ['active' => 'all-expenses']);
    }

    public function printPreview($id)
    {
        $expense = Expensive::with(array('expenseDetail', 'employee', 'financialYear', 'costCenter', 'projectCode', 'budgetType', 'rejectReason', 'pendingLevel'))
            ->where(array('id' => $id))->first()->toArray();

        $budget = (new Budget())->getBudget($expense['budget_id']);
        $expenseDetail = ViewExpenseDetail::where(array('budget_id' => $expense['budget_id']))->get()->toArray();
        //echo "<pre>"; print_r($expense['expense_detail']);
        $prepareData = [];
        foreach($expense['expense_detail'] as $key=>$value){
            $prepareData[$key]['id']=$value['id'];
            $prepareData[$key]['expensive_id']=$value['expensive_id'];
            $prepareData[$key]['expensive_for']=$value['expensive_for'];
            $prepareData[$key]['more']['specifications']=$value['specifications'];
            $prepareData[$key]['expensive_quantity']=$value['expensive_quantity'];
            $prepareData[$key]['expensive_rate']=$value['expensive_rate'];
            $prepareData[$key]['expensive_amount']=$value['expensive_amount'];
            $prepareData[$key]['more']['expensive_explanation']=$value['expensive_explanation'];
            $prepareData[$key]['category_name']=$value['category_name'];
            $prepareData[$key]['subcategory_name']=$value['subcategory_name'];
        }

        //echo "<pre>"; print_r($prepareData); die('');
        //return view('employee.submited-expenses.print-pdf', ['prepareData'=>$prepareData,'expense' => $expense,'budget'=>$budget,'expenseDetail'=>$expenseDetail,'active' => 'all-expenses']);


        view()->share(array('expense'=> $expense));
        $pdf = PDF::loadView('employee.submited-expenses.print-pdf', ['expense' => $expense,'budget'=>$budget,'expenseDetail'=>$expenseDetail]);

       return $pdf->download('pdf_file.pdf');


        //return view('employee.submited-expenses.print-pdf', ['expense' => $expense, 'active' => 'all-expenses']);
        return view('employee.submited-expenses.print-preview', ['expense' => $expense,'budget'=>$budget,'expenseDetail'=>$expenseDetail,'active' => 'all-expenses']);
    }
    /**
     * get detail of submitted expenses of employee
     *
     */
    public function allExpensesDetail($id)
    {
        $expense = Expensive::with(array('expenseDetail', 'employee', 'financialYear', 'costCenter', 'projectCode', 'budgetType', 'rejectReason', 'pendingLevel','submittedExpensesSum'))
            ->where(array('id' => $id))->first()->toArray();
        //echo "<pre>"; print_r($expense); die('d');
        return view('employee.submited-expenses.submitted-expense-detail', ['expense' => $expense, 'active' => 'all-expenses']);
    }
}
