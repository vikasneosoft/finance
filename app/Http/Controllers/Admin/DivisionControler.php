<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DivisionRequest;
use App\Models\Company;
use App\Models\Division;
use App\Models\Department;
use DataTables;

class DivisionControler extends Controller
{
    /**
     * Get all Divisions
     *
     *
     * @return array
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $divisions =  (new Division)->getDivisions();

            return Datatables::of($divisions)
                ->addIndexColumn()
                ->addColumn('company', function ($row) {
                    $company = $row['company']['name'];
                    return $company;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('division.update',  $row['id']) . '" class="edit"> <i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['company', 'action'])
                ->make(true);
        }


        return view('admin.division.listing', ['active' => 'division']);
    }

    /**
     * load view to add division
     *
     * @return void
     */
    public function create()
    {
        $companies = (new Company)->getCompaniesByPluck()->toArray();
        return view('admin.division.add', ['companies' => $companies, 'active' => 'division']);
    }

    /**
     * Store division
     *
     * @param array
     * @return objectid
     */
    public function store(DivisionRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new Division())->addDivision($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit division
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {
        $division = (new Division())->getDivision($id);
        $companies = (new Company)->getCompaniesByPluck()->toArray();
        return view('admin.division.edit', ['companies' => $companies, 'division' => $division, 'active' => 'division']);
    }

    /**
     * update division
     *
     * @param array
     * @return view
     */
    public function update(DivisionRequest $request)
    {
        $inputs = $request->all();
        $objId = (new Division())->updateDivision($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete division
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        $department = (new Department())->getDepartmentByDivisionId($request->id);
        if ($department) {
            flash()->error('Division name is used in department');
            return response()->json(['success' => false]);
        }
        $objId = (new Division())->deleteDivision($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
