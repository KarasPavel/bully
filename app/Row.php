<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 24.05.18
 * Time: 11:02
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Row extends Model
{
    protected $fillable = [
        'sector_id', 'places_count',
    ];

    public static function amountPlaces($id)
    {
        return DB::table('places')
            ->where('row_id', $id)
            ->get();
    }
}