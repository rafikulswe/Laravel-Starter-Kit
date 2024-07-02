<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['inputData'] = $request->all();
        return view('role.list', $data);
    }

    public function roleListData(Request $request)
    {
        $data = $request->all();
        $data['search'] = $search = $request->search;
        $data['is_default'] = $is_default = $request->is_default;
        $paginate = Helper::paginate($data);
        $data['sn'] = $paginate->serial;
        $data['perPage'] = $paginate->perPage;

        $data['roles'] = Role::latest()
            ->where(function ($query) use ($search) {
                $query->orWhere('code', 'LIKE', '%' . $search . '%');
                $query->orWhere('name', 'LIKE', '%' . $search . '%');
                $query->orWhere('description', 'LIKE', '%' . $search . '%');
            })
            ->where(function ($query) use ($is_default) {
                if (!is_null($is_default) && $is_default != 2) {
                    $query->where('used_as_default', $is_default);
                } elseif (isset($is_default)) {
                    $query->whereIn('used_as_default', [0, 1]);
                }
            })
            ->paginate($paginate->perPage);
        return view('role.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('role.create');
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
            'code'            => 'required',
            'name'            => 'required',
        ]);
        if ($validator->passes()) {
            Role::create([
                'code'            => $request->code,
                'name'            => $request->name,
                'description'     => $request->description,
                'used_as_default' => $request->used_as_default,
            ]);
            Toastr::success('Data Inserted Successfully');
            return redirect()->back();
        } else {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
            }
            return redirect()->back()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['roleGroup'] = Role::find($id);
        return view('role.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['role'] = Role::find($id);
        return view('role.update', $data);
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
            'code'            => 'required',
            'name'            => 'required',
        ]);
        if ($validator->passes()) {
            Role::find($id)->update([
                'code'            => $request->code,
                'name'            => $request->name,
                'description'     => $request->description,
                'used_as_default' => $request->used_as_default,
            ]);
            Toastr::success('Role has been updated');
            return redirect()->back();
        } else {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                Log::info($message);
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
            }
            return redirect()->back()->withErrors($validator);
        }
    }

    public function setDefault(Request $request)
    {
        $roleInfo = Role::find($request->roleId);
        if (!empty($roleInfo)) {
            $roleInfo->update(['used_as_default' => !$roleInfo->used_as_default]);
            $output['messege'] = 'Role default status has been modified';
            $output['msgType'] = 'success';
        } else {
            $output['messege'] = 'Role not found';
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
        Role::find($id)->delete();
    }
}
