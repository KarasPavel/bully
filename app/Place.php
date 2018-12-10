<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 24.05.18
 * Time: 11:05
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Place extends Model
{
    protected $fillable = [
        'sector_id', 'name', 'date_start', 'date_end',
    ];

    public static function priceToPlace($sectorId)
    {
       return DB::table('sectors')
            ->where('id', $sectorId)
            ->select('sectors.price')
            ->get();
    }
}