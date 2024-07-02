<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\RoleGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class RoleGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['inputData'] = $request->all();
        return view('roleGroup.list', $data);
    }

    public function roleGroupListData(Request $request)
    {
        $data = $request->all();
        $data['search'] = $search = $request->search;
        $data['is_default'] = $is_default = $request->is_default;
        $paginate = Helper::paginate($data);
        $data['sn'] = $paginate->serial;
        $data['perPage'] = $paginate->perPage;

        $data['roleGroups'] = RoleGroup::orderBy('id', 'asc')
            ->where(function ($query) use ($search) {
                $query->orWhere('code', 'LIKE', '%' . $search . '%');
                $query->orWhere('name', 'LIKE', '%' . $search . '%');
                $query->orWhere('role_ids', 'LIKE', '%' . $search . '%');
                $query->orWhere('description', 'LIKE', '%' . $search . '%');
            })
            // ->where(function ($query) use ($is_default) {
            //     if (!is_null($is_default) && $is_default != 2) {
            //         $query->where('used_as_default', $is_default);
            //     } else {
            //         $query->whereIn('used_as_default', [0, 1]);
            //     }
            // })
            ->paginate($paginate->perPage);
        return view('roleGroup.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = Role::select('roles.id', 'roles.name')->get();
        return view('roleGroup.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code'     => 'required',
            'name'     => 'required',
            'role_ids' => 'required',
        ]);
        if ($validator->passes()) {
            $input = $request->all();
            RoleGroup::create($input);
            Toastr::success('Data Inserted Successfully');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['roleGroupInfo'] = $roleGroupInfo = RoleGroup::find($id);
        $data['roleIds'] = $rollIds = $roleGroupInfo->role_ids;
        // $data['roleIds'] = $rollIds = json_decode($roleGroupInfo->role_ids);
        $data['roles'] = Role::select('roles.id', 'roles.name')->get();
        return view('roleGroup.update', $data);
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
        $validator = Validator::make($request->all(), [
            'code'     => 'required',
            'name'     => 'required',
            'role_ids' => 'required',
        ]);
        
        if ($validator->passes()) {
            RoleGroup::find($id)->update([
                'code'        => $request->code,
                'name'        => $request->name,
                'role_ids'    => $request->role_ids,
            ]);
            Toastr::success('Role Group has been updated');
            return redirect()->back();
        } else {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
            }
            return redirect()->back()->withErrors($validator);
        }
    }

    public function setDefault(Request $request)
    {
        $roleInfo = RoleGroup::find($request->roleId);
        if (!empty($roleInfo)) {
            $roleInfo->update(['used_as_default' => !$roleInfo->used_as_default]);
            $output['messege'] = 'Role Group default status has been modified';
            $output['msgType'] = 'success';
        } else {
            $output['messege'] = 'Role Group not found';
            $output['msgType'] = 'danger';
        }
        return response()->json($output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RoleGroup::find($id)->delete();
    }
}
