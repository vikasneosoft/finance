<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BudgetRequest;
use App\Http\Requests\Admin\BudgetDetailRequest;
use App\Models\Company;
use App\Models\Division;
use App\Models\Location;
use App\Models\Department;
use App\Models\Section;
use App\Models\Budget;
use App\Models\BudgetDetail;
use App\Models\User;
use App\Models\BudgetSubcategory;
use App\Models\BudgetCategory;
use App\Models\BudgetType;
use Carbon\Carbon;
use DataTables;
use Config;
use File;

class BudgetController extends Controller
{
    /**
     * Get all budgets
     *
     *
     * @return array
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $companies =  (new Budget())->getBudgets();

            return Datatables::of($companies)
                ->addIndexColumn()
                ->addColumn('employee', function ($row) {
                    $employee = $row['employee']['name'];
                    return $employee;
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('budgets.update',  $row['id']) . '" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['employee', 'action'])
                ->make(true);
        }


        return view('admin.budget.listing', ['active' => 'budget']);
    }

    /**
     * load view to add budget
     *
     * @return void
     */
    public function create()
    {

        $companies = (new Company)->getCompaniesByPluck()->toArray();
        $categories = (new BudgetCategory())->getCategoriesByPluck()->toArray();
        $budgetTypes = (new BudgetType())->getBudgetTypesByPluck()->toArray();
        return view('admin.budget.add', ['budgetTypes' => $budgetTypes, 'companies' => $companies, 'categories' => $categories, 'active' => 'budget']);
    }

    /**
     * load view to add budget detail
     *
     * @return void
     */
    public function viewToAddBudget()
    {
        $categories = (new BudgetCategory())->getCategoriesByPluck()->toArray();
        $budgetTypes = (new BudgetType())->getBudgetTypesByPluck()->toArray();
        $view = view('admin.budget.ajax.add', compact('categories', 'budgetTypes'))->render();
        $result = ['status' => 1, 'data' => $view];
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
        $now = Carbon::now();
        $nextYear = $now->format('y') + 1;
        $fincialYear = $now->year . '-' . $nextYear;
        $image = $request->file();
        $destinationPath =  public_path(Config::get('constants.BUDGET_IMAGE'));
        $imgName = time() . $request->image->getClientOriginalName();
        $image =  $image['image'];
        $imagepath = $destinationPath . $imgName;
        $image->move($destinationPath, $imagepath);
        $inputs['image'] = $imgName;
        $inputs['budget_from_date'] = Carbon::createFromFormat('d-m-Y', $inputs['budget_from_date']);
        $inputs['budget_to_date'] = Carbon::createFromFormat('d-m-Y', $inputs['budget_to_date']);
        $inputs['financial_year'] = $fincialYear;
        $inputs['budget_amount'] = $inputs['budget_quantity'] * $inputs['budget_rate'];
        $budgetData['financial_year'] = $fincialYear;
        $budgetData['employee_id'] = $inputs['employee_id'];
        unset($inputs['_token']);

        if ($inputs['budgetId'] != 0) {
            $budgetId = $inputs['budgetId'];
            $inputs['budget_id'] = $budgetId;
            (new BudgetDetail())->addBudgetDetails($inputs);
            $budgetDetails = (new BudgetDetail())->getBudgetDetailsByBudgetId($budgetId)->toArray();
            $view = view('admin.budget.ajax.after-add', compact('budgetDetails'))->render();
            $result = ['status' => 1, 'budgetId' => $budgetId, 'data' => $view];
            return response()->json($result);
        }

        $objId = (new Budget())->addBudget($budgetData);
        if ($objId) {
            $inputs['budget_id'] = $objId;
            (new BudgetDetail())->addBudgetDetails($inputs);
            $budgetDetails = (new BudgetDetail())->getBudgetDetailsByBudgetId($objId)->toArray();
            $view = view('employee.budget.ajax.after-add', compact('budgetDetails'))->render();
            $result = ['status' => 1, 'budgetId' => $objId, 'data' => $view];
            return response()->json($result);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }

    public function budgetDetailEditView(Request $request)
    {
        $budgetDetail = (new BudgetDetail())->getBudgetDetail($request->id);
        $categories = (new BudgetCategory())->getCategoriesByPluck()->toArray();
        $budgetTypes = (new BudgetType())->getBudgetTypesByPluck()->toArray();
        $subcategories = (new BudgetSubcategory())->getSubcategoriesByCategoryId($budgetDetail->budget_category_id)->toArray();
        $view = view('admin.budget.ajax.edit', compact('categories', 'budgetTypes', 'budgetDetail', 'subcategories'))->render();
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
        $inputs['budget_from_date'] = Carbon::createFromFormat('d-m-Y', $inputs['budget_from_date']);
        $inputs['budget_to_date'] = Carbon::createFromFormat('d-m-Y', $inputs['budget_to_date']);
        unset($inputs['_token']);
        $objId = (new Budget())->addBudget($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
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
        $user = (new User())->getEmploye($budget->employee_id);
        return view('admin.budget.edit', ['user' => $user, 'budget' => $budget, 'active' => 'budget']);
        return view('admin.budget.edit', ['companies' => $companies, 'divisions' => $divisions, 'locations' => $locations, 'departments' => $departments, 'sections' => $sections, 'subcategories' => $subcategories, 'budgetTypes' => $budgetTypes, 'categories' => $categories, 'budget' => $budget, 'active' => 'budget']);
    }

    public function old_show($id)
    {

        $budget = (new Budget())->getBudget($id);
        $user = (new User())->getEmploye($budget->employee_id);

        return view('admin.budget.budget-detail', ['user' => $user, 'budget' => $budget, 'active' => 'budget']);

        $budget = (new Budget())->getBudget($id);
        $categories = (new BudgetCategory())->getCategoriesByPluck()->toArray();
        $budgetTypes = (new BudgetType())->getBudgetTypesByPluck()->toArray();
        $subcategories = (new BudgetSubcategory())->getSubcategoriesByCategoryId($budget->budget_category_id)->toArray();
        $companies = (new Company)->getCompaniesByPluck()->toArray();
        $divisions = (new Division())->getDivisionsByCompnayId($budget->company_id)->toArray();
        $locations = (new Location())->getLocationsByCompnayId($budget->company_id)->toArray();
        $departments = (new Department())->getDepartmentsByDivisionId($budget->division_id)->toArray();
        $sections = (new Section())->getSectionsByDepartmentId($budget->department_id)->toArray();
        return view('admin.budget.edit', ['companies' => $companies, 'divisions' => $divisions, 'locations' => $locations, 'departments' => $departments, 'sections' => $sections, 'subcategories' => $subcategories, 'budgetTypes' => $budgetTypes, 'categories' => $categories, 'budget' => $budget, 'active' => 'budget']);
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
        $user = (new User())->getEmploye($budget->employee_id);
        return view('admin.budget.budget-detail', ['user' => $user, 'budget' => $budget, 'active' => 'budget']);
    }

    /**
     * update budget detail
     *
     * @param array
     * @return view
     */

    public function update(BudgetDetailRequest $request)
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
        $inputs['budget_from_date'] = Carbon::createFromFormat('d-m-Y', $inputs['budget_from_date']);
        $inputs['budget_to_date'] = Carbon::createFromFormat('d-m-Y', $inputs['budget_to_date']);
        $inputs['budget_amount'] = $inputs['budget_quantity'] * $inputs['budget_rate'];
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
     * update budget
     *
     * @param array
     * @return view
     */
    public function old_update(BudgetRequest $request)
    {
        $inputs = $request->all();
        $inputs['budget_from_date'] = Carbon::createFromFormat('d-m-Y', $inputs['budget_from_date']);
        $inputs['budget_to_date'] = Carbon::createFromFormat('d-m-Y', $inputs['budget_to_date']);
        $objId = (new Budget())->updateBudget($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete Budget
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        /*  $division = (new Division())->getDivisionByCompnayId($request->id);
        if ($division) {
            flash()->error('Company name is used in division');
            return response()->json(['success' => false]);
        } */
        $objId = (new Budget())->deleteBudget($request->id);
        if ($objId) {
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


    public function getBudgetSubcategory(Request $request)
    {
        $inputs = $request->all();
        $subcategories = (new BudgetSubcategory())->getSubcategoriesByCategoryId($inputs['catId'])->toArray();
        return response()->json(['subcategories' => $subcategories]);
    }
}
