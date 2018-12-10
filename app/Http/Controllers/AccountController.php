<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 08.05.18
 * Time: 13:35
 */

namespace App\Http\Controllers;

use App\Event;
use App\Place;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        if (view()->exists('account')){
            return view('account');
        }
        abort(404);
    }

    public function currentSellSum(Request $request)
    {
        $userEvents = User::userEvents($request->userId);
        $soldPlaces = [];
        foreach ($userEvents as $userEvent){
            $soldPlaces[] = Event::placesForSales($userEvent->id);
        }

        $placePrice = [];
        foreach ($soldPlaces as $soldPlace){
            foreach ($soldPlace as $place){
                $placePrice[] = Place::priceToPlace($place->sector_id);
            }
        }
        return $placePrice;
    }

    public function eventFilter(Request $request)
    {
        if($request->time == 'CURRENT'){
            return Event::currentEvent();
        }

        if($request->time == 'Past'){
            return Event::pastEvent();
        }

        if($request->time == 'ALL'){
            return Event::userEvents();
        }
    }
}
//2018-06-14
//14:13:00