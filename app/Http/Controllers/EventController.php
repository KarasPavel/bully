<?php

namespace App\Http\Controllers;

use App\Category;
use App\Cinema;
use App\DescriptionImage;
use App\Event;
use App\EventCategory;
use App\EventHall;
use App\EventPlace;
use App\Hall;
use App\Place;
use App\Sector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = DB::table('events')
            ->where([['is_delete', '=', 'false'], ['dateStart', '>', Carbon::today('Europe/Stockholm')]])
            ->orWhere([['is_delete', '=', 'false'], ['dateStart', '=', Carbon::today('Europe/Stockholm')], ['timeStart', '>=', Carbon::now('Europe/Moscow')]])
            ->orderBy('id', 'desc')
            ->paginate(12);

        if (view()->exists('events')){
            return view('events', compact('events'));
        }
        abort(404);
    }

    public function news()
    {
        $events = DB::table('events')
            ->where([['is_delete', '=','false'], ['dateStart', '>=', Carbon::today()]])
            ->orderBy('id', 'desc')
            ->paginate(12);

        if (view()->exists('news')){
            return view('news', compact('events'));
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        $cinemas = DB::table('cinemas')
            ->join('halls', 'halls.cinema_id', 'cinemas.id')
            ->groupBy('cinemas.id')
            ->select('cinemas.*')
            ->get();
        $halls = DB::table('halls')->get();
        if (view()->exists('event')){
            return view('create-event', compact('categories', 'cinemas', 'halls'));
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->isMethod('post')) {

            $this->validate($request, [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'categoryId' => 'required',
                'address' => 'required|string|max:255',
                'dateStart' => 'required|after:yesterday',
                'timeStart' => 'required',
                'dateEnd' => 'required|after_or_equal:dateStart',
                'timeEnd' => 'required',
                'eventImage' => "required_if:eventImg,|image",//|dimensions:max_width=2048,max_height=1080',
                'chekinRadius' => 'required',
                'ageRestrictions' => 'required',
                //'descriptionImages' =>'required|image',
                'entry' => 'required',
                'coverImage' => "required_if:coverImg,|image",//|dimensions:max_width=2048,max_height=1080',
                'coverTitle' => 'required|string|max:255'
                /*'cinema' => 'required_without:price',
                'hall' => 'required_with:cinema',
                'price' => 'required_without:cinema,entry|nullable|numeric',
                'place' => 'required_with:price|nullable|numeric'*/
            ]);

            if($request->entry == 'paid'){
                $this->validate($request, [
                    'cinema' => 'required_without:price',
                    'hall' => 'required_with:cinema',
                    'price' => 'required_without:cinema|nullable|numeric',
                    'place' => 'required_with:price|nullable|numeric'
                ]);
            }

            try{
                /*$cinema = DB::table('cinemas')
                ->join('halls', 'halls.cinema_id', 'cinemas.id')
                ->where('halls.id', '=', $request->hall)
                ->select('cinemas.*')
                ->first();*/
                if(!$request->cinema){
                    /*$cinema = new Cinema;
                    $cinema->address = $request->address;
                    $cinema->save();
                    $cinemaId = $cinema->id;*/
                    $cinemaId = null;
                }else{
                    $cinemaId = $request->cinema;
                }

                if(!$request->hall && $request->price){
                    $maxPrice = $request->price * 100;
                    $minPrice = $request->price * 100;
                }elseif($request->hall && !$request->price){
                    $sectors = Sector::where('hall_id', '=', $request->hall)->get();
                    $sectorPrices = [];

                    foreach ($sectors as $sector){
                        $sectorPrices[] = $sector->price;
                    }

                    $maxPrice = max($sectorPrices);
                    $minPrice = min($sectorPrices);
                }else{
                    $maxPrice = 0;
                    $minPrice = 0;
                }


                Event::create($request, $cinemaId, $maxPrice, $minPrice);

                $event = DB::table('events')
                    ->where([
                        ['title', '=', $request->title],
                        ['dateStart', '=', $request->dateStart],
                        ['timeStart', '=', $request->timeStart],
                        ['address', '=', $request->address],
                        ['is_delete', '=', 'false']])
                    ->first();

                $eventId = $event->id;

                if($request->place){
                    $places = $request->place;
                    for($i = 1; $i <= $places; $i++){
                        $newPlase = new Place;
                        $newPlase->name = $event->title . $eventId;
                        $newPlase->save();
                    }

                    $eventPlaces = Place::where('name', '=', $event->title . $eventId)->get();
                    foreach ($eventPlaces as $place){
                        $newEventplace = new EventPlace;
                        $newEventplace->place_id = $place->id;
                        $newEventplace->event_id = $eventId;
                        $newEventplace->save();
                    }
                }
                EventCategory::create($request, $eventId);

                DescriptionImage::create($request, $eventId);

                if(isset($request->hall) && !empty($request->hall)){
                    EventHall::create($eventId, $request->hall);

                    $eventSectors = Hall::amountSectors($request->hall);

                    $eventPlaces = Event::eventPlaces($eventSectors);

                    EventPlace::create($eventPlaces, $eventId);
                }
            }catch (\Exception $e){
                $event = Event::find($eventId);
                $event->is_delete = 'true';
                $event->update();
            }
        }

        return redirect('my_events');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $descriptionImages = DB::table('descriptionImages')->where([['event_id', '=', $id], ['is_delete', '=', 'false']])->get();
        $halls = DB::table('halls')
            ->join('event_hall', 'event_hall.hall_id', '=', 'halls.id')
            ->join('events', 'event_hall.event_id', '=', 'events.id')
            ->where('events.id', '=', $id)
            //->groupBy('halls.id')
            ->select('halls.*')
            ->get();
        $eventHall = true;

        $categories = DB::table('categories')
            ->join('event_category','event_category.category_id', 'categories.id')
            ->where('event_category.event_id', '=', $id)
            ->get();


        $moreEvents = false;
        foreach($categories as $category){
            $moreEvents = DB::table('events')
                ->where([['is_delete', '=', 'false'], ['dateStart', '>=', Carbon::today()]])
                ->join('event_category', 'event_category.event_id', '=', 'events.id')
                ->where('event_category.category_id', '=', $category->category_id)
                ->inRandomOrder()
                ->limit(6)
                ->select('events.*')
                ->get();
            break;
        }

        if($event->venue){
            $cinema = Cinema::where('kassir_id', $event->venue)->first();
            if(!$cinema){
                $cinema = DB::table('cinemas')
                    ->join('halls', 'halls.cinema_id', '=', 'cinemas.id')
                    ->join('event_hall', 'event_hall.hall_id', '=', 'halls.id')
                    ->where('event_hall.event_id', '=', $id)
                    ->select('cinemas.*')
                    ->first();
            }
        }
        foreach($halls as $hall){
            $eventHall = $hall;
        }

        $eventPlaces = EventPlace::where([['event_id', '=', $event->id], ['status', '=', 'free']])->get();

        if($eventPlaces){
            $freePlaces = count($eventPlaces);
        }else{
            $freePlaces = false;
        }

        return view("event", compact('event', 'id', 'descriptionImages', 'eventHall', 'categories', 'moreEvents', 'cinema', 'freePlaces'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $categories = DB::table('categories')->get();
        $halls = DB::table('halls')
            ->join('event_hall', 'event_hall.hall_id', '=', 'halls.id')
            ->join('events', 'event_hall.event_id', '=', 'events.id')
            ->where('events.id', '=', $id)
            //->groupBy('halls.id')
            ->select('halls.*')
            ->get();


        $descriptionImages = DB::table('descriptionImages')->where([['event_id', '=', $id], ['is_delete', '=', 'false']])->get();
        $eventCategory = DB::table('categories')->where('id', $event->categoryId)->get();

        if(count($halls) > 0){
            $eventHall = true;

            foreach($halls as $hall){
                $eventHall = $hall;
            }
            $eventCinemas = DB::table('cinemas')->where('id', $eventHall->cinema_id)->get();
        }else{
            $eventCinemas = Cinema::where('id', '=', $event->venue)->get();
        }


        $cinemas = DB::table('cinemas')->get();

        if (view()->exists('updateEvent')){
            return view('updateEvent',compact('event', 'id', 'categories', 'halls', 'descriptionImages', 'eventCategory', 'cinemas', 'eventCinemas', 'eventHall'));
        }
        abort(404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->isMethod('post')) {

            $this->validate($request, [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'categoryId' => 'required',
                'address' => 'required|string|max:255',
                'dateStart' => 'required|after:yesterday',
                'timeStart' => 'required',
                'dateEnd' => 'required|after_or_equal:dateStart',
                'timeEnd' => 'required',
                'eventImage' => 'image|dimensions:max_width=2048,max_height=1080',
                'chekinRadius' => 'required',
                'ageRestrictions' => 'required',
                //'descriptionImages' =>'image|dimensions:max_width=2048,max_height=1080',
                'entry' => 'required',
                'coverImage' => 'image|dimensions:max_width=2048,max_height=1080',
                'coverTitle' => 'required||string|max:255',
            ]);

            if(isset($request->hallId) && !empty($request->hallId)) {
                $cinema = DB::table('cinemas')
                    ->join('halls', 'halls.cinema_id', 'cinemas.id')
                    ->where('halls.id', '=', $request->hallId)
                    ->select('cinemas.*')
                    ->first();
                $cinemaId = $cinema->id;

                $sectors = Sector::where('hall_id', '=', $request->hallId)->get();
                $sectorPrices = [];

                foreach ($sectors as $sector){
                    $sectorPrices[] = $sector->price;
                }

                $maxPrice = max($sectorPrices);
                $minPrice = min($sectorPrices);

            }else{
                $event = Event::find($id);
                $cinemaId = $event->venue;
                $maxPrice = $event->price_max;
                $minPrice = $event->price_min;
            }

            Event::updateEvent($request, $id, $cinemaId, $maxPrice, $minPrice);
            DescriptionImage::updateDesImg($request, $id);
            EventCategory::updateEventCat($request, $id);

            if(isset($request->hallId) && !empty($request->hallId)){
                $eventHall = EventHall::where([['event_id', '=', $id], ['is_delete', '=', 'false']])->first();

                if ($eventHall->hall_id != $request->hallId){
                    EventHall::edit($id, $request->hallId);
                    $eventSectors = Hall::amountSectors($request->hallId);
                    $eventPlaces = Event::eventPlaces($eventSectors);
                    EventPlace::updateTable($id);
                    EventPlace::create($eventPlaces, $id);
                }
            }
        }

        return redirect('event/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('events')
            ->where('id', $id)
            ->update(['is_delete' => 'true',]);
        DB::table('event_hall')
            ->where('event_id', $id)
            ->update(['is_delete' => 'true',]);

        return redirect('my_events');
    }

    public function getEvent()
    {

        return redirect()->action('EventController@eventHall' , ['id' => $_GET['hallId'], 'eventId' => $_GET['eventId']]);
    }

    public function eventHall($id)
    {
        $hall = Hall::find($id);
        $hallId = $hall->id;
        $sectors = DB::table('sectors')->where('hall_id', $hallId)->orderBy('price', 'DESC')->get();
        $sectorsId = [];
        $places = [];
        foreach ($sectors as $sector){
            $sectorsId[] = $sector->id;
        }

        foreach ($sectorsId as $sectorId){
            $places[] = DB::table('places')->where('sector_id', $sectorId)->get();
        }
        $event = Event::find($_GET['eventId']);

        $cinema = DB::table('cinemas')->where('id', $hall->cinema_id)->get();
        foreach ($cinema as $val){
            $cinema = $val;
        }

        $categories = DB::table('categories')->where('id', $event->categoryId)->get();

        if (view()->exists('event-hall')){
            return view('event-hall', compact('hall', 'sectors', 'places', 'event', 'cinema', 'categories'));
        }
        abort(404);
    }

    public function sortingEventsByCategories(Request $request)
    {
        if(isset($request->data) && !empty($request->data)){

            if(isset($request->lengthOfData) && !empty($request->lengthOfData)){
                $offset = $request->lengthOfData * 24;
            }else{
                $offset = 0;
            }
            $events = DB::table('events')
                ->where([['is_delete', '=', 'false'], ['dateStart', '>=', Carbon::today()]])
                ->join('event_category', 'event_category.event_id', '=', 'events.id')
                ->where('event_category.category_id', '=', $request->data)
                ->orderBy('dateStart', 'asc')
                ->orderBy('timeStart', 'asc')
                ->offset($offset)
                ->limit(24)
                ->select('events.*')
                ->get();
            return $events;
        }
        return response('false', 200);
    }

    public function sortingEventsByDate(Request $request){
        if(isset($request->data) && !empty($request->data)) {
            if (isset($request->lengthOfData) && !empty($request->lengthOfData)) {
                $offset = $request->lengthOfData * 24;
            } else {
                $offset = 0;
            }
            if ($request->data[1] == "dateStart") {
                return Event::where([['dateStart', '=', $request->data[0]], ['is_delete', '=', 'false']])
                    ->orderBy('timeStart', 'ASC')
                    ->offset($offset)
                    ->limit(24)
                    ->get();
            }
            if ($request->data[1] == "dateEnd") {
                return Event::where([['dateEnd', '=', $request->data[0]], ['is_delete', '=', 'false']])
                    ->orderBy('timeEnd', 'ASC')
                    ->offset($offset)
                    ->limit(24)
                    ->get();
            }
        }
        return response('false', 200);
    }

    public function salesPlaces(Request $request)
    {
        return Event::placesForSales($request->eventId);
    }
}
