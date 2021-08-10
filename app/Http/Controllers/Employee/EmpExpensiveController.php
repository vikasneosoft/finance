<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Employee\ExpensiveRequest;
use App\Http\Requests\Employee\ExpensiveDetailRequest;
use App\Models\Budget;
use App\Models\BudgetDetail;
use App\Models\Expensive;
use App\Models\ExpensiveDetail;
use App\Models\BudgetCategory;
use App\Models\BudgetSubcategory;
use App\Models\BudgetType;
use App\Models\FinancialYear;
use App\Models\ProjectCode;
use App\Models\CostCenter;
use App\Models\Location;
use App\Models\RountingStatus;
use App\Models\Rounting;
use App\Models\Views\ViewExpenseDetail;
use App\Models\User;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use Config;
use DB;
use File;
use Auth;
use DataTables;

class EmpExpensiveController extends Controller
{

    /**
     * Get all expensives
     *
     * @return array
     */
    public function getExpenses($budgetId)
    {

        //$expense =  (new Expensive())->getExpensivesByBudgetId($id);
        //$expenses =  (new Expensive())->getExpensesByBudgetAndUserId($budgetId, Auth::user()->id)->toArray();
        $expenses =  (new Expensive())->getExpensesByBudgetAndUserId($budgetId)->toArray();
        $expenseDetail = ViewExpenseDetail::where(array('budget_id' => $budgetId))->get()->toArray();
        $expenseAmount = array_sum(array_column($expenseDetail, 'expense_amount'));


        // $expensives =  (new ExpensiveDetail())->getExpenseDetailsByBudgetId($id)->toArray();
        return view('employee.expensive.listing', ['expenses' => $expenses,'expenseAmount'=>$expenseAmount, 'active' => 'list_budget']);
        return view('employee.expensive.listing', ['expense' => $expense, 'expensives' => $expensives, 'active' => 'budget']);
    }

    /**
     * load view to add expensive
     *
     * @return void
     */
    public function viewAddExpensive($budgetId)
    {

        $expenseDetail = ViewExpenseDetail::where(array('budget_id' => $budgetId))->get()->toArray();
       // echo "<pre>"; print_r($expenseDetail); die('here');
        $fincialYears =  (new FinancialYear())->getFinancialYearsByPluck()->toArray();
        $projectCodes =  (new ProjectCode())->getProjectCodesByPluck()->toArray();
        $costCenters =  (new CostCenter())->getCostCentersByPluck()->toArray();
        $budgetTypes = (new BudgetType())->getBudgetTypesByPluck()->toArray();
        $budget = (new Budget())->getBudget($budgetId);
        $locations = (new Location())->getLocationsByPluck()->toArray();
        // echo "<pre>";
        // print_r($expenseDetail);
        // die('d');
        //$expense = (new Expensive())->getExpensivesByBudgetId($budgetId);
        /*  echo "<pre>";
        print_r($budget->toArray());
        die('here'); */

        return view('employee.expensive.add', ['budget' => $budget, 'expenseDetail' => $expenseDetail, 'locations' => $locations, 'fincialYears' => $fincialYears, 'projectCodes' => $projectCodes, 'costCenters' => $costCenters, 'budgetTypes' => $budgetTypes, 'active' => 'budget']);
        /* if ($expense) {
            if ($expense->is_cloned == 1) {
                $expense = (new Expensive())->getClonedExpenseByBudgetId($budgetId);
            }
            return view('employee.expensive.edit', ['budget' => $budget, 'expense' => $expense, 'locations' => $locations, 'fincialYears' => $fincialYears, 'projectCodes' => $projectCodes, 'costCenters' => $costCenters, 'budgetTypes' => $budgetTypes, 'active' => 'budget']);
        } else {
            return view('employee.expensive.add', ['budget' => $budget, 'locations' => $locations, 'fincialYears' => $fincialYears, 'projectCodes' => $projectCodes, 'costCenters' => $costCenters, 'budgetTypes' => $budgetTypes, 'active' => 'budget']);
        } */
    }

    /**
     * Store expensive
     *
     * @param array
     * @return objectid
     */
    public function store(ExpensiveRequest $request)
    {
        $inputs = $request->all();
        $inputs['employee_id'] = Auth::user()->id;
        $inputs['from_date'] = Carbon::createFromFormat('d-m-Y', $inputs['from_date']);
        $inputs['to_date'] = Carbon::createFromFormat('d-m-Y', $inputs['to_date']);
        $inputs['company_id'] = Auth::user()->company_id;
        $inputs['division_id'] = Auth::user()->division_id;
        $inputs['department_id'] = Auth::user()->department_id;
        $inputs['section_id'] = Auth::user()->section_id;
        $inputs['submited'] = $inputs['is_approved'] = $inputs['is_cloned'] = 0;
        unset($inputs['_token']);
        $objId = (new Expensive())->addExpensive($inputs);
        if ($objId) {
            $result = ['status' => 1, 'expensiveId' => $objId];
            return response()->json($result);
        }
        $result = ['status' => 2];
        return response()->json($result);
    }

    /**
     * load view to add expensive detail
     *
     * @return void
     */
    public function viewToAddExpensiveDetail(Request $request)
    {
        $inputs = $request->all();
        //echo "<pre>"; print_r($inputs);
        $budgetDetail = (new BudgetDetail())->getBudgetDetail($inputs['id']);
        //echo "<pre>"; print_r($budgetDetail->budget_id);
        $submittedExpenseDetail = ViewExpenseDetail::where(array('budget_id' => $budgetDetail->budget_id))->get()->toArray();

        //echo array_sum(array_column($submittedExpenseDetail,'budget_amount'));
        //die('d');
        $categories = (new BudgetCategory())->getCategoriesByPluck()->toArray();
        $subcategories = (new BudgetSubcategory())->getSubcategoriesByCategoryId($budgetDetail->budget_category_id)->toArray();
        $view = view('employee.expensive.ajax.add', compact('categories', 'budgetDetail', 'subcategories','submittedExpenseDetail'))->render();
        $result = ['status' => 1, 'data' => $view];
        return response()->json($result);
    }

    /**
     * load view to edit expensive detail
     *
     * @return void
     */
    public function viewToEditExpenses($id)
    {

        $expense = (new Expensive())->getExpensive($id);
        $budget = (new Budget())->getBudget($expense->budget_id);
        //echo "<pre>"; print_r($expense->toArray()); die('d');
        $expenseDetail = ViewExpenseDetail::where(array('budget_id' => $expense->budget_id))->get()->toArray();
        //echo "<pre>"; print_r($expenseDetail);
        //echo "<pre>"; print_r($budget->toarray()); die('d');

        $fincialYears =  (new FinancialYear())->getFinancialYearsByPluck()->toArray();
        $projectCodes =  (new ProjectCode())->getProjectCodesByPluck()->toArray();
        $costCenters =  (new CostCenter())->getCostCentersByPluck()->toArray();
        $budgetTypes = (new BudgetType())->getBudgetTypesByPluck()->toArray();
        $locations = (new Location())->getLocationsByPluck()->toArray();
        $expenseAmount = array_sum(array_column($expenseDetail, 'expense_amount'));

        return view('employee.expensive.edit', ['locations' => $locations, 'expenseDetail' => $expenseDetail, 'expense' => $expense, 'fincialYears' => $fincialYears, 'projectCodes' => $projectCodes, 'costCenters' => $costCenters, 'budgetTypes' => $budgetTypes, 'budget' => $budget,'expenseAmount' =>$expenseAmount,'active' => 'budget']);
    }

    /**
     * Store expensive details
     *
     * @param array
     * @return objectid
     */
    public function addExpensiveDetail(ExpensiveDetailRequest $request)
    {
        $inputs = $request->all();
        if (isset($inputs['image'])) {
            $image = $request->file();
            $destinationPath =  public_path(Config::get('constants.BUDGET_IMAGE'));
            $imgName = time() . $request->image->getClientOriginalName();
            $image =  $image['image'];
            $imagepath = $destinationPath . $imgName;
            $image->move($destinationPath, $imagepath);
            $inputs['image'] = $imgName;
        }
        if ((isset($inputs['budget_image'])) && !empty($inputs['budget_image'])) {
            $inputs['image'] = $inputs['budget_image'];
        }
        $inputs['expensive_amount'] = $inputs['expensive_rate'] * $inputs['expensive_quantity'];
        unset($inputs['_token']);
        $inputs['expensive_id'] = $inputs['expensiveId'];
        $inputs['is_rejected'] = 0;
        $objId = (new ExpensiveDetail())->addExpensiveDetail($inputs);
        if ($objId) {
            $expensiveDetails = (new ExpensiveDetail())->getExpensiveDetailsByExpensiveId($inputs['expensive_id'])->toArray();
            $budget = (new Budget())->getBudget($inputs['budget_id']);
            $expenseDetail = ViewExpenseDetail::where(array('budget_id' => $inputs['budget_id']))->get()->toArray();
            $view = view('employee.expensive.ajax.after-add', compact('expensiveDetails'))->render();
            $view2 = view('employee.expensive.ajax.budget-detail-after-add', compact('budget', 'expenseDetail'))->render();
            $result = ['status' => 1, 'data' => $view, 'budgetDetail' => $view2];
            return response()->json($result);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }

    /**
     * update expensive
     *
     * @param array
     * @return view
     */
    public function update(ExpensiveRequest $request)
    {
        $inputs = $request->all();
        $inputs['from_date'] = Carbon::createFromFormat('d-m-Y', $inputs['from_date']);
        $inputs['to_date'] = Carbon::createFromFormat('d-m-Y', $inputs['to_date']);
        $inputs['company_id'] = Auth::user()->company_id;
        $inputs['division_id'] = Auth::user()->division_id;
        $inputs['department_id'] = Auth::user()->department_id;
        $inputs['section_id'] = Auth::user()->section_id;
        $objId = (new Expensive())->updateExpensive($inputs);
        if ($objId) {
            $result = ['status' => 1];
            return response()->json($result);
        }
        $result = ['status' => 2];
        return response()->json($result);
    }

    public function viewToEditExpeniveDetail(Request $request)
    {

        $expensiveDetail = (new ExpensiveDetail())->getExpensiveDetail($request->id);
        $submittedExpenseDetail = ViewExpenseDetail::where(array('budget_id' => $expensiveDetail->budget_id))->get()->toArray();
        $categories = (new BudgetCategory())->getCategoriesByPluck()->toArray();
        $subcategories = (new BudgetSubcategory())->getSubcategoriesByCategoryId($expensiveDetail->budget_category_id)->toArray();
        if ($request->ajax()) {
            $view = view('employee.expensive.ajax.edit', compact('categories', 'expensiveDetail', 'subcategories','submittedExpenseDetail'))->render();
            $result = ['status' => 1, 'data' => $view];
            return response()->json($result);
        } else {
            return view('employee.expensive.edit-expenses-detail', ['expensiveDetail' => $expensiveDetail, 'categories' => $categories, 'subcategories' => $subcategories, 'active' => 'budget']);
        }
    }

    /**
     * update expeonsive detail
     *
     * @param array
     * @return view
     */
    public function updateExpensiveDetail(ExpensiveDetailRequest $request)
    {

        $inputs = $request->all();
        $expensive = (new ExpensiveDetail())->getExpensiveDetail($inputs['id']);
        if (isset($inputs['image'])) {
            $image = $request->file();
            $destinationPath =  public_path(Config::get('constants.BUDGET_IMAGE'));
            $imgName = time() . $request->image->getClientOriginalName();
            $image =  $image['image'];
            $imagepath = $destinationPath . $imgName;
            $image->move($destinationPath, $imagepath);
            $inputs['image'] = $imgName;
            $oldImage = $destinationPath . $expensive->image;
            File::delete($oldImage);
        }
        $inputs['expensive_amount'] = $inputs['expensive_quantity'] * $inputs['expensive_rate'];
        $objId = (new ExpensiveDetail())->updateExpensiveDetail($inputs);
        if ($objId) {
            $expensiveDetails = (new ExpensiveDetail())->getExpensiveDetailsByExpensiveId($expensive->expensive_id)->toArray();
            $budget = (new Budget())->getBudget($expensive->budget_id);
            $expenseDetail = ViewExpenseDetail::where(array('budget_id' => $expensive->budget_id))->get()->toArray();
            $view = view('employee.expensive.ajax.after-add', compact('expensiveDetails'))->render();
            $view2 = view('employee.expensive.ajax.budget-detail-after-add', compact('budget', 'expenseDetail'))->render();
            flash()->success('Updated successfully');
            $result = ['status' => 1, 'data' => $view, 'budgetDetail' => $view2];
            return response()->json($result);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }

    /**
     * delete expensive
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {

        $objId = (new Expensive())->deleteExpensive($request->id);
        if ($objId) {
            $expensiveDetails = (new ExpensiveDetail())->getExpensiveDetailsByExpensiveId($request->id)->toArray();
            $destinationPath =  public_path(Config::get('constants.BUDGET_IMAGE'));
            foreach ($expensiveDetails as $expensiveDetail) {
                $image = $destinationPath . $expensiveDetail['image'];
                File::delete($image);
                (new ExpensiveDetail())->deleteExpensiveDetail($expensiveDetail['id']);
            }
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }

    /**
     * delete expensive detail
     *
     * @param id
     * @return true||false
     */
    public function deleteExpensiveDetail(Request $request)
    {
        $expensiveDetail = (new ExpensiveDetail())->getExpensiveDetail($request->id);
        $destinationPath =  public_path(Config::get('constants.BUDGET_IMAGE'));
        $oldImage = $destinationPath . $expensiveDetail->image;
        File::delete($oldImage);
        $objId = (new ExpensiveDetail())->deleteExpensiveDetail($request->id);
        if ($objId) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function getExpenseDetail($id)
    {
        echo $id;
    }

    /**
     * submit expense for approval
     *
     * @param id
     */
    public function submitExpenses(Request $request)
    {

        $inputs = $request->all();
        $expenses = array_column(Expensive::where(array('budget_id'=>$request->budgetId,'is_approved'=>0))->select('id')->get()->toArray(),'id');
        //print_r($expense);
        $submittedExpenseDetail = ViewExpenseDetail::where(array('budget_id' => $request->budgetId))->get()->toArray();
       // print_r($submittedExpenseDetail);
        $expenseAmount = (isset($submittedExpenseDetail[0]['id'])) ? array_sum(array_column($submittedExpenseDetail,'expense_amount')) : 0 ;
        $budgetAmt = array_sum(array_column($submittedExpenseDetail,'budget_amount'));
        $balance = $budgetAmt-$expenseAmount-$inputs['expense_amount'];

        ExpensiveDetail::whereIn('expensive_id',$expenses)->update(array('expense_balance'=>$balance));
        //budget_id
        //$submittedExpenseDetail = ViewExpenseDetail::where(array('budget_id' => $expensiveDetail->budget_id))->get()->toArray();
        //echo "<pre>"; print_r($submittedExpenseDetail); die('here');


        $inputs['submited'] = 1;
        $rounting = Rounting::where(array('employee_id' => Auth::user()->id,'level'=>1))->first();
        if($rounting){
            $user = User::where(array('id'=>$rounting->manager_id))->first();
            $data['approver_id'] = $rounting->manager_id;
            $data['approval_status'] = 0;
            $data['expense_id'] = $inputs['id'];
            $data['originator_id'] = Auth::user()->id;
            $data['expense_amount'] = $inputs['expense_amount'];
            $data['subimtted_by'] = Auth::user()->id;
            $data['level'] = $rounting->level;
            $data['maximum_amount'] = $rounting->maximum_amount;
            (new RountingStatus())->addForApproval($data);
            (new Expensive())->updateExpensive($inputs);

            $emailData = ['email'=>$user->email,'receiver'=>$user->name,'sender'=>Auth::user()->name,'budget'=>$budgetAmt,'submission'=>$inputs['expense_amount'], 'balance'=>$balance];
            dispatch(new SendEmailJob($emailData));
            return response()->json(['success' => true]);
        }
        flash()->error('There is no approval level for you');
        return response()->json(['success' => false]);

    }


    /**
     * get submitted expenses
     *
     * @param id
     */
    public function getSubmitedExpenses(Request $request)
    {

        $expenses =  (new Expensive())->getExpensivesByUserId(Auth::user()->id);
       /*  echo "<pre>";
        print_r($expenses->toArray());
        die('d'); */
        if ($request->ajax()) {
            $expenses =  (new Expensive())->getExpensivesByUserId(Auth::user()->id);
            return Datatables::of($expenses)
                ->addIndexColumn()
                ->addColumn('financialYear', function ($row) {
                    return $row['financialYear']['year'];
                })
                ->addColumn('createdBy', function ($row) {
                    return $row['employee']['name'];
                })
                ->addColumn('budgetAmt', function ($row) {
                    return IND_money_format($row['budgetSum']['budget_amount']);
                })
                /* ->addColumn('balance', function ($row) {
                    return IND_money_format($row['budgetSum']['budget_amount']-$row['expensesSum']['expensive_amount']);
                }) */
                ->addColumn('balance', function ($row) {
                    return IND_money_format($row['budgetSum']['budget_amount']-$row['submittedExpensesSum']['expense_amount']);
                })
                ->addColumn('expenseType', function ($row) {
                    return $row['budgetType']['name'];
                })
                /* ->addColumn('budgetAmt', function ($row) {
                    return IND_money_format($row['budget_amount']);
                }) */
                ->addColumn('expensesSum', function ($row) {
                    return IND_money_format($row['expensesSum']['expensive_amount']);
                })
                ->addColumn('isApproved', function ($row) {
                    if ($row['is_approved'] == 0) {

                        $isApproved = '@level- ' . count($row['pendingLevel']);
                    } elseif ($row['is_approved'] == 1) {
                        $isApproved = 'Approved';
                    } else {
                        $isApproved = 'Rejected';
                    }
                    return $isApproved;
                })
                ->addColumn('createdDate', function ($row) {
                    return Carbon::parse($row['created_at'])->format('d-m-Y');
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a title="View expenses" href="' . route('expenses.get_submited_expenses_detail',  $row['id']) . '" class="edit"><i class="fas fa-eye" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['budgetAmt','createdBy', 'isApproved', 'budgetAmt', 'expenseType', 'financialYear', 'expensesSum', 'action'])
                ->make(true);
        }
        return view('employee.expensive.submitted-expenses', ['active' => 'submited-expenses']);
    }

    /**
     * get detail of submitted expenses
     *
     */
    public function getSubmitedExpensesDetail($id)
    {

        $expense = (new Expensive())->getSubmitedExpensesDetail($id, Auth::user()->id);
       // echo "<pre>"; print_r($expense); die('s');
        return view('employee.expensive.submitted-expense-detail', ['expense' => $expense, 'active' => 'submited-expenses']);
    }

    /**
     * create duplicate expenses
     * @param expenseId
     */
    public function cloneExpense(Request $request)
    {
        $inputs =  $request->all();
        $expense = (new Expensive())->getExpensive($inputs['id']);
        $data['budget_id'] = $expense->budget_id;
        $data['employee_id'] = $expense->employee_id;
        $data['budget_type_id'] = $expense->budget_type_id;
        $data['financial_year'] = $expense->financial_year;
        $data['from_date'] = $expense->from_date;
        $data['to_date'] = $expense->to_date;
        $data['vendor'] = $expense->vendor;
        $data['vendor_contacts'] = $expense->vendor_contacts;
        $data['reason_for_selecting_vendor'] = $expense->reason_for_selecting_vendor;
        $data['assumptions_or_inclusions'] = $expense->assumptions_or_inclusions;
        $data['exceptions_or_exclusions'] = $expense->exceptions_or_exclusions;
        $data['payment_terms'] = $expense->payment_terms;
        $data['warranty_guarantee_details'] = $expense->warranty_guarantee_details;
        $data['expensive_code'] = $expense->expensive_code;
        $data['cost_center_id'] = $expense->cost_center_id;
        $data['project_code_id'] = $expense->project_code_id;
        $data['project_in_charge'] = $expense->project_in_charge;
        $data['proj_ref_no'] = $expense->proj_ref_no;
        $data['location_id'] = $expense->location_id;
        $data['what_is_required'] = $expense->what_is_required;
        $data['why_required'] = $expense->why_required;
        $data['scope_of_work'] = $expense->scope_of_work;
        $data['what_will_change'] = $expense->what_will_change;
        $data['submited'] = $data['is_approved'] = $data['is_cloned'] = 0;
        $data['company_id'] = $expense->company_id;
        $data['division_id'] = $expense->division_id;
        $data['department_id'] = $expense->department_id;
        $data['section_id'] = $expense->section_id;
        $expenseId = (new Expensive())->addExpensive($data);
        $expenseDetails = (new ExpensiveDetail())->getExpensiveDetailsByExpensiveId($inputs['id'])->toArray();
        $tempData =  array();
        foreach ($expenseDetails as $key => $value) {
            $tempOrder['expensive_id'] = $expenseId;
            $tempOrder['budget_id'] = $value['budget_id'];
            $tempOrder['budget_detail_id'] = $value['budget_detail_id'];
            $tempOrder['budget_category_id'] = $value['budget_category_id'];
            $tempOrder['specifications'] = $value['specifications'];
            $tempOrder['image'] = $value['image'];
            $tempOrder['budget_subcategory_id'] = $value['budget_subcategory_id'];
            $tempOrder['expensive_for'] = $value['expensive_for'];
            $tempOrder['expensive_quantity'] = $value['expensive_quantity'];
            $tempOrder['expensive_rate'] = $value['expensive_rate'];
            $tempOrder['expensive_amount'] = $value['expensive_amount'];

            $tempOrder['budget_amt'] = $value['budget_amt'];
            $tempOrder['submited_expense'] = $value['submited_expense'];
            $tempOrder['expense_balance'] = $value['expense_balance'];
            $tempOrder['is_rejected'] = 0;

            $tempOrder['expensive_explanation'] = $value['expensive_explanation'];
            $tempOrder['created_at'] = date('Y-m-d H:i:s');
            $tempOrder['updated_at'] = date('Y-m-d H:i:s');
            array_push($tempData, $tempOrder);
        }
        ExpensiveDetail::insert($tempData);
        $expense->update(array('is_cloned' => 1));
        return response()->json(['success' => true]);
    }
}
