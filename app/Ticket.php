<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 16.06.18
 * Time: 15:45
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'order_id', 'guid', 'event_name', 'event_image', 'address', 'date', 'time', 'price', 'row', 'place',
    ];

}