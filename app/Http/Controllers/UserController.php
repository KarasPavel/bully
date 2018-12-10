<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 24.05.18
 * Time: 15:54
 */

namespace App\Http\Controllers;


class UserController extends Controller
{
    public function index()
    {
        if (view()->exists('admin/user-management')){
            return view('admin/user-management');
        }
        abort(404);
    }

    public function createAccount()
    {
        if (view()->exists('admin/create-user')){
            return view('admin/create-user');
        }
        abort(404);
    }

    public function forgotPassword()
    {

        if (view()->exists('forgot-password')){
            return view('forgot-password');
        }
        abort(404);
    }

    public function notValidEmail(){
        $error = $_GET['error'];
        if (view()->exists('forgot-password')){
            return view('forgot-password', compact('error'));
        }
        abort(404);
    }
}