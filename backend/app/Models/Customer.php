<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Customer extends Model
{
    use HasCompositeKey;

    protected $table = 'cliente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['recnum', 'empresa', 'codigo', 'razao_social', 'tipo', 'cpf_cnpj'];
    protected $primaryKey = ['empresa', 'codigo'];
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
