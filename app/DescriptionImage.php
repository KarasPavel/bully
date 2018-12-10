<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 17.05.18
 * Time: 14:33
 */

namespace App;


use function GuzzleHttp\Psr7\str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DescriptionImage extends Model
{
    protected $fillable = [
        'event_id', 'image', 'is_delete',
    ];

    public static function create(Request $request, $eventId)
    {
        if(isset($request->oldDescriptionImages) && !empty($request->oldDescriptionImages)) {
            foreach ($request->oldDescriptionImages as $image) {

                $pathDescImage = $image;

                DB::table('descriptionImages')->insert(
                    ['event_id' => $eventId, 'image' => $pathDescImage,]);
            }
        }
        if(isset($request->descriptionImages) && !empty($request->descriptionImages)) {
            foreach ($request->descriptionImages as $image) {

                $pathDescImage = $image->move(public_path() . '/img/descriptionImage/', $image->getFileName() . '.jpg');

                DB::table('descriptionImages')->insert(
                    ['event_id' => $eventId, 'image' => $pathDescImage,]);
            }
        }else{
            foreach ($request->descriptImages as $image) {

                $folder = 'descriptionImage';
                $pathDescImage = Event::saveImg($image, $folder);

                DB::table('descriptionImages')->insert(
                    ['event_id' => $eventId, 'image' => $pathDescImage,]);
            }
        }
    }

    public static function updateDesImg(Request $request, $eventId)
    {
        if(isset($request->descriptionImages) && !empty($request->descriptionImages)) {
            DB::table('descriptionImages')
                ->where('event_id', $eventId)
                ->update(['is_delete' => 'true']);
            return self::create($request, $eventId);
        }
        return false;
    }
}
/*if(isset($request->eventImage) && !empty($request->eventImage)){
            $pathCoverImage = $request->file('coverImage')->move(public_path() . '/img/coverImage/', $request->coverImage . '.jpg');
        }else{
            $img = $request->coverImg;
            $folder = 'coverImage';
            $pathCoverImage = self::saveImg($img, $folder);
        }*/