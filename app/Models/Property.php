<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price',
        'room',
        'category',
        'bed-room',
        'bath-room',
        'size',
        'postal_address',
        'physical_address',
        'description',
        'type_id',
        'property_type_id',
        'location_id',
        'community_id',
        'village_id',
        'status',
    ];

    public function types()
    {
        return $this->belongsTo('App\Models\Type','type_id');
    }

    public function propertyTypes()
    {
        return $this->belongsTo('App\Models\PropertyType','property_type_id');
    }

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
