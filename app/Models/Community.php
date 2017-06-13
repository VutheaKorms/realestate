<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'status',
        'location_id',
    ];


    public function locations()
    {
        return $this->belongsTo('App\Models\Location','location_id');
    }

    public function villages()
    {
        return $this->hasMany('App\Models\Village','community_id','id');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Customer','community_id','id');
    }

    public function properties()
    {
        return $this->hasMany('App\Models\Property','community_id','id');
    }

}
