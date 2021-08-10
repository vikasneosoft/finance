<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\EmployRequest;
use App\Models\User;
use App\Models\Company;
use App\Models\Division;
use App\Models\Location;
use App\Models\Department;
use App\Models\Section;
use App\Models\ApprovalList;
use DataTables;

class EmployeControler extends Controller
{
    /**
     * Get all employes
     *
     *
     * @return array
     */
    public function index(Request $request)
    {
        $employes =  (new User())->getEmployes();
        /*  echo "<pre>";
        print_r($employes->toArray());
        die('here'); */
        if ($request->ajax()) {
            $employes =  (new User())->getEmployes();
            return Datatables::of($employes)
                ->addIndexColumn()
                ->addColumn('company', function ($row) {
                    $company = (isset($row['company']['name'])) ? $row['company']['name'] : '--';
                    return $company;
                })
                ->addColumn('location', function ($row) {
                    $location = (isset($row['location']['name'])) ? $row['location']['name'] : '--';
                    return $location;
                })
                ->addColumn('division', function ($row) {
                    $division = (isset($row['division']['name'])) ? $row['division']['name'] : '--';
                    return $division;
                })
                ->addColumn('department', function ($row) {
                    $department = (isset($row['department']['name'])) ? $row['department']['name'] : '--';
                    return $department;
                })
                ->addColumn('section', function ($row) {
                    $section = (isset($row['section']['name'])) ? $row['section']['name'] : '--';
                    return $section;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('employe.update',  $row['id']) . '" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['company', 'location', 'division', 'department', 'section', 'action'])
                ->make(true);
        }


        return view('admin.employe.listing', ['active' => 'employe']);
    }

    /**
     * load view to add employe
     *
     * @return void
     */
    public function create()
    {
        $companies = (new Company)->getCompaniesByPluck()->toArray();
        return view('admin.employe.add', ['companies' => $companies,  'active' => 'employe']);
    }

    /**
     * Store employe
     *
     * @param array
     * @return objectid
     */
    public function store(EmployRequest $request)
    {
        $inputs = $request->all();
        $inputs['location_id'] = (!empty($inputs['location_id'])) ? $inputs['location_id'] : 0;
        $inputs['division_id'] = (!empty($inputs['division_id'])) ? $inputs['division_id'] : 0;
        $inputs['department_id'] = (!empty($inputs['department_id'])) ? $inputs['department_id'] : 0;
        $inputs['section_id'] = (!empty($inputs['section_id'])) ? $inputs['section_id'] : 0;
        unset($inputs['_token']);
        $password = $inputs['password'];
        $inputs['password'] = bcrypt($password);
        $objId = (new User())->addEmploye($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit employe
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {
        $employe = (new User())->getEmploye($id);
        $companies = (new Company)->getCompaniesByPluck()->toArray();
        $divisions = (new Division())->getDivisionsByCompnayId($employe->company_id)->toArray();
        $locations = (new Location())->getLocationsByCompnayId($employe->company_id)->toArray();
        $departments = (new Department())->getDepartmentsByDivisionId($employe->division_id)->toArray();
        $sections = (new Section())->getSectionsByDepartmentId($employe->department_id)->toArray();
        return view('admin.employe.edit', ['companies' => $companies, 'divisions' => $divisions, 'locations' => $locations, 'departments' => $departments, 'sections' => $sections, 'employe' => $employe, 'active' => 'employe']);
    }

    /**
     * update employe
     *
     * @param array
     * @return view
     */
    public function update(EmployRequest $request)
    {
        $inputs = $request->all();
        $inputs['location_id'] = (!empty($inputs['location_id'])) ? $inputs['location_id'] : 0;
        $inputs['division_id'] = (!empty($inputs['division_id'])) ? $inputs['division_id'] : 0;
        $inputs['department_id'] = (!empty($inputs['department_id'])) ? $inputs['department_id'] : 0;
        $inputs['section_id'] = (!empty($inputs['section_id'])) ? $inputs['section_id'] : 0;
        $objId = (new User())->updateEmploye($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete employe
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        $approvalList = (new ApprovalList())->getApprovalListByUserId($request->id);
        if ($approvalList) {
            flash()->error('This user has assigned aapproval list');
            return response()->json(['success' => false]);
        }
        $objId = (new User())->deleteEmploye($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
