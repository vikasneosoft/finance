<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Employee\BudgetDetailRequest;
use App\Http\Requests\Employee\BudgetRequest;
use App\Models\Budget;
use App\Models\BudgetDetail;
use App\Models\BudgetCategory;
use App\Models\BudgetSubcategory;
use App\Models\BudgetType;
use App\Models\Company;
use App\Models\Department;
use App\Models\Division;
use App\Models\Expensive;
use App\Models\Location;
use App\Models\FinancialYear;
use App\Models\ProjectCode;
use App\Models\CostCenter;
use App\Models\User;
use App\Models\Section;
use App\Models\Views\ViewBudgetDetail;
use App\Models\Views\ViewBudgetForExpense;
use Carbon\Carbon;
use Config;
use File;
use Auth;
use DataTables;

class EmpBudgetController extends Controller
{
    /**
     * Get all budgets created by logined users
     *
     *
     * @return array
     */
    public function index(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $location_id = Auth::user()->location_id;
        $division_id = Auth::user()->division_id;
        $department_id = Auth::user()->department_id;
        $section_id = Auth::user()->section_id;
        if ($location_id == 0) {
            $location_id = NULL;
        }
        if ($division_id == 0) {
            $division_id = NULL;
        }

        if ($department_id == 0) {
            $department_id = NULL;
        }
        if ($section_id == 0) {
            $section_id = NULL;
        }
        $budgets =  (new ViewBudgetForExpense())->getBudgetsForExpense($company_id, $location_id, $division_id, $department_id, $section_id);
        /* $budgets =  (new Budget())->getBudgetsByUserId($company_id, $location_id, $division_id, $department_id, $section_id);*/
        /*  echo "<pre>";
        print_r($budgets->toArray());
        die('d'); */
        if ($request->ajax()) {
            $budgets =  (new ViewBudgetForExpense())->getBudgetsForExpense($company_id, $location_id, $division_id, $department_id, $section_id);
            return Datatables::of($budgets)
                ->addIndexColumn()
                ->addColumn('budgetSum', function ($row) {
                    if (isset($row['budget'])) {
                        $budgetSum = IND_money_format($row['budget']);
                    } else {
                        $budgetSum = '--';
                    }
                    return $budgetSum;
                })
                ->addColumn('expensesSum', function ($row) {
                    if (isset($row['expense'])) {
                        if ($row['expense'] >  $row['budget']) {
                            return '<a title="View expenses" href="' . route('expenses.get_expenses',  $row['id']) . '" target="_blank"><span style="color:red">' . IND_money_format($row['expense']) . '</span></a>';
                        } else {
                            return '<a title="View expenses" href="' . route('expenses.get_expenses',  $row['id']) . '" target="_blank">'.IND_money_format($row['expense']) . '</a>';
                        }


                       // $expensesSum = IND_money_format($row['expense']);
                    } else {
                        $expensesSum = '--';
                    }
                    return $expensesSum;
                })

                ->addColumn('financialYear', function ($row) {
                    return $row['year'];
                })

                ->addColumn('createdBy', function ($row) {
                    return $row['created_by'];
                })

                ->addColumn('projectCode', function ($row) {
                    return  $row['project_code'];
                })

                ->addColumn('costCenter', function ($row) {
                    return $row['cost_center'];
                })

                ->addColumn('action', function ($row) {

                    //return getAccess($row['employee_id']);
                    if (getAccess($row['employee_id']) == 1) {
                        $actionBtn = '<a href="' . route('budget.show',  $row['id']) . '" title="Update" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a title="Create Expenses" href="' . route('expensive.view_add_expensive',  $row['id']) . '"><i class="fas fa-address-card" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" title="Delete" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    } else {
                        $actionBtn = '--';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['expensesSum','createdBy', 'budgetSum', 'financialYear', 'projectCode', 'costCenter', 'action'])
                ->make(true);
        }
        return view('employee.budget.listing', ['active' => 'budget']);
    }

    public function with_table_index(Request $request)
    {

        $company_id = Auth::user()->company_id;
        $location_id = Auth::user()->location_id;
        $division_id = Auth::user()->division_id;
        $department_id = Auth::user()->department_id;
        $section_id = Auth::user()->section_id;
        if ($location_id == 0) {
            $location_id = NULL;
        }
        if ($division_id == 0) {
            $division_id = NULL;
        }

        if ($department_id == 0) {
            $department_id = NULL;
        }
        if ($section_id == 0) {
            $section_id = NULL;
        }

        /* $budgets =  (new Budget())->getBudgetsByUserId($company_id, $location_id, $division_id, $department_id, $section_id);
        echo "<pre>";
        print_r($budgets->toArray());
        die('d'); */
        if ($request->ajax()) {
            $budgets =  (new Budget())->getBudgetsByUserId($company_id, $location_id, $division_id, $department_id, $section_id);
            return Datatables::of($budgets)
                ->addIndexColumn()
                ->addColumn('budgetSum', function ($row) {
                    if (isset($row['budgetSum']['budget_amount'])) {
                        $budgetSum = IND_money_format($row['budgetSum']['budget_amount']);
                    } else {
                        $budgetSum = '--';
                    }
                    return $budgetSum;
                })
                ->addColumn('expensesSum', function ($row) {
                    if (isset($row['expensesSum']['expensive_amount'])) {
                        $expensesSum = IND_money_format($row['expensesSum']['expensive_amount']);
                    } else {
                        $expensesSum = '--';
                    }
                    return $expensesSum;
                })

                ->addColumn('financialYear', function ($row) {
                    return $row['financialYear']['year'];
                })

                ->addColumn('createdBy', function ($row) {
                    return $row['employee']['name'];
                })

                ->addColumn('projectCode', function ($row) {
                    return  $row['projectCode']['code'];
                })

                ->addColumn('costCenter', function ($row) {
                    return $row['costCenter']['name'];
                })

                ->addColumn('action', function ($row) {

                    //return getAccess($row['employee_id']);
                    if (getAccess($row['employee_id']) == 1) {
                        $actionBtn = '<a href="' . route('budget.show',  $row['id']) . '" title="Update" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a title="Create Expenses" href="' . route('expensive.view_add_expensive',  $row['id']) . '"><i class="fas fa-address-card" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" title="Delete" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    } else {
                        $actionBtn = '--';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['createdBy', 'budgetSum', 'financialYear', 'projectCode', 'costCenter', 'action'])
                ->make(true);
        }
        return view('employee.budget.listing', ['active' => 'budget']);
    }

    /**
     * Get all budgets created by upper level user
     *
     *
     * @return array
     */
    public function getBudgets(Request $request)
    {
        $user = findUpperLevelUser();
        $company_id = Auth::user()->company_id;
        $location_id = Auth::user()->location_id;
        $division_id = Auth::user()->division_id;
        $department_id = Auth::user()->department_id;
        $section_id = Auth::user()->section_id;
        if ($location_id == 0) {
            $location_id = NULL;
        }
        if ($division_id == 0) {
            $division_id = NULL;
        }

        if ($department_id == 0) {
            $department_id = NULL;
        }
        if ($section_id == 0) {
            $section_id = NULL;
        }
        $budgets =  (new ViewBudgetForExpense())->getBudgetsForExpense($company_id, $location_id, $division_id, $department_id, $section_id);
        //echo "<pre>"; print_r($budgets->toArray()); die('s');
        if ($request->ajax()) {

            //$budgets =  (new Budget())->getBudgetsByUserId($user->id);
            //$budgets =  (new Budget())->getBudgetsForExpense($company_id, $location_id, $division_id, $department_id, $section_id);
            $budgets =  (new ViewBudgetForExpense())->getBudgetsForExpense($company_id, $location_id, $division_id, $department_id, $section_id);

            return Datatables::of($budgets)
                ->addIndexColumn()

                ->addColumn('budgetSum', function ($row) {
                    return '<a title="View Budget" href="' . route('budget.budget_detail',  $row['id']) . '">' . IND_money_format($row['budget']) . '</a>';
                })
                ->addColumn('expensesSum', function ($row) {
                    // return 'RED';
                    if (isset($row['expense'])) {
                        if ($row['expense'] >  $row['budget']) {
                            return '<span style="color:red">' . IND_money_format($row['expense']) . '</a>';
                        } else {
                            return IND_money_format($row['expense']);
                        }
                    } else {
                        return '--';
                    }
                })

                ->addColumn('financialYear', function ($row) {
                    return $row['year'];
                })

                ->addColumn('createdBy', function ($row) {
                    return $row['created_by'];
                })

                ->addColumn('projectCode', function ($row) {
                    return $row['project_code'];
                })

                ->addColumn('costCenter', function ($row) {
                    return $row['cost_center'];
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a title="Create Expenses" href="' . route('expensive.view_add_expensive',  $row['id']) . '"><i class="fas fa-address-card" style="font-size: 20px;"></i></a>
                    <a title="View expenses" href="' . route('expenses.get_expenses',  $row['id']) . '" target="_blank" class="edit"><i class="fas fa-eye" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['createdBy', 'budgetSum', 'expensesSum', 'financialYear', 'projectCode', 'costCenter', 'action'])
                ->make(true);
        }
        return view('employee.budget.created-budget', ['active' => 'list_budget']);
    }

    public function with_table_getBudgets(Request $request)
    {

        $user = findUpperLevelUser();
        $company_id = Auth::user()->company_id;
        $location_id = Auth::user()->location_id;
        $division_id = Auth::user()->division_id;
        $department_id = Auth::user()->department_id;
        $section_id = Auth::user()->section_id;
        if ($location_id == 0) {
            $location_id = NULL;
        }
        if ($division_id == 0) {
            $division_id = NULL;
        }

        if ($department_id == 0) {
            $department_id = NULL;
        }
        if ($section_id == 0) {
            $section_id = NULL;
        }

        if ($request->ajax()) {

            //$budgets =  (new Budget())->getBudgetsByUserId($user->id);
            $budgets =  (new Budget())->getBudgetsForExpense($company_id, $location_id, $division_id, $department_id, $section_id);


            return Datatables::of($budgets)
                ->addIndexColumn()

                ->addColumn('budgetSum', function ($row) {

                    return (isset($row['budgetSum']['budget_amount'])) ? '<a title="View Budget" href="' . route('budget.budget_detail',  $row['id']) . '">' . IND_money_format($row['budgetSum']['budget_amount']) . '</a>' : '--';
                })
                ->addColumn('expensesSum', function ($row) {
                    // return 'RED';
                    if (isset($row['expensesSum']['expensive_amount'])) {
                        if ($row['expensesSum']['expensive_amount'] >  $row['budgetSum']['budget_amount']) {
                            return '<span style="color:red">' . IND_money_format($row['expensesSum']['expensive_amount']) . '</a>';
                        } else {
                            return IND_money_format($row['expensesSum']['expensive_amount']);
                        }
                    } else {
                        return '--';
                    }
                })

                ->addColumn('financialYear', function ($row) {
                    return $row['financialYear']['year'];
                })

                ->addColumn('createdBy', function ($row) {
                    return $row['employee']['name'];
                })

                ->addColumn('projectCode', function ($row) {
                    return $row['projectCode']['code'];
                })

                ->addColumn('costCenter', function ($row) {
                    return $row['costCenter']['name'];
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a title="Create Expenses" href="' . route('expensive.view_add_expensive',  $row['id']) . '"><i class="fas fa-address-card" style="font-size: 20px;"></i></a>
                    <a title="View expenses" href="' . route('expenses.get_expenses',  $row['id']) . '" target="_blank" class="edit"><i class="fas fa-eye" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['createdBy', 'budgetSum', 'expensesSum', 'financialYear', 'projectCode', 'costCenter', 'action'])
                ->make(true);
        }
        return view('employee.budget.created-budget', ['active' => 'list_budget']);
    }

    /**
     * get budget detail
     *
     * @param  $id
     * @return view
     */
    public function budgetDetail($id)
    {
        $budget = (new Budget())->getBudget($id);
        return view('employee.budget.budget-detail', ['budget' => $budget, 'active' => 'budget']);
    }

    /**
     * load view to add budget
     *
     * @return void
     */
    public function create()
    {
        $divisions = (new Division)->getDivisionsByCompnayId(Auth::user()->company_id)->toArray();
        $locations = (new Location)->getLocationsByCompnayId(Auth::user()->company_id)->toArray();
        $departments = (new Department)->getDepartmentsByDivisionId(Auth::user()->division_id)->toArray();
        $sections = (new Section)->getSectionsByDepartmentId(Auth::user()->department_id)->toArray();

        //$companies = (new Company)->getCompaniesByPluck()->toArray();
        $fincialYears =  (new FinancialYear())->getFinancialYearsByPluck()->toArray();
        $projectCodes =  (new ProjectCode())->getProjectCodesByPluck()->toArray();
        $costCenters =  (new CostCenter())->getCostCentersByPluck()->toArray();
        $budgetTypes = (new BudgetType())->getBudgetTypesByPluck()->toArray();
        return view('employee.budget.add', ['departments' => $departments, 'sections' => $sections, 'divisions' => $divisions, 'locations' => $locations, 'fincialYears' => $fincialYears, 'projectCodes' => $projectCodes, 'costCenters' => $costCenters, 'budgetTypes' => $budgetTypes, 'active' => 'budget']);
    }

    /**
     * load view to add budget detail
     *
     * @return void
     */
    public function viewAddBudget()
    {
        $categories = (new BudgetCategory())->getCategoriesByPluck()->toArray();
        $view = view('employee.budget.ajax.add', compact('categories'))->render();
        $result = ['status' => 1, 'data' => $view];
        return response()->json($result);
    }

    /**
     * Store budget
     *
     * @param array
     * @return objectid
     */
    public function store(BudgetRequest $request)
    {
        $inputs = $request->all();
        $inputs['employee_id'] = Auth::user()->id;
        $inputs['budget_from_date'] = Carbon::createFromFormat('d-m-Y', $inputs['budget_from_date']);
        $inputs['budget_to_date'] = Carbon::createFromFormat('d-m-Y', $inputs['budget_to_date']);
        $inputs['company_id'] = Auth::user()->company_id;
        $inputs['location_id'] = (isset($inputs['location_id'])) ? $inputs['location_id'] : Auth::user()->location_id;
        $inputs['division_id'] = (isset($inputs['division_id'])) ? $inputs['division_id'] : 0;
        $inputs['department_id'] = (isset($inputs['department_id'])) ? $inputs['department_id'] : 0;
        $inputs['section_id'] = (isset($inputs['section_id'])) ? $inputs['section_id'] : 0;
        if (Auth::user()->department_id != 0) {
            $inputs['department_id'] = Auth::user()->department_id;
        }
        if (Auth::user()->division_id != 0) {
            $inputs['division_id'] = Auth::user()->division_id;
        }
        //$inputs['location_id'] = Auth::user()->location_id;
        //$inputs['division_id'] = Auth::user()->division_id;
        // $inputs['department_id'] = Auth::user()->department_id;
        //$inputs['section_id'] = Auth::user()->section_id;

        unset($inputs['_token']);
        $objId = (new Budget())->addBudget($inputs);
        if ($objId) {
            $result = ['status' => 1, 'budgetId' => $objId];
            return response()->json($result);
        }
        $result = ['status' => 2];
        return response()->json($result);
    }

    /**
     * Store budget and budget details
     *
     * @param array
     * @return objectid
     */
    public function addBudget(BudgetDetailRequest $request)
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
        $inputs['employee_id'] = Auth::user()->id;
        $inputs['company_id'] = Auth::user()->company_id;
        $inputs['location_id'] = Auth::user()->location_id;
        $inputs['division_id'] = Auth::user()->division_id;
        $inputs['department_id'] = Auth::user()->department_id;
        $inputs['section_id'] = Auth::user()->section_id;
        $inputs['budget_amount'] = $inputs['budget_quantity'] * $inputs['budget_rate'];
        unset($inputs['_token']);
        $inputs['budget_id'] = $inputs['budgetId'];
        $objId = (new BudgetDetail())->addBudgetDetails($inputs);
        if ($objId) {
            $budgetDetails = (new BudgetDetail())->getBudgetDetailsByBudgetId($inputs['budget_id'])->toArray();
            $view = view('employee.budget.ajax.after-add', compact('budgetDetails'))->render();
            $result = ['status' => 1, 'budgetId' => $inputs['budget_id'], 'data' => $view];
            return response()->json($result);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }

    /**
     * load view to edit budget
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {
        $budget = (new Budget())->getBudget($id);

        $canModify = getAccess($budget->employee_id);
        if ($canModify == 0) {
            return redirect()->route('budget.index')->with('message', 'You can not modify this budget');
        }

        $divisions = (new Division)->getDivisionsByCompnayId(Auth::user()->company_id)->toArray();
        $locations = (new Location)->getLocationsByCompnayId(Auth::user()->company_id)->toArray();
        $departments = (new Department)->getDepartmentsByDivisionId($budget->division_id)->toArray();
        $sections = (new Section)->getSectionsByDepartmentId($budget->department_id)->toArray();
        //   echo "<pre>";
        // print_r($sections);
        //die('s');
        $fincialYears =  (new FinancialYear())->getFinancialYearsByPluck()->toArray();
        $projectCodes =  (new ProjectCode())->getProjectCodesByPluck()->toArray();
        $costCenters =  (new CostCenter())->getCostCentersByPluck()->toArray();
        $budgetTypes = (new BudgetType())->getBudgetTypesByPluck()->toArray();
        return view('employee.budget.edit', ['divisions' => $divisions, 'locations' => $locations, 'departments' => $departments, 'sections' => $sections, 'fincialYears' => $fincialYears, 'projectCodes' => $projectCodes, 'costCenters' => $costCenters, 'budgetTypes' => $budgetTypes, 'budget' => $budget, 'active' => 'budget']);
    }

    /**
     * update budget detail
     *
     * @param array
     * @return view
     */
    public function update(BudgetRequest $request)
    {
        $inputs = $request->all();
        $inputs['budget_from_date'] = Carbon::createFromFormat('d-m-Y', $inputs['budget_from_date']);
        $inputs['budget_to_date'] = Carbon::createFromFormat('d-m-Y', $inputs['budget_to_date']);
        $inputs['company_id'] = Auth::user()->company_id;

        $inputs['location_id'] = (isset($inputs['location_id'])) ? $inputs['location_id'] : 0;
        $inputs['division_id'] = (isset($inputs['division_id'])) ? $inputs['division_id'] : 0;
        $inputs['department_id'] = (isset($inputs['department_id'])) ? $inputs['department_id'] : 0;
        $inputs['section_id'] = (isset($inputs['section_id'])) ? $inputs['section_id'] : 0;
        if (Auth::user()->department_id != 0) {
            $inputs['department_id'] = Auth::user()->department_id;
        }
        if (Auth::user()->division_id != 0) {
            $inputs['division_id'] = Auth::user()->division_id;
        }

        //$inputs['location_id'] = Auth::user()->location_id;
        //$inputs['division_id'] = Auth::user()->division_id;
        //$inputs['department_id'] = Auth::user()->department_id;
        //$inputs['section_id'] = Auth::user()->section_id;
        $objId = (new Budget())->updateBudget($inputs);
        if ($objId) {
            $result = ['status' => 1];
            return response()->json($result);
        }
        $result = ['status' => 2];
        return response()->json($result);
    }

    public function budgetDetailEditView(Request $request)
    {
        $budgetDetail = (new BudgetDetail())->getBudgetDetail($request->id);
        $categories = (new BudgetCategory())->getCategoriesByPluck()->toArray();
        $budgetTypes = (new BudgetType())->getBudgetTypesByPluck()->toArray();
        $subcategories = (new BudgetSubcategory())->getSubcategoriesByCategoryId($budgetDetail->budget_category_id)->toArray();
        $view = view('employee.budget.ajax.edit', compact('categories', 'budgetTypes', 'budgetDetail', 'subcategories'))->render();
        $result = ['status' => 1, 'data' => $view];
        return response()->json($result);
    }

    /**
     * update budget detail
     *
     * @param array
     * @return view
     */
    public function updateBudgetDetail(BudgetDetailRequest $request)
    {
        $inputs = $request->all();

        $budget = (new BudgetDetail())->getBudgetDetail($inputs['id']);
        if (isset($inputs['image'])) {
            $image = $request->file();
            $destinationPath =  public_path(Config::get('constants.BUDGET_IMAGE'));
            $imgName = time() . $request->image->getClientOriginalName();
            $image =  $image['image'];
            $imagepath = $destinationPath . $imgName;
            $image->move($destinationPath, $imagepath);
            $inputs['image'] = $imgName;
            $oldImage = $destinationPath . $budget->image;
            File::delete($oldImage);
        }
        $inputs['budget_amount'] = $inputs['budget_quantity'] * $inputs['budget_rate'];
        $inputs['company_id'] = Auth::user()->company_id;
        $inputs['location_id'] = Auth::user()->location_id;
        $inputs['division_id'] = Auth::user()->division_id;
        $inputs['department_id'] = Auth::user()->department_id;
        $inputs['section_id'] = Auth::user()->section_id;
        $objId = (new BudgetDetail())->updateBudgetDetail($inputs);
        if ($objId) {
            $budgetDetails = (new BudgetDetail())->getBudgetDetailsByBudgetId($budget->budget_id)->toArray();
            $view = view('employee.budget.ajax.after-add', compact('budgetDetails'))->render();
            $result = ['status' => 1, 'data' => $view];
            return response()->json($result);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }

    /**
     * load view of budget detail
     *
     * @param  $id
     * @return view
     */
    public function view($id)
    {
        $budget = (new Budget())->getBudget($id);
        $user = (new User())->getEmploye(Auth::user()->id);
        return view('employee.budget.budget-detail', ['user' => $user, 'budget' => $budget, 'active' => 'budget']);
    }

    /**
     * delete Budget
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        $expense = (new Expensive())->getExpensivesByBudgetId($request->id);
        if($expense){
            flash()->error('This budget has linked expenses');
            return response()->json(['success' => false]);
        }

        $objId = (new Budget())->deleteBudget($request->id);
        if ($objId) {
            $budgetDetails = (new BudgetDetail())->getBudgetDetailsByBudgetId($request->id)->toArray();
            $destinationPath =  public_path(Config::get('constants.BUDGET_IMAGE'));
            foreach ($budgetDetails as $budgetDetail) {
                $image = $destinationPath . $budgetDetail['image'];
                File::delete($image);
                (new BudgetDetail())->deleteBudgetDetail($budgetDetail['id']);
            }
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }

    /**
     * delete Budget detail
     *
     * @param id
     * @return true||false
     */
    public function deleteBudgetDetail(Request $request)
    {
        $budgetDetail = (new BudgetDetail())->getBudgetDetail($request->id);
        $destinationPath =  public_path(Config::get('constants.BUDGET_IMAGE'));
        $oldImage = $destinationPath . $budgetDetail->image;
        File::delete($oldImage);

        $objId = (new BudgetDetail())->deleteBudgetDetail($request->id);
        if ($objId) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
