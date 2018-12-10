<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 08.05.18
 * Time: 14:04
 */

namespace App\Http\Controllers;


use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyEventsController extends Controller
{
    public function index(Request $request)
    {

        $myEvents = Event::userEvents();

        if (view()->exists('my_events')){
            return view('my_events', compact('myEvents'));
        }
        abort(404);
    }

    public function update(Request $request)
    {

        if($request->isMethod('post')) {

            $this->validate($request, [
                'newEventImage' => 'image|dimensions:max_width=2048,max_height=1080',
            ]);

            $pathEventImage = $request->file('newEventImage')->move(public_path() . '/img/eventImage/', $request->newEventImage . '.jpg');


             DB::table('events')
                ->where('id', $request->id)
                ->update(['eventImage' => $pathEventImage,]);

        }

        return redirect('my_events');
    }
}
