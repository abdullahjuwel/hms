<?php

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
    return view('login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('login/', 'Auth\LoginController@login')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::prefix('admin')->middleware(['RoleBuzz','auth'])->group(function(){
	Route::get('/', 'Admin\DashboardController@index')->name('admin_dashboard');
	Route::get('permissions', 'Admin\Role\PermissionsController@index')->name('permissions');
	Route::get('permissions/build/{id}', 'Admin\Role\PermissionsController@buildPermission')->name('build_permission');
	Route::post('permissions/set/{id}', 'Admin\Role\PermissionsController@setPermission');
	Route::get('permissions/create-group', 'Admin\Role\PermissionsController@create')->name('create_group');
	Route::resources([
       'permissions/menu' => 'Admin\Role\MenuController',
       'patient'          => 'Admin\BackOffice\PatientController',
       'leave-type'       => 'Admin\BackOffice\HR\LeaveTypeController',
       'department'       => 'Admin\BackOffice\HR\DepartmentController',
       'designation'      => 'Admin\BackOffice\HR\DesignationController',
       'specialist'       => 'Admin\BackOffice\HR\SpecialistController',
       'hr/staff'         => 'Admin\HumanResource\StaffController',
	]);

	// Routes for Datatable
	Route::get('menu-datatable-ajax', 'Admin\Role\MenuController@menuDatatableAjax')->name('menu-datatable-ajax');
	Route::get('patient-datatable-ajax', 'Admin\BackOffice\PatientController@patientDatatableAjax')->name('patient-datatable-ajax');
	Route::get('leavetype-datatable-ajax', 'Admin\BackOffice\HR\LeaveTypeController@leaveTypeDatatableAjax')->name('leavetype-datatable-ajax');
	Route::get('dept-datatable-ajax', 'Admin\BackOffice\HR\DepartmentController@deptDatatableAjax')->name('dept-datatable-ajax');
	Route::get('desig-datatable-ajax', 'Admin\BackOffice\HR\DesignationController@desigDatatableAjax')->name('desig-datatable-ajax');
	Route::get('spec-datatable-ajax', 'Admin\BackOffice\HR\SpecialistController@specDatatableAjax')->name('spec-datatable-ajax');

    // ajax request for fetching all data
	Route::get('staff-data-ajax', 'Admin\HumanResource\StaffController@staffDataAjax')->name('staff-data-ajax');
	Route::get('hr/staff/profile/{staff_id}', 'Admin\HumanResource\StaffController@staffProfile')->name('hr/staff/profile/{staff_id}');
});

Route::get('error401', 'Admin\DashboardController@unauthorized')->name('error401');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');