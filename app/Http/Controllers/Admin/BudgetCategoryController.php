<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BudgetCategoryRequest;
use App\Models\BudgetCategory;
use App\Models\BudgetSubcategory;
use DataTables;

class BudgetCategoryController extends Controller
{
    /**
     * Get all categories
     *
     *
     * @return array
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories =  (new BudgetCategory)->getCategories();
            return Datatables::of($categories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('category.update',  $row['id']) . '" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.category.listing', ['active' => 'category']);
    }

    /**
     * load view to add category
     *
     * @return void
     */
    public function create()
    {
        return view('admin.category.add', ['active' => 'category']);
    }

    /**
     * Store category
     *
     * @param array
     * @return objectid
     */
    public function store(BudgetCategoryRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new BudgetCategory())->addCategory($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit category
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {

        $category = (new BudgetCategory())->getCategory($id);
        return view('admin.category.edit', ['category' => $category, 'active' => 'category']);
    }

    /**
     * update category
     *
     * @param array
     * @return view
     */
    public function update(BudgetCategoryRequest $request)
    {
        $inputs = $request->all();
        $objId = (new BudgetCategory())->updateCategory($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete category
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        $subcategory = (new BudgetSubcategory())->getSubcategoryByCategoryId($request->id);
        if ($subcategory) {
            flash()->error('Category name is used in subcategory');
            return response()->json(['success' => false]);
        }
        $objId = (new BudgetCategory())->deleteCategory($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
