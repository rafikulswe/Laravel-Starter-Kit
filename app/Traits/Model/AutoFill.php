<?php

namespace App\Traits\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

trait AutoFill
{
    protected static function boot()
    {
        if (Auth::check()) {
            parent::boot();

            static::creating(function($model)  {
                $authId = Auth::id();
                if (Schema::hasColumn($model->getTable(), 'created_by')) {
                    $model->created_by = $authId;
                }
            });

            static::updating(function($model)  {
                $authId = Auth::id();
                if (Schema::hasColumn($model->getTable(), 'updated_by')) {
                    $model->updated_by = $authId;
                }
            });

            static::deleting(function($model)  {
                $authId = Auth::id();
                if (Schema::hasColumn($model->getTable(), 'deleted_by')) {
                    $model->deleted_by = $authId;
                }
            });
        }
    }
}
