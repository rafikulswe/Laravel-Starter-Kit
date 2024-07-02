<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Scope;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class ScopeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['inputData'] = $request->all();
        return view('scope.list', $data);
    }

    public function scopeListData(Request $request)
    {
        $data = $request->all();
        $data['search'] = $search = $request->search;
        $data['is_default'] = $is_default = $request->is_default;
        $paginate = Helper::paginate($data);
        $data['sn'] = $paginate->serial;
        $data['perPage'] = $paginate->perPage;

        $data['scopes'] = Scope::orderBy('id', 'asc')
            ->where(function ($query) use ($search) {
                $query->orWhere('resource_id', 'LIKE', '%' . $search . '%');
                $query->orWhere('scope', 'LIKE', '%' . $search . '%');
                $query->orWhere('display_name', 'LIKE', '%' . $search . '%');
                $query->orWhere('action_name', 'LIKE', '%' . $search . '%');
            })
            // ->where(function ($query) use ($is_default) {
            //     if (!is_null($is_default) && $is_default != 2) {
            //         $query->where('used_as_default', $is_default);
            //     } else {
            //         $query->whereIn('used_as_default', [0, 1]);
            //     }
            // })
            ->paginate($paginate->perPage);
        return view('scope.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['resources'] = Resource::valid()->get();
        return view('scope.create', $data);
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
            'resource_id' => 'required',
            'scope'       => 'required',
            'http_method' => 'required',
            'url'         => 'required',
        ]);
        if ($validator->passes()) {
            Scope::create([
                'resource_id'  => $request->resource_id,
                'scope'        => $request->scope,
                'display_name' => $request->display_name,
                'http_method'  => $request->http_method,
                'action_name'  => $request->action_name,
                'url'          => $request->url,
            ]);
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
        $data['scope'] = Scope::find($id);
        $data['resources'] = Resource::valid()->get();
        return view('scope.update', $data);
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
            'resource_id' => 'required',
            'scope'       => 'required',
            'http_method' => 'required',
            'url'         => 'required',
        ]);
        if ($validator->passes()) {
            Scope::find($id)->update([
                'resource_id'  => $request->resource_id,
                'scope'        => $request->scope,
                'display_name' => $request->display_name,
                'http_method'  => $request->http_method,
                'action_name'  => $request->action_name,
                'url'          => $request->url,
            ]);
            Toastr::success('Scope has been updated');
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
        $roleInfo = Scope::find($request->roleId);
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
        Scope::find($id)->delete();
    }
}
