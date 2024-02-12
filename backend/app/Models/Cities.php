<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cities extends Model
{
    use SoftDeletes;

    protected $table = 'cities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'country_id',
        'name',
        'uf',
        'ibge',
        'ddd'
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

    public function state()
    {
        return $this->belongsTo(State::class, 'uf', 'uf');
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
}
