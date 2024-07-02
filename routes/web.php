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
    return view('welcome');
});

//Login & Logout
Route::get('/', ['as' => 'login', function () {
    return redirect()->route('login');
}]);
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'getLogin'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'postLogin']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');





Route::get('destination', [App\Http\Controllers\Auth\LoginController::class, 'systemDestination'])->name('systemDestination');

// Route::group(['middleware' => 'providerAuth', 'prefix' => 'provider', 'as' => 'provider.'], function () {
Route::group(['middleware' => 'auth', 'prefix' => 'provider', 'as' => 'provider.'], function () {
    Route::get('home', [App\Http\Controllers\Auth\LoginController::class, 'home'])->name('home');

    // COMMON DROPDOWN
    Route::get('getDistrictDropdown', [App\Http\Controllers\DropdownController::class, 'getDistrictDropdown'])->name('getDistrictDropdown');
    Route::get('getUpazilaDropdown', [App\Http\Controllers\DropdownController::class, 'getUpazilaDropdown'])->name('getUpazilaDropdown');

    Route::resource('role', App\Http\Controllers\RoleController::class);
    Route::get('roleListData', [App\Http\Controllers\RoleController::class, 'roleListData'])->name('roleListData');
    Route::post('roleSetDefault', [App\Http\Controllers\RoleController::class, 'setDefault'])->name('roleSetDefault');

    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::get('userListData', [App\Http\Controllers\UserController::class, 'userListData'])->name('userListData');
    Route::get('profileEdit', [App\Http\Controllers\UserController::class, 'profileEdit'])->name('profileEdit');

    Route::resource('organization', App\Http\Controllers\OrganizationController::class);
    Route::get('organizationListData', [App\Http\Controllers\OrganizationController::class, 'organizationListData'])->name('organizationListData');

    Route::resource('organogram', App\Http\Controllers\OrganogramController::class);
    Route::get('organogramListData', [App\Http\Controllers\OrganogramController::class, 'organogramListData'])->name('organogramListData');

    Route::resource('lookup', App\Http\Controllers\LookupController::class);
    Route::get('lookupListData', [App\Http\Controllers\LookupController::class, 'lookupListData'])->name('lookupListData');

    Route::resource('location', App\Http\Controllers\LocationController::class);
    Route::get('locationListData', [App\Http\Controllers\LocationController::class, 'locationListData'])->name('locationListData');

    Route::resource('roleGroup', App\Http\Controllers\RoleGroupController::class);
    Route::get('roleGroupListData', [App\Http\Controllers\RoleGroupController::class, 'roleGroupListData'])->name('roleGroupListData');

    Route::resource('resource', App\Http\Controllers\ResourceController::class);
    Route::get('resourceListData', [App\Http\Controllers\ResourceController::class, 'resourceListData'])->name('resourceListData');

    Route::resource('scope', App\Http\Controllers\ScopeController::class);
    Route::get('scopeListData', [App\Http\Controllers\ScopeController::class, 'scopeListData'])->name('scopeListData');

    Route::resource('permission', App\Http\Controllers\PermissionController::class);
    Route::get('getLoadPermission', [App\Http\Controllers\PermissionController::class, 'getLoadPermission'])->name('getLoadPermission');


    Route::resource('example', App\Http\Controllers\ExampleController::class);
    Route::get('exampleListData', [App\Http\Controllers\ExampleController::class, 'exampleListData'])->name('exampleListData');
});
