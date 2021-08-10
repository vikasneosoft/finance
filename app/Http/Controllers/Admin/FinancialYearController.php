<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FinancialYearRequest;
use App\Models\FinancialYear;
use DataTables;

class FinancialYearController extends Controller
{
    /**
     * Get all financial years
     *
     *
     * @return array
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $divisions =  (new FinancialYear())->getFinancialYears();

            return Datatables::of($divisions)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('financial-year.update',  $row['id']) . '" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('admin.financialyear.listing', ['active' => 'financialyear']);
    }

    /**
     * load view to add financial year
     *
     * @return void
     */
    public function create()
    {
        return view('admin.financialyear.add', ['active' => 'financialyear']);
    }

    /**
     * Store financial year
     *
     * @param array
     * @return objectid
     */
    public function store(FinancialYearRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new FinancialYear())->addFinancialYear($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit financial year
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {
        $financialYear = (new FinancialYear())->getFinancialYear($id);
        return view('admin.financialyear.edit', ['financialYear' => $financialYear, 'active' => 'financialyear']);
    }

    /**
     * update financial year
     *
     * @param array
     * @return view
     */
    public function update(FinancialYearRequest $request)
    {
        $inputs = $request->all();
        $objId = (new FinancialYear())->updateFinancialYear($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete financial year
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
        $objId = (new FinancialYear())->deleteFinancialYear($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
