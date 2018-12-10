<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 14.05.18
 * Time: 10:57
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hall extends Model
{
    protected $fillable = [
        'rows', 'place', 'rowsPrise', 'placePrise', 'colorPrise', 'name', 'cinema_id', 'event_id', 'status',
        'start_ reservation', 'end_ reservation',
    ];
    public static function create(Request $request)
    {


        return DB::table('halls')->insert(
            ['rows' => $request->rows, 'place' => $request->place, 'placePrise' => $request->placePrise,
                'rowsPrise' => $request->rowsPrise,
                'colorPrise' => $request->colorPrise,]);
    }


    public static function amountSectors($id)
    {
       return DB::table('sectors')
            ->where('hall_id', $id)
            ->get();
    }
}