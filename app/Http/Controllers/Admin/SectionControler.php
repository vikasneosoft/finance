<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SectionRequest;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Section;
use App\Models\User;
use DataTables;

class SectionControler extends Controller
{

    /**
     * Get all sections
     *
     *
     * @return array
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sections =  (new Section)->getSections();
            return Datatables::of($sections)
                ->addIndexColumn()
                ->addColumn('department', function ($row) {
                    $department = $row['department']['name'];
                    return $department;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('section.update',  $row['id']) . '" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['department', 'action'])
                ->make(true);
        }


        return view('admin.section.listing', ['active' => 'section']);
    }

    /**
     * load view to add section
     *
     * @return void
     */
    public function create()
    {
        $departments = (new Department)->getDepartmentsByPluck()->toArray();
        return view('admin.section.add', ['departments' => $departments, 'active' => 'section']);
    }

    /**
     * Store division
     *
     * @param array
     * @return objectid
     */
    public function store(SectionRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new Section())->addSection($inputs);
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
        $section = (new Section())->getSection($id);
        $departments = (new Department)->getDepartmentsByPluck()->toArray();
        return view('admin.section.edit', ['departments' => $departments, 'section' => $section, 'active' => 'section']);
    }

    /**
     * update section
     *
     * @param array
     * @return view
     */
    public function update(SectionRequest $request)
    {
        $inputs = $request->all();
        $objId = (new Section())->updateSection($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete section
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        $employe = (new User())->getEmployeBySectionId($request->id);
        if ($employe) {
            flash()->error('Section is used in employe');
            return response()->json(['success' => false]);
        }
        $objId = (new Section())->deleteSection($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
