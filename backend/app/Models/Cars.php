<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cars extends Model
{
    use SoftDeletes;

    protected $table = 'cars';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'country_id',
        'state_id',
        'city_id',
        'name',
        'description',
        'photo',
        'brand',
        'model',
        'year',
        'mileage',
        'gearbox_type',
        'phone',
        'total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * A method to get $fillable for mass updates
     *
     * @return array
     */
    public function getFillable()
    {
        return $this->fillable;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        '',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(States::class, 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class, 'city_id', 'id');
    }
}
