<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 08.05.18
 * Time: 13:41
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CreateAccountController extends Controller
{
    public function index()
    {
        if (view()->exists('create-account')){
            return view('create-account');
        }
        abort(404);
    }


}