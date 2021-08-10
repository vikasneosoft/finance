<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DepartmentRequest;
use App\Models\Department;
use App\Models\Division;
use App\Models\Section;
use DataTables;

class DepartmentControler extends Controller
{
    /**
     * Get all departments
     *
     *
     * @return array
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $departments =  (new Department)->getDepartments();

            return Datatables::of($departments)
                ->addIndexColumn()
                ->addColumn('division', function ($row) {
                    $division = $row['division']['name'];
                    return $division;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('department.update',  $row['id']) . '" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete">                <i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['division', 'action'])
                ->make(true);
        }


        return view('admin.department.listing', ['active' => 'department']);
    }

    /**
     * load view to add permission
     *
     * @return void
     */
    public function create()
    {
        $divisions = (new Division)->getDivisionsByPluck()->toArray();
        return view('admin.department.add', ['divisions' => $divisions, 'active' => 'department']);
    }

    /**
     * Store division
     *
     * @param array
     * @return objectid
     */
    public function store(DepartmentRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new Department())->addDepartment($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit department
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {
        $department = (new Department())->getDepartment($id);
        $divisions = (new Division)->getDivisionsByPluck()->toArray();
        return view('admin.department.edit', ['divisions' => $divisions, 'department' => $department, 'active' => 'department']);
    }

    /**
     * update department
     *
     * @param array
     * @return view
     */
    public function update(DepartmentRequest $request)
    {
        $inputs = $request->all();
        $objId = (new Department())->updateDepartment($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete department
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        $section = (new Section())->getSectionByDepartmentId($request->id);
        if ($section) {
            flash()->error('Department name is used in section');
            return response()->json(['success' => false]);
        }
        $objId = (new Department())->deleteDepartment($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
