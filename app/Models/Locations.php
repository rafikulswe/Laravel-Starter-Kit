<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locations extends Model
{
    use HasFactory;
    protected $fillable = ['parent_location_id', 'location_type_id', 'code', 'name_en', 'name_bn', 'geo_code', 'latitude', 'longitude', 'description', 'currency', 'region_id', 'country_id', 'division_id', 'district_id', 'thana_id', 'area_id', 'postcode_id', 'created_at', 'updated_at', 'valid'];
}
