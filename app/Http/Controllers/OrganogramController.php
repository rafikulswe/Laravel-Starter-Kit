<?php

namespace App\Http\Controllers;

use Helper;
use Illuminate\Http\Request;
use App\Models\Organogram;
use App\Http\Controllers\Controller;
use App\Models\Locations;
use App\Models\Organizations;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class OrganogramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['inputData'] = $request->all();
        return view('organogram.list', $data);
    }

    public function organogramListData(Request $request)
    {
        $data = $request->all();
        $data['search'] = $search = $request->search;
        $data['is_default'] = $is_default = $request->is_default;
        $paginate = Helper::paginate($data);
        $data['sn'] = $paginate->serial;
        $data['perPage'] = $paginate->perPage;
        $data['organizations'] =  Organizations::valid()->get();
        $data['organization_id'] = $organization_id =  $request->organization_id;

        $data['organograms'] = Organogram::join('organizations', 'organizations.id', '=', 'organograms.organization_id')
            ->join('locations AS Cou', 'Cou.id', '=', 'organograms.country_id')
            ->join('locations AS Div', 'Div.id', '=', 'organograms.division_id')
            ->join('locations AS Dis', 'Dis.id', '=', 'organograms.district_id')
            ->join('locations AS Tha', 'Tha.id', '=', 'organograms.thana_id')
            ->select('organograms.*', 'organizations.name as organization_name', 'Cou.name_en as country_name', 'Div.name_en as division_name', 'Div.name_en as district_name', 'Div.name_en as thana_name')
            ->where(function ($query) use ($organization_id) {
                if(!empty($organization_id)){
                    $query->where('organization_id', $organization_id);
                }
            })
            ->paginate($paginate->perPage);
        return view('organogram.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['organizations'] = Organizations::valid()->get();
        $data['countries'] = Locations::where('location_type_id', 'COUNTRY')->get();
        $data['divisions'] = Locations::where('location_type_id', 'DIVISION')->get();
        return view('organogram.create', $data);
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
            'organization_id' => 'required',
            'country_id'      => 'required',
            'division_id'     => 'required',
            'district_id'     => 'required',
            'thana_id'        => 'required',
            'name'            => 'required',
            'short_name'      => 'required',
        ]);
        if ($validator->passes()) {
            Organogram::create([
                'organization_id' => $request->organization_id,
                'country_id'      => $request->country_id,
                'division_id'     => $request->division_id,
                'district_id'     => $request->district_id,
                'thana_id'        => $request->thana_id,
                'name'            => $request->name,
                'short_name'      => $request->short_name,
                'mobile'          => $request->mobile,
                'email'           => $request->email,
            ]);
            Toastr::success('Organogram Created Successfully');
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
        $data['organogramInfo'] = $organogramInfo = Organogram::find($id);
        $data['organizations'] = Organizations::valid()->get();
        $data['countries'] = Locations::where('location_type_id', 'COUNTRY')->get();
        $data['divisions'] = Locations::where('location_type_id', 'DIVISION')->get();
        $data['districts'] = Locations::where('location_type_id', 'DISTRICT')->where('division_id', $organogramInfo->division_id)->get();
        $data['upazilas'] = Locations::where('location_type_id', 'THANA')->where('district_id', $organogramInfo->district_id)->get();

        return view('organogram.update', $data);
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
            'organization_id' => 'required',
            'country_id'      => 'required',
            'division_id'     => 'required',
            'district_id'     => 'required',
            'thana_id'        => 'required',
            'name'            => 'required',
            'short_name'      => 'required',
        ]);
        if ($validator->passes()) {
            Organogram::find($id)->update([
                'organization_id' => $request->organization_id,
                'country_id'      => $request->country_id,
                'division_id'     => $request->division_id,
                'district_id'     => $request->district_id,
                'thana_id'        => $request->thana_id,
                'name'            => $request->name,
                'short_name'      => $request->short_name,
                'mobile'          => $request->mobile,
                'email'           => $request->email,
            ]);
            Toastr::success('Organogram has been updated');
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
        $roleInfo = Organogram::find($request->roleId);
        if (!empty($roleInfo)) {
            $roleInfo->update(['used_as_default' => !$roleInfo->used_as_default]);
            $output['messege'] = 'Organogram default status has been modified';
            $output['msgType'] = 'success';
        } else {
            $output['messege'] = 'Organogram not found';
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
        Organogram::find($id)->delete();
    }
}
