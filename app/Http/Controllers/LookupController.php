<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Lookups;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class LookupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['inputData'] = $request->all();
        return view('lookup.list', $data);
    }

    public function lookupListData(Request $request)
    {
        $data = $request->all();
        $data['search'] = $search = $request->search;
        $data['is_default'] = $is_default = $request->is_default;
        $paginate = Helper::paginate($data);
        $data['sn'] = $paginate->serial;
        $data['perPage'] = $paginate->perPage;

        $data['lookups'] = Lookups::orderBy('id', 'asc')
            ->where(function ($query) use ($search) {
                $query->orWhere('type', 'LIKE', '%' . $search . '%');
                $query->orWhere('key', 'LIKE', '%' . $search . '%');
                $query->orWhere('value', 'LIKE', '%' . $search . '%');
                $query->orWhere('description', 'LIKE', '%' . $search . '%');
            })
            ->when(!is_null($is_default), function ($query, $is_default) {
                if ($is_default == 2) {
                    return $query->whereIn('used_as_default', [0, 1]);
                } else {
                    return $query->where('used_as_default', $is_default);
                }
            })
            // ->where(function ($query) use ($is_default) {
            //     if (!is_null($is_default) && $is_default != 2) {
            //         $query->where('used_as_default', $is_default);
            //     } else {
            //         $query->whereIn('used_as_default', [0, 1]);
            //     }
            // })
            ->paginate($paginate->perPage);
        return view('lookup.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lookup.create');
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
            'type'  => 'required',
            'key'   => 'required',
            'value' => 'required',
        ]);
        if ($validator->passes()) {
            Lookups::create([
                'type'        => $request->type,
                'key'         => $request->key,
                'value'       => $request->value,
                'description' => $request->description,
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
        $data['lookup'] = Lookups::find($id);
        return view('lookup.update', $data);
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
            'type'  => 'required',
            'key'   => 'required',
            'value' => 'required',
        ]);
        if ($validator->passes()) {
            Lookups::find($id)->update([
                'type'        => $request->type,
                'key'         => $request->key,
                'value'       => $request->value,
                'description' => $request->description,
            ]);
            Toastr::success('Lookup has been updated');
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
        $roleInfo = Lookups::find($request->roleId);
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
        Lookups::find($id)->delete();
    }
}
