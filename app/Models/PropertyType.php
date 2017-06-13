<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function properties()
    {
        return $this->hasMany('App\Models\Property','property_type_id','id');
    }

}
