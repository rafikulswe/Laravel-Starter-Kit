<?php

namespace App\Models;

use App\Traits\Model\AutoFill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleGroup extends Model
{
    use HasFactory, SoftDeletes, AutoFill;
    protected $fillable = ['code', 'name', 'role_ids', 'description', 'created_by', 'updated_by', 'deleted_by', 'valid'];

    public function scopeValid($query)
    {
        return $query->where('valid', 1);
    }

    /**
     * Set the role_ids
     *
     */
    public function setRoleIdsAttribute($value)
    {
        $this->attributes['role_ids'] = json_encode($value);
    }

    /**
     * Get the role_ids
     *
     */
    public function getRoleIdsAttribute($value)
    {
        return $this->attributes['role_ids'] = json_decode($value);
    }
}
