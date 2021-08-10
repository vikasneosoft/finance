<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Auth\ForgotPasswordController;

/* Admin */
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DivisionControler;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\BudgetTypeController;
use App\Http\Controllers\Admin\BudgetCategoryController;
use App\Http\Controllers\Admin\BudgetSubcategoryController;
use App\Http\Controllers\Admin\DepartmentControler;
use App\Http\Controllers\Admin\SectionControler;
use App\Http\Controllers\Admin\EmployeControler;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\BudgetController;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Admin\ApprovalListController;
use App\Http\Controllers\Admin\ProjectCodeController;
use App\Http\Controllers\Admin\CostCenterController;
use App\Http\Controllers\Admin\FinancialYearController;
use App\Http\Controllers\Admin\RountingController;


/* Employee */
use App\Http\Controllers\Employee\EmpDashboardController;
use App\Http\Controllers\Employee\EmpBudgetController;
use App\Http\Controllers\Employee\EmpCommonController;
use App\Http\Controllers\Employee\EmpExpensiveController;
use App\Http\Controllers\Employee\EmpManageExpensesController;
use App\Http\Controllers\Employee\EmpRoutingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('welcome');
})->name('home');

//Auth::routes();
Route::post('/login', [LoginController::class, 'login'])->name('login');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::any('/logout', [LoginController::class, 'logout'])->name('employee.logout');

Route::get('/reset-password', [ForgotPasswordController::class, 'resetPasswordView'])->name('resetPassword.view');
Route::post('/send-link', [ForgotPasswordController::class, 'sendLink'])->name('resetPassword.send_link');
Route::any('/password-verify-link', [ForgotPasswordController::class, 'passwordVerifyLink'])->name('resetPassword.password_verify_link');
Route::post('/reset-password-final-step', [ForgotPasswordController::class, 'resetPasswordFinalStep'])->name('resetPassword.reset_password_final_step');

Route::get('/get-divisions--locations-bycompany', [CommonController::class, 'getDivisionsLocationsByCompanyId'])->name('common.get_divisions_locations_by_company');
Route::get('/get-departments-division', [CommonController::class, 'getDepartmentsByDivisionId'])->name('common.get_departments_by_division');
Route::get('/get-sections-bycompany', [CommonController::class, 'getSectionsByDepartmentId'])->name('common.get_sections_by_department');



Route::group(['middleware' => ['web']], function () {
    Route::get('/admin/login', [AdminLoginController::class, 'getAdminLogin'])->name('adminLogin');
    Route::post('admin/login', [AdminLoginController::class, 'adminAuth'])->name('admin.auth');
    Route::any('adminlogout', [AdminLoginController::class, 'adminlogout'])->name('admin.logout');
    Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/changePasswordView', [AdminController::class, 'changePasswordView'])->name('admin.changePasswordView');
        Route::post('/changePassword', [AdminController::class, 'changePassword'])->name('admin.changePassword');
        Route::resource('company', CompanyController::class);
        Route::resource('division', DivisionControler::class);
        Route::resource('location', LocationController::class);
        Route::resource('department', DepartmentControler::class);
        Route::resource('budget-type', BudgetTypeController::class);
        Route::resource('category', BudgetCategoryController::class);
        Route::resource('subcategory', BudgetSubcategoryController::class);
        Route::resource('section', SectionControler::class);
        Route::resource('employe', EmployeControler::class);
        Route::resource('approval-list', ApprovalListController::class);
        Route::resource('rounting', RountingController::class);

        Route::resource('supplier', SupplierController::class);
        Route::resource('budgets', BudgetController::class);
        Route::resource('project-code', ProjectCodeController::class);
        Route::resource('cost-center', CostCenterController::class);
        Route::resource('financial-year', FinancialYearController::class);
        Route::get('/view-to-add-detail-budget', [BudgetController::class, 'viewToAddBudget'])->name('budgets.add_budget_view');
        Route::post('/add-budget', [BudgetController::class, 'addBudget'])->name('budgets.add_budget');
        Route::get('/get-budget-subcategory', [BudgetController::class, 'getBudgetSubcategory'])->name('budgets.get_subcategory');
        Route::get('/budget-detail-edit-view', [BudgetController::class, 'budgetDetailEditView'])->name('budgets.budget_detail_edit_view_route');
        Route::post('/budget-update', [BudgetController::class, 'update'])->name('budget_details.update');
        Route::post('/delete-budget-detail', [EmpBudgetController::class, 'deleteBudgetDetail'])->name('budget_details.delete');
        //Route::get('/get-budget-subcategory', [BudgetController::class, 'getBudgetSubcategory'])->name('budget.get_subcategory');

        /*Email Template*/
        Route::get('/getEmailTemplates', [EmailTemplateController::class, 'getEmailTemplates'])->name('admin.getEmailTemplates');
        Route::get('/viewAddEmailTemplate', [EmailTemplateController::class, 'viewAddEmailTemplate'])->name('admin.viewAddEmailTemplate');
        Route::post('/addEmailTemplate', [EmailTemplateController::class, 'addEmailTemplate'])->name('admin.addEmailTemplate');
        Route::get('/viewEditEmailTemplate/{id}', [EmailTemplateController::class, 'viewEditEmailTemplate'])->name('admin.viewEditEmailTemplate');
        Route::post('/editEmailTemplate', [EmailTemplateController::class, 'editEmailTemplate'])->name('admin.editEmailTemplate');
        Route::post('/deleteEmailTemplate', [EmailTemplateController::class, 'deleteEmailTemplate'])->name('admin.deleteEmailTemplate');
    });

    Route::group(['middleware' => ['user'], 'prefix' => 'employee'], function () {
        Route::get('/dashboard', [EmpDashboardController::class, 'dashboard'])->name('employee.dashboard');
        Route::resource('budget', EmpBudgetController::class);
        Route::get('/list-budget', [EmpBudgetController::class, 'getBudgets'])->name('budget.get_budgets');
        Route::get('/budget-detail/{id}', [EmpBudgetController::class, 'budgetDetail'])->name('budget.budget_detail');
        Route::get('/budget/{id}', [EmpBudgetController::class, 'show'])->name('budget.show');
        Route::get('/budget-view/{id}', [EmpBudgetController::class, 'view'])->name('budget.view');
        Route::post('/budget-update', [EmpBudgetController::class, 'updateBudgetDetail'])->name('budget_detail.update');
        Route::get('/get-budget-subcategory', [EmpCommonController::class, 'getBudgetSubcategory'])->name('common.get_subcategory');
        Route::get('/view-to-add-budget', [EmpBudgetController::class, 'viewAddBudget'])->name('budget.add_budget_view');
        Route::post('/add-budget', [EmpBudgetController::class, 'addBudget'])->name('budget.add_budget');
        Route::get('/budget-detail-edit-view', [EmpBudgetController::class, 'budgetDetailEditView'])->name('budget.budget_detail_edit_view_route');
        Route::post('/delete-budget-detail', [EmpBudgetController::class, 'deleteBudgetDetail'])->name('budget_detail.delete');


        Route::get('/add-expenses/{id}', [EmpExpensiveController::class, 'viewAddExpensive'])->name('expensive.view_add_expensive');
        Route::post('/add-expenses', [EmpExpensiveController::class, 'store'])->name('expensive.add_expensive');
        Route::post('/update-expenses', [EmpExpensiveController::class, 'update'])->name('expensive.update_expensive');
        Route::post('/delete-expenses', [EmpExpensiveController::class, 'destroy'])->name('expensive.delete');

        Route::get('/expenses/{id}', [EmpExpensiveController::class, 'getExpenses'])->name('expenses.get_expenses');
        //        Route::get('/expense-detail/{id}', [EmpExpensiveController::class, 'getExpenseDetail'])->name('expenses.expense_detail');
        Route::get('/edit-expenses/{id}', [EmpExpensiveController::class, 'viewToEditExpenses'])->name('expenses.view_to_edit_expenses');
        Route::get('/add-expenses-detail', [EmpExpensiveController::class, 'viewToAddExpensiveDetail'])->name('expensive.view_add_expensive_detail');
        Route::post('/add-expenses-detail', [EmpExpensiveController::class, 'addExpensiveDetail'])->name('expensive.add_expensive_detail');
        Route::any('/expenses-detail-edit-view', [EmpExpensiveController::class, 'viewToEditExpeniveDetail'])->name('expensive_detail.expensive_detail_edit_view');
        Route::post('/update-expenses-detail', [EmpExpensiveController::class, 'updateExpensiveDetail'])->name('expensive_detail.update_expensive_detail');
        Route::post('/delete-expenses-detail', [EmpExpensiveController::class, 'deleteExpensiveDetail'])->name('expensive_detail.delete');
        Route::post('/submit-expenses', [EmpExpensiveController::class, 'submitExpenses'])->name('expenses.submit_expenses');

        Route::get('/get-submited-expenses-by-employee', [EmpManageExpensesController::class, 'getSubmitedExpenseByEmployee'])->name('expenses.get_submited_expenses_by_employee');
        Route::get('/get-submited-expenses/{id}', [EmpManageExpensesController::class, 'getSubmitedExpenses'])->name('expenses.get_submited_expenses_for_approval');
        Route::get('/expenses-detail-by-employee/{id}', [EmpManageExpensesController::class, 'expensesDetailByEmployee'])->name('expenses.expenses_detail_by_employee');
        Route::post('/approve-expenses', [EmpManageExpensesController::class, 'approveExpenses'])->name('expenses.approve_expense');
        Route::post('/reject-expensees', [EmpManageExpensesController::class, 'rejectExpensees'])->name('expenses.reject_expensees');
        Route::get('/all-expenses', [EmpManageExpensesController::class, 'allExpenses'])->name('expenses.all_expenses');
        Route::get('/all-expenses-detail/{id}', [EmpManageExpensesController::class, 'allExpensesDetail'])->name('expenses.all_expenses_detail');
        Route::get('/print-preview/{id}', [EmpManageExpensesController::class, 'printPreview'])->name('expenses.print_preview');

        Route::get('/get-submited-expenses', [EmpExpensiveController::class, 'getSubmitedExpenses'])->name('expenses.get_submited_expenses');
        Route::get('/submited-expenses-detail/{id}', [EmpExpensiveController::class, 'getSubmitedExpensesDetail'])->name('expenses.get_submited_expenses_detail');
        Route::post('/clone-expense', [EmpExpensiveController::class, 'cloneExpense'])->name('expenses.clone_expense');
        Route::get('/routing-list', [EmpRoutingController::class, 'getRouting'])->name('employee.routing_list');
    });
});
