<?php

namespace App\Models;

use App\Traits\Model\AutoFill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizations extends Model
{
    use HasFactory, SoftDeletes, AutoFill;
    protected $fillable = ['country_id', 'division_id', 'district_id', 'thana_id', 'name', 'short_name', 'mobile', 'email', 'created_by', 'updated_by', 'deleted_by', 'valid'];

    public function scopeValid($query)
    {
        return $query->where('valid', 1);
    }
}
