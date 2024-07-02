<?php

namespace App\Models;

use App\Traits\Model\AutoFill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scope extends Model
{
    use HasFactory, SoftDeletes, AutoFill;
    protected $fillable = ['resource_id', 'scope', 'display_name', 'http_method', 'action_name', 'url', 'created_by', 'updated_by', 'deleted_by', 'valid'];

    public function scopeValid($query)
    {
        return $query->where('valid', 1);
    }
}