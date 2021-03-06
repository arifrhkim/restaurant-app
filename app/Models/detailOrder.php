<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class detailOrder extends Model
{
    public $table = "detailorders";
    //
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orderID', 'orderBy', 'foodID', 'quantity', 'status', 'subtotal',
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
