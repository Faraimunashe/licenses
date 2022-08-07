<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/user/dashboard', 'App\Http\Controllers\user\DashboardController@index')->name('user-dashboard');

    /* business registration */
    Route::get('/company/registration', 'App\Http\Controllers\user\CompanyRegistryController@index')->name('user-company-registry');
    Route::post('/company/registration/post', 'App\Http\Controllers\user\CompanyRegistryController@register')->name('company-register');
    Route::post('/company/director/post', 'App\Http\Controllers\user\CompanyRegistryController@post_director')->name('post-director');

    Route::get('/company/director', 'App\Http\Controllers\user\CompanyRegistryController@director')->name('company-director');

    //transactions
    Route::get('/company/transactions', 'App\Http\Controllers\user\TransactionController@index')->name('company-transactions');

    //licenses
    Route::get('/company/license', 'App\Http\Controllers\user\LicenseController@index')->name('company-license');
    Route::get('/company/download/license', 'App\Http\Controllers\user\LicenseController@license_pdf')->name('company-download-license');

    //payments
    Route::post('/company/pay/registration', 'App\Http\Controllers\user\PaymentController@registration')->name('company-pay-registration');
    Route::post('/company/pay/license', 'App\Http\Controllers\user\PaymentController@license')->name('company-pay-license');

    //company
    Route::get('/company/reports', 'App\Http\Controllers\user\ReportController@index')->name('company-reports');
});


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', 'App\Http\Controllers\admin\DashboardController@index')->name('admin-dashboard');

    //registrations
    Route::get('/admin/registrations', 'App\Http\Controllers\admin\RegistrationController@index')->name('admin-registrations');
    Route::get('/admin/approve/registration/{id}', 'App\Http\Controllers\admin\RegistrationController@approve')->name('admin-approve-registration');

    //transactions
    Route::get('/admin/transactions', 'App\Http\Controllers\admin\TransactionController@index')->name('admin-transactions');

    //companies
    Route::get('/admin/companies', 'App\Http\Controllers\admin\CompanyController@index')->name('admin-companies');

    //fees
    Route::get('/admin/payable/fees', 'App\Http\Controllers\admin\FeeController@index')->name('admin-fees');
    Route::post('/admin/update/reg-fees', 'App\Http\Controllers\admin\FeeController@update_reg')->name('admin-update-reg');
    Route::post('/admin/update/lic-fees', 'App\Http\Controllers\admin\FeeController@update_license')->name('admin-update-lic');


});

require __DIR__.'/auth.php';
