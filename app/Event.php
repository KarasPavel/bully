<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    protected $fillable = [
        'categoryId', 'userId', 'title', 'description', 'address', 'dateStart', 'timeStart',
        'dateEnd', 'timeEnd', 'eventImage', 'chekinRadius', 'hall_id', 'ageRestrictions', 'entry',
        'coverImage', 'coverTitle', 'action', 'venue', 'url', 'price_min', 'price_max', 'eticket',
        'selled_tickets', 'core_id', 'special', 'special_tip', 'kassir_id',
    ];


    public static function create(Request $request, $cinemaId, $maxPrice, $minPrice){

        if(isset($request->eventImage) && !empty($request->eventImage)){
            $pathEventImage = $request->file('eventImage')->move(public_path() . '/img/eventImage/', $request->eventImage . '.jpg');
        }else{
            $img = $request->eventImg;
            $folder = 'eventImage';
            $pathEventImage = self::saveImg($img, $folder);
        }

        if(isset($request->eventImage) && !empty($request->eventImage)){
            $pathCoverImage = $request->file('coverImage')->move(public_path() . '/img/coverImage/', $request->coverImage . '.jpg');
        }else{
            $img = $request->coverImg;
            $folder = 'coverImage';
            $pathCoverImage = self::saveImg($img, $folder);
        }


        return DB::table('events')->insert(
            ['userId' => Auth::user()->id, 'title' => $request->title,
                'description' => $request->description, 'address' => $request->address, 'dateStart' => $request->dateStart,
                'timeStart' => $request->timeStart, 'dateEnd' => $request->dateEnd, 'timeEnd' => $request->timeEnd,
                'eventImage' => $pathEventImage, 'chekinRadius' => $request->chekinRadius, 'ageRestrictions' => $request->ageRestrictions,
                'entry' => $request->entry,'coverImage' => $pathCoverImage, 'coverTitle' => $request->coverTitle, 'venue' => $cinemaId,
                'price_min' => $minPrice, 'price_max' => $maxPrice, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    }


    public static function select()
    {
        return DB::table('events')->get();

    }


    public static function userEvents()
    {
        return DB::table('events')->where(['userId' => Auth::user()->id, 'is_delete' => 'false'])->orderBy('id', 'DESC')->get();
    }

    public static function currentEvent()
    {
        return DB::table('events')
            ->where('userId', '=', Auth::user()->id)
            ->where('is_delete', '=', 'false')
            ->where( 'dateEnd', '>', date("Y-m-d"))
            ->select('events.*')
            ->get();
    }

    public static function pastEvent()
    {
        return DB::table('events')
            ->where('userId', '=', Auth::user()->id)
            ->where('is_delete', '=', 'false')
            ->where( 'dateEnd', '<', date("Y-m-d"))
            ->select('events.*')
            ->get();
    }

    public static function updateEvent(Request $request, $id, $cinemaId, $maxPrice, $minPrice)
    {
        if($request->eventImage !== null && !empty($request->eventImage)){
            $pathEventImage = $request->eventImage->move(public_path() . '/img/eventImage/', $request->eventImage . '.jpg');
        }else{
            $pathEventImage = $request->oldEventImage;
        }


        if($request->coverImage !== null && !empty($request->coverImage)){
            $pathCoverImage = $request->coverImage->move(public_path() . '/img/coverImage/', $request->coverImage . '.jpg');
        }else{
            $pathCoverImage = $request->oldCoverImage;
        }

        return DB::table('events')
            ->where('id', $id)
            ->update(['userId' => Auth::user()->id, 'title' => $request->title,
                'description' => $request->description, 'address' => $request->address, 'dateStart' => $request->dateStart,
                'timeStart' => $request->timeStart, 'dateEnd' => $request->dateEnd, 'timeEnd' => $request->timeEnd,
                'eventImage' => $pathEventImage, 'chekinRadius' => $request->chekinRadius, 'ageRestrictions' => $request->ageRestrictions,
                'entry' => $request->entry,'coverImage' => $pathCoverImage, 'coverTitle' => $request->coverTitle,
                'venue' => $cinemaId, 'price_max' => $maxPrice, 'price_min' => $minPrice, 'updated_at' => Carbon::now()]);

    }

    public static function saveImg($img, $folder){

        $path = public_path() . '/img/' . $folder . '/' . str_random(32) . '.jpg';
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        file_put_contents($path, $image_base64);

        return $path;
    }

    public static function eventPlaces($sectors)
    {
        $places = [];
        foreach ($sectors as $sector){
            $places[] = DB::table('places')->where('sector_id', $sector->id)->get();
        }
        return $places;
    }

    public static function placesForSales($eventId)
    {
        return DB::table('places')
            ->join('event_place', 'event_place.place_id', '=', 'places.id')
            ->where( 'event_place.event_id', '=', $eventId)
            ->where('event_place.is_delete', '=', 'false')
            ->where('event_place.status', '=', 'sales')
            ->select('places.*')
            ->get();
    }

    public static function parseFromKassir($link)
    {
      try{
        libxml_use_internal_errors(true);
        //$xml = file_get_contents('https://msk.kassir.ru/frame/feed/xml?key=9b700613-ce77-d1a9-f169-50ee8e9c764f');
        ini_set ( 'memory_limit' , '400M' );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding: gzip'));
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
        $result = curl_exec($ch);
        $xml = gzinflate(substr($result,10));
        $feed = json_decode(json_encode(simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA)),1);
        //dump($feed);
        if (!$feed) {
            foreach(libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
        }
        set_time_limit(0);
        return $feed;
      }catch(\Exception $e){
        dump($link);
      }
    }

    public static function saveEventFromParse()
    {
        $link = env('KASSIR_EVENT_URL');
        $feed = self::parseFromKassir($link);
        $events = $feed['event'];
        $eventFromParse = [];

        foreach($events as $event){

            $eventId = $event['id'];
            array_push($eventFromParse, $eventId);
             $oldEvent = Event::where('kassir_id', '=', $event['id'])->first();
              if ($oldEvent){
                  if(!is_array($event['poster'])){
                      try{
                          file_get_contents($event['poster']);
                          $eventImage = $event['poster'];
                      }catch(\Exception $e){
                          $eventImage = 'img/pics/events_img.png';
                      }
                  }
                  $dateStart = explode(" ", $event['date']['start']);
                  $dateEnd = explode(" ", $event['date']['end']);
                  $eventCinema = Cinema::where('kassir_id', '=', $event['venue'])->first();
                  if($eventCinema){
                      $address = $eventCinema->address;
                  }
                  $oldEvent->kassir_id = $event['id'];
                  $oldEvent->action = $event['action'];
                  if($address) {
                      $oldEvent->address = $address;
                  }
                  $oldEvent->venue = $event['venue'];
                  $oldEvent->title = strip_tags($event['name']);
                  $oldEvent->url = $event['url'];
                  $oldEvent->dateStart = $dateStart[0];
                  $oldEvent->timeStart = $dateStart[1];
                  $oldEvent->dateEnd = $dateEnd[0];
                  $oldEvent->timeEnd = $dateEnd[1];
                  $oldEvent->ageRestrictions = $event['age'];
                  if (!is_array($event['description'])){
                      $oldEvent->description = htmlentities($event['description']);
                  }
                  if (!is_array($event['special'])){
                      $oldEvent->special = strip_tags($event['special']);
                  }
                  if (!is_array($event['special_tip'])){
                      $oldEvent->special_tip = strip_tags($event['special_tip']);
                  }
                  $oldEvent->eventImage = $eventImage;
                  $oldEvent->coverTitle = $event['name'];
                  $oldEvent->coverImage = $eventImage;
                  $oldEvent->price_min = $event['price_min'] * 100;
                  $oldEvent->price_max = $event['price_max'] * 100;
                  $oldEvent->eticket = $event['eticket'];
                  $oldEvent->selled_tickets = $event['selled_tickets'];
                  $oldEvent->core_id = $event['core_id'];
                  $oldEvent->update();

              }else{
                  if(!is_array($event['poster'])){
                      try{
                          file_get_contents($event['poster']);
                          $eventImage = $event['poster'];
                      }catch(\Exception $e){
                          $eventImage = 'img/pics/events_img.png';
                      }
                  }
                  $dateStart = explode(" ", $event['date']['start']);
                  $dateEnd = explode(" ", $event['date']['end']);
                  $eventCinema = Cinema::where('kassir_id', '=', $event['venue'])->first();
                  if($eventCinema){
                      $address = $eventCinema->address;
                  }
                  $newEvent = new Event;
                  $newEvent->kassir_id = $event['id'];
                  $newEvent->action = $event['action'];
                  if($address) {
                      $newEvent->address = $address;
                  }
                  $newEvent->venue = $event['venue'];
                  $newEvent->title = strip_tags($event['name']);
                  $newEvent->url = $event['url'];
                  $newEvent->dateStart = $dateStart[0];
                  $newEvent->timeStart = $dateStart[1];
                  $newEvent->dateEnd = $dateEnd[0];
                  $newEvent->timeEnd = $dateEnd[1];
                  $newEvent->ageRestrictions = $event['age'];
                  if (!is_array($event['description'])){
                      $newEvent->description = htmlentities($event['description']);
                  }
                  if (!is_array($event['special'])){
                      $newEvent->special = strip_tags($event['special']);
                  }
                  if (!is_array($event['special_tip'])){
                      $newEvent->special_tip = strip_tags($event['special_tip']);
                  }
                  $newEvent->eventImage = $eventImage;
                  $newEvent->coverTitle = $event['name'];
                  $newEvent->coverImage = $eventImage;
                  $newEvent->price_min = $event['price_min'] * 100;
                  $newEvent->price_max = $event['price_max'] * 100;
                  $newEvent->eticket = $event['eticket'];
                  $newEvent->selled_tickets = $event['selled_tickets'];
                  $newEvent->core_id = $event['core_id'];
                  $newEvent->save();

                  $existEventHall = EventHall::where([['event_id', '=', $event['id']], ['hall_id', '=', $event['hall']]])->first();
                  if($existEventHall){
                      continue;
                  }else{
                      $eventHall = new EventHall;
                      $eventHall->event_id = $event['id'];
                      $eventHall->hall_id = $event['hall'];
                      $eventHall->save();
                  }
              }
            /*try{
                EventCategory::saveDataFromParse($event['id']);
            }catch(\Exception $e){
                dump($e);
                dump($event);
                $event = Event::where('kassir_id', '=', $event['id'])->first();
                if($event){
                    $event->is_delete = 'true';
                    $event->update();
                }

            }*/
        }

        /**
         *Deleting events that are not in the feed
         */
        try{
            $eventsFromShowapp = Event::where([['kassir_id', '!=', null],['is_delete', '=', 'false']])->get();
            $eventsFromShowappId = [];
            foreach ($eventsFromShowapp as $event){
                array_push($eventsFromShowappId, $event->kassir_id);
            }
            $result = array_diff($eventsFromShowappId, $eventFromParse);

            foreach ($result as $event){
                $newEvent = Event::where('kassir_id', '=', $event)->first();
                if($newEvent){
                    $newEvent->is_delete = 'true';
                    $newEvent->update();
                }
            }
        }catch(\Exception $e){
            dump($e);
        }
    }

}