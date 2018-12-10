<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 20.07.18
 * Time: 10:20
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Hash;
class MailController extends Controller
{

    public function sendTicket(Request $request)
    {
        if($request->isMethod('post')) {

            $this->validate($request, [
                'email' => 'required|string|email|max:255|',
            ]);
            Mail::send(['text' => 'mail-ticket'], ['tickets' => $request->tickets], function ($message) use ($request) {
                $message->to($request->email)->subject('Your tickets for the event ' . $request->eventName);
                $message->from('dzhol7735@gmail.com', 'Showapp');
            });

            $success = 'Tickets were successfully sent to ' . $request->email;
            $order = explode("orderNumber=", $request->tickets);
            $order = $order[1];
            return redirect()->action('BuyTicketController@getTicket', ['success' => $success, 'orderNumber' => $order]);
        }
    }

    public function sendPassword(Request $request)
    {
        if($request->isMethod('post')) {

            $this->validate($request, [
                'email' => 'required|string|email|max:255|',
            ]);

            $user = User::where('email', '=', $request->email)->first();

            if(count($user) > 0){
                $password = "";
                $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
                $max = count($characters) - 1;
                for ($i = 0; $i < 8; $i++) {
                    $rand = mt_rand(0, $max);
                    $password .= $characters[$rand];
                }

                Mail::send(['text' => 'send-password'], ['name' => $user->firstName, 'password' => $password], function ($message) use ($user) {
                    $message->to($user->email)->subject('Your new password to Showapp');
                    $message->from('dzhol7735@gmail.com', 'Showapp');
                });

                $user->update(['password' => Hash::make($password)]);

                return redirect('login-to-account');
            }else{
                $error = 'These credentials do not match our records.';
                return redirect()->action('UserController@notValidEmail', ['error' => $error]);
            }
        }
    }
}