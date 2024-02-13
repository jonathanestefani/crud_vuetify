<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'empresa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['recnum', 'codigo', 'empresa', 'sigla', 'razao_social'];
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    public $timestamps = false;

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
}
