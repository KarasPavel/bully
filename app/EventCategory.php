<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 07.08.18
 * Time: 17:39
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventCategory extends Model
{
    protected $table = 'event_category';

    protected $fillable = [
        'event_id', 'category_id',
    ];

    public static function create(Request $request, $eventId)
    {
        return DB::table('event_category')->insert(
            ['event_id' => $eventId, 'category_id' => $request->categoryId]);
    }

    public static function updateEventCat(Request $request, $id)
    {
        return DB::table('event_category')
            ->where('event_id', '=', $id)
            ->update(['category_id' => $request->categoryId]);
    }

    public static function saveDataFromParse(/*$eventId*/)
    {
        $link = env('KASSIR_ACTION_URL');
        $feed = Event::parseFromKassir($link);
        $actions = $feed['action'];

        foreach ($actions as $action) {

            $events = Event::where('action', '=', $action['id'])->get();
           // $events = Event::where('kassir_id', '=', $eventId)->get();
            try{
                //if ($action['id'] == $events[0]->action) {
                    $category = Category::where('title', '=', $action['category'])->first();

                    foreach ($events as $event) {
                        $existEventCat = EventCategory::where([['event_id', '=', $event->id], ['category_id', '=', $category->id]])->first();
                        if ($existEventCat) {
                            continue;
                        }
                        $eventCat = new EventCategory;
                        $eventCat->event_id = $event->id;
                        $eventCat->category_id = $category->id;
                        $eventCat->save();
                    }

                    foreach ($events as $event) {
                        $description = $event->description;
                        if (count($description) > 0) {
                            continue;
                        }
                        if (!isset($action['description']) || empty($action['description']) || is_array($action['description'])) {
                            continue;
                        }
                        $event->description = htmlentities($action['description']);
                        $event->update();
                    }

                    foreach ($events as $event) {
                        foreach ($action['subcategory'] as $cat) {
                            if ($cat) {
                                $eventGenre = Category::where('title', '=', $cat)->first();

                                if ($eventGenre) {
                                    $existEventCat = EventCategory::where([['event_id', '=', $event->id], ['category_id', '=', $eventGenre->id]])->first();
                                    if ($existEventCat) {
                                        continue;
                                    }
                                    $eventCat = new EventCategory;
                                    $eventCat->event_id = $event->id;
                                    $eventCat->category_id = $eventGenre->id;
                                    $eventCat->save();

                                }
                            }
                        }
                    }
                    //return true;
               // }
            }catch (\Exception $e){
                continue;
            }
        }
    }
}