<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Division;
use App\Models\Location;
use App\Models\Department;
use App\Models\Section;
use App\Models\User;

class CommonController extends Controller
{
    /**
     * Get divisions and locations by company id
     *
     *
     * @return array
     */
    public function getDivisionsLocationsByCompanyId(Request $request)
    {
        $divisions = (new Division())->getDivisionsByCompnayId($request->companyId)->toArray();
        $locations = (new Location())->getLocationsByCompnayId($request->companyId)->toArray();
        return response()->json(['divisions' => $divisions, 'locations' => $locations]);
    }

    /**
     * Get department by division id
     *
     *
     * @return array
     */
    public function getDepartmentsByDivisionId(Request $request)
    {
        $departments = (new Department())->getDepartmentsByDivisionId($request->divisionId)->toArray();
        return response()->json(['departments' => $departments]);
    }

    /**
     * Get sections by company id
     *
     *
     * @return array
     */
    public function getSectionsByDepartmentId(Request $request)
    {
        $sections = (new Section())->getSectionsByDepartmentId($request->departmentId)->toArray();
        return response()->json(['sections' => $sections]);
    }
}
