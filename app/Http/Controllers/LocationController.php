<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Locations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['inputData'] = $request->all();
        return view('location.list', $data);
    }

    public function locationListData(Request $request)
    {
        $data = $request->all();
        $data['search'] = $search = $request->search;
        $paginate = Helper::paginate($data);
        $data['sn'] = $paginate->serial;
        $data['perPage'] = $paginate->perPage;

        $data['locations'] = Locations::orderBy('id', 'asc')
            ->where(function ($query) use ($search) {
                $query->where('code', 'LIKE', '%' . $search . '%');
                $query->orWhere('name_en', 'LIKE', '%' . $search . '%');
                $query->orWhere('name_bn', 'LIKE', '%' . $search . '%');
                $query->orWhere('geo_code', 'LIKE', '%' . $search . '%');
                $query->orWhere('latitude', 'LIKE', '%' . $search . '%');
            })
            ->paginate($paginate->perPage);

        return view('location.listData', $data);
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

    public function setDefault(Request $request)
    {
        $roleInfo = Locations::find($request->roleId);
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
        Locations::find($id)->delete();
    }
}
