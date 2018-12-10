<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 24.05.18
 * Time: 11:07
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EventPlace extends Model
{
    protected $fillable = [
        'event_id', 'place_id',
    ];

    protected $table = 'event_place';

    public static function create($places, $event)
    {
        foreach ($places as $place){
            foreach ($place as $val){
                DB::table('event_place')->insert(['event_id' => $event, 'place_id' => $val->id]);
            }
        }
    }

    public static function updateTable($id)
    {
       return DB::table('event_place')->where('event_id', $id)->update(['is_delete' => 'true']);
    }
}