<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProjectCodeRequest;
use App\Models\ProjectCode;
use DataTables;

class ProjectCodeController extends Controller
{
    /**
     * Get all project codes
     *
     *
     * @return array
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $projectCodes =  (new ProjectCode())->getProjectCodes();

            return Datatables::of($projectCodes)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('project-code.update',  $row['id']) . '" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('admin.projectcode.listing', ['active' => 'projectcode']);
    }

    /**
     * load view to add project code
     *
     * @return void
     */
    public function create()
    {

        return view('admin.projectcode.add', ['active' => 'projectcode']);
    }

    /**
     * Store project code
     *
     * @param array
     * @return objectid
     */
    public function store(ProjectCodeRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new ProjectCode())->addProjectCode($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit project code
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {
        $projectCode = (new ProjectCode())->getProjectCode($id);
        return view('admin.projectcode.edit', ['projectCode' => $projectCode, 'active' => 'projectcode']);
    }

    /**
     * update project code
     *
     * @param array
     * @return view
     */
    public function update(ProjectCodeRequest $request)
    {
        $inputs = $request->all();
        $objId = (new ProjectCode())->updateProjectCode($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete project code
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
        $objId = (new ProjectCode())->deleteProjectCode($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
