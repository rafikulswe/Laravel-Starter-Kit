<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Role;
use App\Models\User;
use App\Models\Scope;
use App\Models\RoleGroup;
use App\Models\Organogram;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Organizations;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['inputData'] = $request->all();
        $data['roles'] = Role::valid()->get();
        return view('permission.create', $data);
    }

    public function getLoadPermission(Request $request)
    {
        $data['scopes'] = Scope::valid()->get();
        $data['permissions'] = Permission::valid()->where('role_id', $request->role_id)->pluck('scope_id')->toArray();
        return view('permission.loadPermission', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
        ]);
        if ($validator->passes()) {
            if(!empty($request->scope_ids)){
                Permission::valid()->where('role_id', $request->role_id)->delete();
                foreach($request->scope_ids as $scope_id){
                    Permission::create([
                        'role_id'  => $request->role_id,
                        'scope_id' => $scope_id,
                    ]);
                }
                Toastr::success('Permission Set Successfully');
            }else{
                Toastr::success('Please Select First');
            }
        } else {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
