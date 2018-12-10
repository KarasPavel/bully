<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 08.05.18
 * Time: 13:44
 */

namespace App\Http\Controllers;


class CreateEventController extends Controller
{
    public function index()
    {
        if (view()->exists('create-event')){
            return view('create-event');
        }
        abort(404);
    }
}