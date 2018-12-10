<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 24.05.18
 * Time: 18:51
 */

namespace App\Http\Controllers;


class RowController extends Controller
{
    public function index()
    {
        if (view()->exists('admin/cinema/row')){
            return view('admin/cinema/row');
        }
        abort(404);
    }
}