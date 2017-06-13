<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'status',
        'community_id',
    ];

    public function communities()
    {
        return $this->belongsTo('App\Models\Community','community_id');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Customer','village_id','id');
    }

    public function properties()
    {
        return $this->hasMany('App\Models\Property','village_id','id');
    }
}
