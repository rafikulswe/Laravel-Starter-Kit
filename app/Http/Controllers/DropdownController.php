<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DropdownController extends Controller
{
    public function getDistrictDropdown(Request $request)
    {
        $division_id = $request->division_id;
        $data['districts'] = Locations::where('location_type_id', 'DISTRICT')->where('division_id', $division_id)->get();
        return view('common.dropdown.districts', $data);
    }
    public function getUpazilaDropdown(Request $request)
    {
        $district_id = $request->district_id;
        $data['upazilas'] = Locations::where('location_type_id', 'THANA')->where('district_id', $district_id)->get();
        return view('common.dropdown.upazilas', $data);
    }
}
