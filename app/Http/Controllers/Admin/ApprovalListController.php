<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ApprovalListRequest;
use App\Models\ApprovalList;
use App\Models\User;
use DataTables;

class ApprovalListController extends Controller
{

    /**
     * Get all Approval Lists
     *
     * @return array
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $approvalLists =  (new ApprovalList())->getApprovalLists();
            return Datatables::of($approvalLists)
                ->addIndexColumn()
                ->addColumn('employe', function ($row) {
                    $employe = $row['employe']['name'];
                    return $employe;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('approval-list.update',  $row['id']) . '" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['employe', 'action'])
                ->make(true);
        }


        return view('admin.approvallist.listing', ['active' => 'approvallist']);
    }

    /**
     * load view to add Approval List
     *
     * @return void
     */
    public function create()
    {
        $employes = (new User())->getEmployeByPluck()->toArray();
        $employesEmails = (new User())->getEmployeEmailsByPluck()->toArray();
        return view('admin.approvallist.add', ['employesEmails' => $employesEmails, 'employes' => $employes, 'active' => 'approvallist']);
    }

    /**
     * Store Approval List
     *
     * @param array
     * @return objectid
     */
    public function store(ApprovalListRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new ApprovalList())->addApprovalList($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit Approval List
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {
        $approvalList = (new ApprovalList())->getApprovalList($id);
        $employes = (new User())->getEmployeByPluck()->toArray();
        $employesEmails = (new User())->getEmployeEmailsByPluck()->toArray();
        return view('admin.approvallist.edit', ['employesEmails' => $employesEmails, 'employes' => $employes, 'approvalList' => $approvalList, 'active' => 'approvallist']);
    }

    /**
     * update Approval List
     *
     * @param array
     * @return view
     */
    public function update(ApprovalListRequest $request)
    {
        $inputs = $request->all();
        $objId = (new ApprovalList())->updateApprovalList($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete Approval List
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        /*  $division = (new Division())->getDivisionByCompnayId($request->id);
        if ($division) {
            flash()->error('Company name is used in division');
            return response()->json(['success' => false]);
        } */
        $objId = (new ApprovalList())->deleteApprovalList($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
