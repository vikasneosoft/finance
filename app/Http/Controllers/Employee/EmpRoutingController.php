<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rounting;
use Auth;
class EmpRoutingController extends Controller
{
    public function getRouting(){

        $routings =(new Rounting())->getRountingByEmployeeId
        (Auth::user()->id)->toArray();
        //echo "<pre>"; print_r($routings); die('s');
        return view('employee.routings.listing', ['routings' => $routings, 'active' => 'routing']);
    }
}
