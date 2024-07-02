<?php

namespace App\Models;

class ScopeAction extends BaseModel
{
    public static $uuIdPrefix = ''; // C-

    public $timestamps = false;

    protected $fillable = [
        'resource_id',
        'scope_id',
        'scope_name',
        'http_method',
        'action_name',
        'uri',
    ];

    protected $hidden = [
        //
    ];

    protected $casts = [
        // Integer
        'id'          => 'integer',
        'resource_id' => 'integer',
        'scope_id'    => 'integer',
        // String
        'scope_name'  => 'string',
        'http_method' => 'string',
        'action_name' => 'string',
        'uri'         => 'string',
    ];

    protected $dates = [
        //
    ];

    protected $attributes = [
        //
    ];

}
