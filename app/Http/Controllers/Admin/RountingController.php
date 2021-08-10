<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rounting;
use App\Models\Company;
use App\Models\User;
use DataTables;

class RountingController extends Controller
{
    /**
     * Get all rountings
     *
     *
     * @return array
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $locations =  (new Rounting)->getRountings();

            return Datatables::of($locations)
                ->addIndexColumn()
                ->addColumn('manager', function ($row) {
                    $manager = $row['manager']['name'];
                    return $manager;
                })
                ->addColumn('employee', function ($row) {
                    $employee = $row['employee']['name'];
                    return $employee;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('rounting.update',  $row['id']) . '" class="edit"> <i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['manager', 'employee', 'action'])
                ->make(true);
        }
        return view('admin.rounting.listing', ['active' => 'rounting']);
    }

    /**
     * load view to add rounting
     *
     * @return void
     */
    public function create()
    {
        $companies = (new Company)->getCompaniesByPluck()->toArray();
        $employes = (new User())->getEmployeByPluck()->toArray();
        $employesEmails = (new User())->getEmployeEmailsByPluck()->toArray();
        return view('admin.rounting.add', ['companies' => $companies, 'employes' => $employes, 'employesEmails' => $employesEmails, 'active' => 'rounting']);
    }

    /**
     * Store rounting
     *
     * @param array
     * @return objectid
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new Rounting())->addRounting($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit rounting
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {
        $rounting = (new Rounting())->getRounting($id);
        $employes = (new User())->getEmployeByPluck()->toArray();
        $employesEmails = (new User())->getEmployeEmailsByPluck()->toArray();
        return view('admin.rounting.edit', ['employes' => $employes, 'employesEmails' => $employesEmails, 'rounting' => $rounting, 'active' => 'rounting']);
    }

    /**
     * update rounting
     *
     * @param array
     * @return view
     */
    public function update(Request $request)
    {
        $inputs = $request->all();
        $objId = (new Rounting())->updateRounting($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete rounting
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        $objId = (new Rounting())->deleteRounting($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
