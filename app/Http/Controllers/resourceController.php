<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['inputData'] = $request->all();
        return view('resource.list', $data);
    }

    public function resourceListData(Request $request)
    {
        $data = $request->all();
        $data['search'] = $search = $request->search;
        $data['is_default'] = $is_default = $request->is_default;
        $paginate = Helper::paginate($data);
        $data['sn'] = $paginate->serial;
        $data['perPage'] = $paginate->perPage;

        $data['resources'] = Resource::orderBy('id', 'asc')
            ->where(function ($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%' . $search . '%');
                $query->orWhere('display_name', 'LIKE', '%' . $search . '%');
                $query->orWhere('controller_name', 'LIKE', '%' . $search . '%');
            })
            // ->where(function ($query) use ($is_default) {
            //     if (!is_null($is_default) && $is_default != 2) {
            //         $query->where('used_as_default', $is_default);
            //     } else {
            //         $query->whereIn('used_as_default', [0, 1]);
            //     }
            // })
            ->paginate($paginate->perPage);
        return view('resource.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resource.create');
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
            'resource_type' => 'required',
            'name'          => 'required',
            'display_name'  => 'required',
            'resource_url'  => 'required',
        ]);
        if ($validator->passes()) {
            $input = $request->all();
            Resource::create($input);
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
        $data['resource'] = Resource::find($id);
        return view('resource.update', $data);
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
            'resource_type' => 'required',
            'name'          => 'required',
            'display_name'  => 'required',
            'resource_url'  => 'required',
        ]);
        if ($validator->passes()) {
            Resource::find($id)->update([
                'resource_type'   => $request->resource_type,
                'name'            => $request->name,
                'display_name'    => $request->display_name,
                'resource_url'    => $request->resource_url,
                'controller_name' => $request->controller_name,
                'sort_order'      => $request->sort_order,
            ]);
            Toastr::success('Resource has been updated');
        } else {
            $messages = $validator->messages();
            foreach ($messages->all() as $message) {
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
            }
        }
        return redirect()->back();
    }

    public function setDefault(Request $request)
    {
        $roleInfo = Resource::find($request->roleId);
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
        Resource::find($id)->delete();
    }
}
