<?php

namespace App\Models;

use App\Traits\Model\AutoFill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use HasFactory, SoftDeletes, AutoFill;
    protected $fillable = ['resource_type', 'name', 'display_name', 'resource_url', 'controller_name', 'sort_order', 'created_by', 'updated_by', 'deleted_by', 'valid'];

    public function scopeValid($query)
    {
        return $query->where('valid', 1);
    }
}
