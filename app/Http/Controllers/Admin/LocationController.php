<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\LocationRequest;
use App\Models\Company;
use App\Models\Location;
use App\Models\Department;
use DataTables;

class LocationController extends Controller
{
    /**
     * Get all locations
     *
     *
     * @return array
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $locations =  (new Location)->getLocations();
            /* echo "<pre>";
            print_r($divisions->toArray());
            die('here'); */
            return Datatables::of($locations)
                ->addIndexColumn()
                ->addColumn('company', function ($row) {
                    $company = $row['company']['name'];
                    return $company;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('location.update',  $row['id']) . '" class="edit"> <i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['company', 'action'])
                ->make(true);
        }
        return view('admin.location.listing', ['active' => 'location']);
    }

    /**
     * load view to add location
     *
     * @return void
     */
    public function create()
    {
        $companies = (new Company)->getCompaniesByPluck()->toArray();
        return view('admin.location.add', ['companies' => $companies, 'active' => 'location']);
    }

    /**
     * Store location
     *
     * @param array
     * @return objectid
     */
    public function store(LocationRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new Location())->addLocation($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit location
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {
        $location = (new Location())->getLocation($id);
        $companies = (new Company)->getCompaniesByPluck()->toArray();
        return view('admin.location.edit', ['companies' => $companies, 'location' => $location, 'active' => 'location']);
    }

    /**
     * update location
     *
     * @param array
     * @return view
     */
    public function update(LocationRequest $request)
    {
        $inputs = $request->all();
        $objId = (new Location())->updateLocation($inputs);
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
        $objId = (new Location())->deleteLocation($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
