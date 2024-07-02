<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Role;
use App\Models\User;
use App\Models\RoleGroup;
use App\Models\Organogram;
use Illuminate\Http\Request;
use App\Models\Organizations;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['inputData'] = $request->all();
        return view('user.list', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userListData(Request $request)
    {
        $data = $request->all();
        $data['search'] = $search = $request->search;
        $data['role_group_id'] = $role_group_id = $request->role_group_id;
        $paginate = Helper::paginate($data);
        $data['sn'] = $paginate->serial;
        $data['perPage'] = $paginate->perPage;
        $data['roleGroups'] = RoleGroup::get();

        $data['users'] = User::join('role_groups', 'role_groups.id', '=', 'users.role_group_id')
            ->join('organizations', 'organizations.id', '=', 'users.organization_id')
            ->select('users.*', 'role_groups.name as roleName', 'organizations.name as organizationName')
            ->where(function ($query) use ($search) {
                $query->orWhere('users.organization_id', 'LIKE', '%' . $search . '%');
                $query->orWhere('users.organogram_ids', 'LIKE', '%' . $search . '%');
                $query->orWhere('role_groups.name', 'LIKE', '%' . $search . '%');
                $query->orWhere('users.name', 'LIKE', '%' . $search . '%');
                $query->orWhere('users.email', 'LIKE', '%' . $search . '%');
            })
            ->where(function ($query) use ($role_group_id) {
                if (!is_null($role_group_id)) {
                    $query->where('users.role_group_id', $role_group_id);
                }
            })
            ->paginate($paginate->perPage);
        return view('user.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = RoleGroup::select('id', 'name')->get();
        $data['organizations'] = Organizations::select('id', 'name')->get();
        $data['organograms'] = Organogram::select('id', 'name')->get();
        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'role_group_id' => 'required',
            'name'          => 'required',
            'email'         => 'required|email|unique:users',
            'password'      => 'required',
        ]);
        if ($Validator->passes()) {
            User::create([
                'organization_id' => $request->organization_id,
                'organogram_ids'  => $request->organogram_ids,
                'role_group_id'   => $request->role_group_id,
                'name'            => $request->name,
                'email'           => $request->email,
                'phone'           => $request->phone,
                'password'        => Hash::make($request->password)
            ]);
            Toastr::success('Data Inserted Successfully');
        } else {
            $messages = $Validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = User::find($id);
        return view('user.view', $data);
    }

    public function profileEdit()
    {
        $authId = Auth::guard('provider')->id();
        $data['userProfile'] = User::find($authId);
        return view('user.myProfile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['organizations'] = Organizations::select('id', 'name')->get();
        $data['organograms'] = Organogram::select('id', 'name')->get();
        $data['roleGroups'] = RoleGroup::select('id', 'name')->get();
        return view('user.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Validator = Validator::make($request->all(), [
            'role_group_id' => 'required',
            'name'          => 'required',
            'email'         => 'required',
        ]);
        if ($Validator->passes()) {
            User::find($id)->update([
                'organization_id' => $request->organization_id,
                'organogram_ids'  => $request->organogram_ids,
                'role_group_id'   => $request->role_group_id,
                'name'            => $request->name,
                'email'           => $request->email,
                'phone'           => $request->phone,
                'password'        => Hash::make($request->password)
            ]);
            Toastr::success('User has been updated');
            return redirect()->back();
        } else {
            $messages = $Validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
            }
            return redirect()->back()->withErrors($Validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
    }
}
