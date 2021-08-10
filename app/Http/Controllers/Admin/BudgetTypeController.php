<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BudgetTypeRequest;
use App\Models\BudgetType;
use App\Models\Division;
use DataTables;

class BudgetTypeController extends Controller
{
    /**
     * Get all budget types
     *
     *
     * @return array
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $companies =  (new BudgetType)->getBudgetTypes();
            return Datatables::of($companies)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('budget-type.update',  $row['id']) . '" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('admin.budgettype.listing', ['active' => 'budgettype']);
    }

    /**
     * load view to add budget type
     *
     * @return void
     */
    public function create()
    {
        return view('admin.budgettype.add', ['active' => 'budgettype']);
    }

    /**
     * Store budget type
     *
     * @param array
     * @return objectid
     */
    public function store(BudgetTypeRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new BudgetType())->addBudgetType($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit budget type
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {

        $budgetType = (new BudgetType())->getBudgetType($id);
        return view('admin.budgettype.edit', ['budgetType' => $budgetType, 'active' => 'budgettype']);
    }

    /**
     * update budget type
     *
     * @param array
     * @return view
     */
    public function update(BudgetTypeRequest $request)
    {
        $inputs = $request->all();
        $objId = (new BudgetType())->updateBudgetType($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete budget type
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        /*  $division = (new Division())->getDivisionByCompnayId($request->id);
        if ($division) {
            flash()->error('BudgetType name is used in division');
            return response()->json(['success' => false]);
        } */
        $objId = (new BudgetType())->deleteBudgetType($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
