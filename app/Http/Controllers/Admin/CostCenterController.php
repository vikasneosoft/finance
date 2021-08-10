<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CostCenterRequest;
use App\Models\CostCenter;
use DataTables;

class CostCenterController extends Controller
{
    /**
     * Get all cost centers
     *
     *
     * @return array
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $costCenters =  (new CostCenter())->getCostCenters();

            return Datatables::of($costCenters)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('cost-center.update',  $row['id']) . '" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('admin.costcenter.listing', ['active' => 'costcenter']);
    }

    /**
     * load view to add cost center
     *
     * @return void
     */
    public function create()
    {

        return view('admin.costcenter.add', ['active' => 'costcenter']);
    }

    /**
     * Store cost center
     *
     * @param array
     * @return objectid
     */
    public function store(CostCenterRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new CostCenter())->addCostCenter($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit cost center
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {
        $costCenter = (new CostCenter())->getCostCenter($id);
        return view('admin.costcenter.edit', ['costCenter' => $costCenter, 'active' => 'costcenter']);
    }

    /**
     * update cost center
     *
     * @param array
     * @return view
     */
    public function update(CostCenterRequest $request)
    {
        $inputs = $request->all();
        $objId = (new CostCenter())->updateCostCenter($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete cost center
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        /* $department = (new Department())->getDepartmentByDivisionId($request->id);
        if ($department) {
            flash()->error('Division name is used in department');
            return response()->json(['success' => false]);
        } */
        $objId = (new CostCenter())->deleteCostCenter($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
