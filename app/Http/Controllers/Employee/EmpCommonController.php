<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BudgetSubcategory;

class EmpCommonController extends Controller
{
    /**
     * get subcategories
     *
     * @param categoryId
     * @return view
     */
    public function getBudgetSubcategory(Request $request)
    {
        $inputs = $request->all();
        $subcategories = (new BudgetSubcategory())->getSubcategoriesByCategoryId($inputs['catId'])->toArray();
        return response()->json(['subcategories' => $subcategories]);
    }
}
