<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 24.05.18
 * Time: 18:53
 */

namespace App\Http\Controllers;


class PlaceController extends Controller
{
    public function index()
    {
        if (view()->exists('admin/cinema/place')){
            return view('admin/cinema/place');
        }
        abort(404);
    }
}