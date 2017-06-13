<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function communities()
    {
        return $this->hasMany('App\Models\Community','location_id','id');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Customer','location_id','id');
    }

    public function properties()
    {
        return $this->hasMany('App\Models\Property','location_id','id');
    }
}
