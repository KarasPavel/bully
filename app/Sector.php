<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 24.05.18
 * Time: 11:01
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sector extends Model
{
    protected $fillable = [
        'name', 'hall_id', 'color', 'price', 'cols', 'rows',
    ];

    public static function amountRows($id)
    {
        return DB::table('rows')
            ->where('sector_id', $id)
            ->get();
    }
}