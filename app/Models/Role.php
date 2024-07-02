<?php

namespace App\Models;

use App\Traits\Model\AutoFill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, SoftDeletes, AutoFill;
    protected $fillable = ['parent_id', 'organogram_id', 'code', 'name', 'description', 'created_by', 'updated_by', 'used_as_default', 'valid'];

    public function scopeValid($query)
    {
        return $query->where('valid', 1);
    }
}
