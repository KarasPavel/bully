<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Socialite;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('login-to-account');
        }
        // check if they're an existing user
        $existingUser = User::where('google_id', $user->id)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            $emailUser = User::where('email', $user->email)->first();
            $userName = explode (' ', $user->name);
            // create a new user
            $newUser                  = new User;
            $newUser->firstName       = $userName[0];
            if($userName[1]){
                $newUser->lastName       = $userName[1];
            }
            if (!$emailUser){
                $newUser->email           = $user->email;
            }
            $newUser->google_id       = $user->id;
            $newUser->photo           = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->intended();
    }

    public function redirectToVK()
    {
        return Socialite::with('vkontakte')->stateless()->redirect();
    }

    public function handleVKCallback()
    {
        try {
            $user = Socialite::driver('vkontakte')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('login-to-account');
        }

        $existingUser = User::where('vk_id', $user->id)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->firstName       = $user->user['first_name'];
            $newUser->lastName       = $user->user['last_name'];
            $newUser->vk_id       = $user->user['id'];
            $newUser->photo           = $user->user['photo'];
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->intended();
    }
}
