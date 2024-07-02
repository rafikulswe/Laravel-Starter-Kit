<?php

namespace App\Http\Controllers;

use Helper;
use Illuminate\Http\Request;
use App\Models\Organizations;
use App\Http\Controllers\Controller;
use App\Models\Locations;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['inputData'] = $request->all();
        return view('organization.list', $data);
    }

    public function organizationListData(Request $request)
    {
        $data = $request->all();
        $data['search'] = $search = $request->search;
        $data['is_default'] = $is_default = $request->is_default;
        $paginate = Helper::paginate($data);
        $data['sn'] = $paginate->serial;
        $data['perPage'] = $paginate->perPage;

        $data['organizations'] = Organizations::join('locations AS Cou', 'Cou.id', '=', 'organizations.country_id')
            ->join('locations AS Div', 'Div.id', '=', 'organizations.division_id')
            ->join('locations AS Dis', 'Dis.id', '=', 'organizations.district_id')
            ->join('locations AS Tha', 'Tha.id', '=', 'organizations.thana_id')
            ->select('organizations.*', 'Cou.name_en as country_name', 'Div.name_en as division_name', 'Div.name_en as district_name', 'Div.name_en as thana_name')
            // ->where(function ($query) use ($search) {
            //     $query->orWhere('country_id', 'LIKE', '%' . $search . '%');
            // })
            ->paginate($paginate->perPage);
        return view('organization.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['countries'] = Locations::where('location_type_id', 'COUNTRY')->get();
        $data['divisions'] = Locations::where('location_type_id', 'DIVISION')->get();
        return view('organization.create', $data);
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
            'country_id'  => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id'    => 'required',
            'name'        => 'required',
            'short_name'  => 'required',
        ]);
        if ($validator->passes()) {
            Organizations::create([
                'country_id'    => $request->country_id,
                'division_id'   => $request->division_id,
                'district_id'   => $request->district_id,
                'thana_id'      => $request->thana_id,
                'name'          => $request->name,
                'short_name'    => $request->short_name,
                'mobile'        => $request->mobile,
                'email'         => $request->email,
            ]);
            Toastr::success('Organization Created Successfully');
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
        $data['organizationInfo'] = $organizationInfo = Organizations::valid()->find($id);
        $data['countries'] = Locations::where('location_type_id', 'COUNTRY')->get();
        $data['divisions'] = Locations::where('location_type_id', 'DIVISION')->get();
        $data['districts'] = Locations::where('location_type_id', 'DISTRICT')->where('division_id', $organizationInfo->division_id)->get();
        $data['upazilas'] = Locations::where('location_type_id', 'THANA')->where('district_id', $organizationInfo->district_id)->get();

        return view('organization.update', $data);
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
            'country_id'  => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id'    => 'required',
            'name'        => 'required',
            'short_name'  => 'required',
        ]);
        if ($validator->passes()) {
            Organizations::find($id)->update([
                'country_id'    => $request->country_id,
                'division_id'   => $request->division_id,
                'district_id'   => $request->district_id,
                'thana_id'      => $request->thana_id,
                'name'          => $request->name,
                'short_name'    => $request->short_name,
                'mobile'        => $request->mobile,
                'email'         => $request->email,
            ]);
            Toastr::success('Organization has been updated');
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
        $roleInfo = Organizations::find($request->roleId);
        if (!empty($roleInfo)) {
            $roleInfo->update(['used_as_default' => !$roleInfo->used_as_default]);
            $output['messege'] = 'Organization default status has been modified';
            $output['msgType'] = 'success';
        } else {
            $output['messege'] = 'Organization not found';
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
        Organizations::find($id)->delete();
    }
}
