<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 24.05.18
 * Time: 10:30
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    protected $fillable = [
        'name', 'address', 'img', 'lng', 'lat', 'description', 'url', 'kassir_id'
    ];

    public static function saveCinemaFromParse()
    {
        $link = env('KASSIR_PLACE_URL');
        $feed = Event::parseFromKassir($link);
        $cinemas = $feed['venue'];

        foreach ($cinemas as $cinema){
            $oldCinema = Cinema::where('kassir_id', '=', $cinema['id'])->first();
            if ($oldCinema){
                $oldCinema->name = $cinema['name'];
                if ($cinema['address'] !== []){
                    $oldCinema->address = $cinema['address'];
                }
                if (!is_array($cinema['lat'])){
                    $oldCinema->lat = $cinema['lat'];
                }
                if (!is_array($cinema['lon'])){
                    $oldCinema->lng = $cinema['lon'];
                }
                if (!is_array($cinema['description'])){
                    $oldCinema->description = strip_tags($cinema['description']);
                }
                if (!is_array($cinema['poster'])){
                    $oldCinema->image = $cinema['poster'];
                }
                $oldCinema->url = $cinema['url'];
                $oldCinema->update();
            }else{
                $newCinema = new Cinema;
                $newCinema->kassir_id = $cinema['id'];
                $newCinema->name = $cinema['name'];
                if ($cinema['address'] !== []){
                    $newCinema->address = $cinema['address'];
                }
                if (!is_array($cinema['lat'])){
                    $newCinema->lat = $cinema['lat'];
                }
                if (!is_array($cinema['lon'])){
                    $newCinema->lng = $cinema['lon'];
                }
                if (!is_array($cinema['description'])){
                    $newCinema->description = strip_tags($cinema['description']);
                }
                if (!is_array($cinema['poster'])){
                    $newCinema->image = $cinema['poster'];
                }
                $newCinema->url = $cinema['url'];
                $newCinema->save();
            }
        }
    }
}