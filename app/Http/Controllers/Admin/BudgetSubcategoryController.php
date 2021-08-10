<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BudgetCategoryRequest;
use App\Models\BudgetSubcategory;
use App\Models\BudgetCategory;
use App\Models\Budget;
use DataTables;

class BudgetSubcategoryController extends Controller
{
    /**
     * Get all sub categories
     *
     *
     * @return array
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories =  (new BudgetSubcategory)->getSubcategories();
            return Datatables::of($categories)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    $category = $row['category']['name'];
                    return $category;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('subcategory.update',  $row['id']) . '" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['category', 'action'])
                ->make(true);
        }
        return view('admin.subcategory.listing', ['active' => 'subcategory']);
    }

    /**
     * load view to add subcategory
     *
     * @return void
     */
    public function create()
    {
        $categories = (new BudgetCategory())->getCategoriesByPluck()->toArray();
        return view('admin.subcategory.add', ['categories' => $categories, 'active' => 'subcategory']);
    }

    /**
     * Store subcategory
     *
     * @param array
     * @return objectid
     */
    public function store(BudgetCategoryRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new BudgetSubcategory())->addSubcategory($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit subcategory
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {
        $categories = (new BudgetCategory())->getCategoriesByPluck()->toArray();
        $subcategory = (new BudgetSubcategory())->getSubcategory($id);
        return view('admin.subcategory.edit', ['subcategory' => $subcategory, 'categories' => $categories, 'active' => 'subcategory']);
    }

    /**
     * update subcategory
     *
     * @param array
     * @return view
     */
    public function update(BudgetCategoryRequest $request)
    {
        $inputs = $request->all();
        $objId = (new BudgetSubcategory())->updateSubcategory($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * Delete subcategory
     *
     * @param  $id
     * @return true
     */
    public function destroy(Request $request)
    {
        $budget = (new Budget())->getBudgetBySubcategoryId($request->id);
        if ($budget) {
            flash()->error('Subcategory is used in budget');
            return response()->json(['success' => false]);
        }
        $objId = (new BudgetSubcategory())->deleteSubcategory($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
