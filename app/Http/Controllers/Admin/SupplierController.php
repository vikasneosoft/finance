<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SupplierRequest;

use App\Models\Supplier;
use DataTables;

class SupplierController extends Controller
{
    /**
     * Get all suppliers
     *
     *
     * @return array
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $suppliers =  (new Supplier())->getSuppliers();
            return Datatables::of($suppliers)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('supplier.update',  $row['id']) . '" class="edit"><i class="far fa-edit" style="font-size: 20px;"></i></a>
                    <a data-id="' . $row['id'] . '" href="#" class="delete"><i class="fas fa-trash-alt" style="font-size: 20px;"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('admin.supplier.listing', ['active' => 'supplier']);
    }

    /**
     * load view to add supplier
     *
     * @return void
     */
    public function create()
    {
        return view('admin.supplier.add', ['active' => 'supplier']);
    }

    /**
     * Store supplier
     *
     * @param array
     * @return objectid
     */
    public function store(SupplierRequest $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new Supplier())->addSupplier($inputs);
        if ($objId) {
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * load view to edit supplier
     *
     * @param  $id
     * @return view
     */
    public function show($id)
    {
        $supplier = (new Supplier())->getSupplier($id);
        return view('admin.supplier.edit', ['supplier' => $supplier, 'active' => 'supplier']);
    }

    /**
     * update supplier
     *
     * @param array
     * @return view
     */
    public function update(SupplierRequest $request)
    {
        $inputs = $request->all();
        $objId = (new Supplier())->updateSupplier($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }


    /**
     * delete supplier
     *
     * @param id
     * @return true||false
     */
    public function destroy(Request $request)
    {
        $objId = (new Supplier())->deleteSupplier($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
