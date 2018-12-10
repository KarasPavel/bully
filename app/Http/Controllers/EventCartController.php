<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 08.05.18
 * Time: 13:57
 */

namespace App\Http\Controllers;


class EventCartController extends Controller
{
    public function index()
    {
        if (view()->exists('event_cart')){
            return view('event_cart');
        }
        abort(404);
    }

    public function createEvent()
    {
        if (view()->exists('create-event')){
            return view('create-event');
        }
        abort(404);
    }
}