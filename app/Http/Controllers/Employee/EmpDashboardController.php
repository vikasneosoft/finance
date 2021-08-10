<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Views\CategorySubcategoryStatus;
use App\Models\Views\CategoryStatus;
use App\Models\Views\TypeWiseBudget;
use App\Models\Budget;
use Auth;
use DataTables;
use DB;
use App\Jobs\SendEmailJob;
class EmpDashboardController extends Controller
{
    public function dashboard()
    {

        $send_mail = 'vikdhr@yopmail.com';
        $emailData = ['email'=>'vikdeveloper@yopmail.com','name'=>Auth::user()->name];
        //echo "<pre>"; print_r($emailData ); die('sd');
        //dispatch(new SendEmailJob($emailData));
        //die('ddd');
       /*  $email="vikdeveloper@yopmail.com";
        $name = "vikas";
        $password = "123";
        sendCredentialsToDocor($email, $name, $password);
        die('here');
 */

        $budgets = Budget::with('budgetSum', 'expensesSum')->join('budget_details', 'budget_details.budget_id', '=', 'budgets.id')
            ->join('budget_categories', 'budget_categories.id', '=', 'budget_details.budget_category_id')
            ->join('budget_types', 'budget_types.id', '=', 'budgets.budget_type_id')
            ->select('budgets.id', 'budgets.budget_type_id', 'budget_category_id', 'budget_subcategory_id', 'budget_categories.name as cat_name', 'budget_types.name')
            /* ->select('budgets.id', 'budgets.employee_id', 'budgets.company_id', 'budgets.location_id', 'budgets.division_id', 'budgets.department_id', 'budgets.section_id', 'budgets.financial_year', 'budgets.budget_type_id', 'budget_category_id', 'budget_subcategory_id', 'budget_categories.name as cat_name', 'budget_types.name') */
            ->get()
            //->groupBy('budgets.budget_type_id')
            ->groupBy('budget_category_id')
            ->toArray();
        /*  echo "<pre>";
        print_r($budgets);
        die('here'); */

        $company_id = Auth::user()->company_id;
        $location_id = Auth::user()->location_id;
        $division_id = Auth::user()->division_id;
        $department_id = Auth::user()->department_id;
        $section_id = Auth::user()->section_id;
        if ($location_id == 0) {
            $location_id = NULL;
        }
        if ($division_id == 0) {
            $division_id = NULL;
        }

        if ($department_id == 0) {
            $department_id = NULL;
        }
        if ($section_id == 0) {
            $section_id = NULL;
        }
        $catSubCatStatus =  (new CategorySubcategoryStatus())->getData($company_id, $location_id, $division_id, $department_id, $section_id)->toArray();

        $categoryStatus = (new CategoryStatus())->getData($company_id, $location_id, $division_id, $department_id, $section_id)->toArray();
        $typeStatus = (new TypeWiseBudget())->getData($company_id, $location_id, $division_id, $department_id, $section_id)->toArray();
       // echo "<pre>"; print_r($categoryStatus); die('here');
        // $user = findUnderWorkingEmployee();
        $user = findUpperLevelUser();
        //echo Auth::user()->section_id;
        //die('her');
        //echo "<pre>";
        //print_r($user->toArray());
        //die('here');
        //$workingEmployess  = (new User())->getUnderWorkingEmploye($company, $department);

        /*  echo "<pre>";
        print_r($workingEmployess); */

        //$rounting = Rounting::where(array('manager_id' => $user->id))->first();
        //echo "<pre>";
        //print_r($rounting->toArray());
        //die('d');

        return view('employee.dashboard', ['categoryStatus' => $categoryStatus, 'catSubCatStatus' => $catSubCatStatus, 'typeStatus' => $typeStatus, 'active' => 'dashboard']);
    }
}
