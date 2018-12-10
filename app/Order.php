<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 16.06.18
 * Time: 15:46
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'guid', 'status_payment', 'status_annulment', 'purchase_amount',
    ];

}