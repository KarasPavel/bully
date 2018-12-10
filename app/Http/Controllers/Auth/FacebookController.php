<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 01.08.18
 * Time: 16:02
 */

namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\Controller;
use Socialite;
use Exception;
use Auth;


class FacebookController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {

        try {
            $user = Socialite::driver('facebook')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('login-to-account');
        }

        $existingUser = User::where('fb_id', $user->id)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            $userName = explode (' ', $user->name);
            $emailUser = User::where('email', $user->email)->first();
            // create a new user
            $newUser                  = new User;
            $newUser->firstName       = $userName[0];
            if($userName[1]){
                $newUser->lastName       = $userName[1];
            }
            if (!$emailUser){
                $newUser->email           = $user->email;
            }
            $newUser->fb_id           = $user->id;
            $newUser->photo           = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->intended();
    }
}