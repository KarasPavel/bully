<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 05.06.18
 * Time: 16:07
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EventHall extends Model
{
    protected $fillable = [
        'event_id', 'hall_id',
    ];

    protected $table = 'event_hall';

    public static function create($eventId, $hallId)
    {
        return DB::table('event_hall')->insert(
        ['event_id' => $eventId, 'hall_id' => $hallId,]);
    }

    public static function edit($id, $hallId)
    {
        return DB::table('event_hall')
        ->where('event_id', $id)
        ->update(
            ['hall_id' => $hallId,]);
    }
}