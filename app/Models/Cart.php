<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orderBy', 'foodID', 'quantity',
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
      'created_at', 'updated_at', 'deleted_at',
    ];
}
