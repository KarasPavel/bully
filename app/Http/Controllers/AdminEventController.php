<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 24.05.18
 * Time: 15:58
 */

namespace App\Http\Controllers;


class AdminEventController extends Controller
{
    public function index()
    {
        if (view()->exists('admin/event-management')){
            return view('admin/event-management');
        }
        abort(404);
    }
}