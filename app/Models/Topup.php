<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Topup extends Model {

    protected $table = 'topup';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'id_user',
        'mobilenumber',
        'value',
        'product',
        'shipping',
        'price',
        'total',
    ];
    

}