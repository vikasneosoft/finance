<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CompanyRequest;
use App\Models\Company;
use App\Models\Division;
use DataTables;

class CompanyController extends Controller
{

    /**
     * Get all companies
     *
     *
     * @return array
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $companies =  (new Company)->getCompanies();
            return Datatables::of($companies)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('company.update',  $row['id']) . '" class="edit"> <i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('admin.company.listing', ['active' => 'company']);
    }

    /**
     * load view to add company
     *
     * @return void
     */
    public function create()
    {
        return view('admin.company.add', ['active' => 'company']);
    }

    /**
     * Store company
     *
     * @param array
     * @return objectid
     */
    public function store(CompanyRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new Company())->addCompany($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit company
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {

        $company = (new Company())->getCompany($id);
        return view('admin.company.edit', ['company' => $company, 'active' => 'company']);
    }

    /**
     * update division
     *
     * @param array
     * @return view
     */
    public function update(CompanyRequest $request)
    {
        $inputs = $request->all();
        $objId = (new Company())->updateCompany($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete company
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        $division = (new Division())->getDivisionByCompnayId($request->id);
        if ($division) {
            flash()->error('Company name is used in division');
            return response()->json(['success' => false]);
        }
        $objId = (new Company())->deleteCompany($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
