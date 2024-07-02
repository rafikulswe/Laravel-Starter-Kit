<?php

namespace App\Models;

// use App\Enums\StatusEnum;
use App\Traits\Model\Autofill;
use Illuminate\Database\Eloquent\SoftDeletes;

class Example extends BaseModel
{
    use SoftDeletes, Autofill;

    protected $fillable = ['title', 'description'];

    protected $hidden = [
        'deleted_at'
    ];

    protected $casts = [
        // Integer
        'id'            => 'integer',
        'created_by'    => 'integer',
        'updated_by'    => 'integer',
        'status'        => 'integer',
        //Date Time
        'created_at'    => 'datetime:Y-m-d H:i:s',
        'updated_at'    => 'datetime:Y-m-d H:i:s',
        // String
        'title'       => 'string',
        'description' => 'string',
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    // protected $attributes = [
    //     'status' => StatusEnum::ACTIVE,
    // ];
}
