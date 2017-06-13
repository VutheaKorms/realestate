<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'postal_address',
        'physical_address',
        'description',
        'status',
        'location_id',
        'community_id',
        'village_id',
    ];

    public function locations()
    {
        return $this->belongsTo('App\Models\Location','location_id');
    }

    public function communities()
    {
        return $this->belongsTo('App\Models\Community','community_id');
    }

    public function villages()
    {
        return $this->belongsTo('App\Models\Village','village_id');
    }
}
