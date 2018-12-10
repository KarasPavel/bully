<?php

namespace App\Http\Controllers;

use App\Category;
use App\Cinema;
use App\Event;
use App\EventCategory;
use App\EventHall;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $now = Carbon::now('Europe/Moscow');
        settype($now, 'string');
        $now = explode(" ", $now);
        $timeStart = $now[1];

        $allEvent = DB::table('events')
            ->where([['is_delete', '=', 'false'], ['dateStart', '>', Carbon::today('Europe/Stockholm')]])
            ->orWhere([['is_delete', '=', 'false'], ['dateStart', '=', Carbon::today('Europe/Stockholm')], ['timeStart', '>=', $timeStart]])
            ->orderBy('dateStart', 'asc')
            ->orderBy('timeStart', 'asc')
            ->paginate(24);

        $categories = DB::table('categories')
            ->join('event_category', 'event_category.category_id', '=', 'categories.id')
            ->groupBy('id')
            ->select('categories.*')
            ->get();

        if (view()->exists('index')){
            return view('index', compact('allEvent', 'categories'));
        }
        abort(404);
    }

    public function search(Request $request)
    {
        $search = strip_tags(trim($request->search));

        if(isset($search) && !empty($search)){
            $events = DB::table('events')
                ->where([['title', 'like', '%' . $search . '%'], ['is_delete', '=', 'false'], ['dateStart', '>=', Carbon::today()]])
                ->orWhere([['description', 'like', '%' . $search . '%'], ['is_delete', '=', 'false'], ['dateStart', '>=', Carbon::today()]])
                ->paginate(12);

            if(count($events) > 0){
                return view('found-events', compact('events'));
            }
        }
        return view('events-not-found');
    }

    public function parseFeed(){

        try{
            //$feed = Event::parseFromKassir();
            Category::saveCategoryFromParse();
            Cinema::saveCinemaFromParse();
            Event::saveEventFromParse();
            EventCategory::saveDataFromParse();
        }catch(\Exception $e){
            dump($e);
            echo 'Something could be going wrong.';

        }

    }
}
