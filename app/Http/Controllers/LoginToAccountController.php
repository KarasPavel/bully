<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 08.05.18
 * Time: 14:00
 */

namespace App\Http\Controllers;


class LoginToAccountController extends Controller
{
    public function index()
    {
        if (view()->exists('login-to-account')){
            return view('login-to-account');
        }
        abort(404);
    }
}