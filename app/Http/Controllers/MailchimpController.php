<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 01.08.18
 * Time: 9:35
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Newsletter;


class MailchimpController extends Controller
{
    public function subscribing(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'email' => 'required|email',
            ]);
            if (!Newsletter::isSubscribed($request->email)) {
                Newsletter::subscribe($request->email);
                return redirect()->back()->with('message', 'Subtitle was successful');
            }
            return redirect()->back()->with('message', 'You are already subscribed or something went wrong');
        }
    }
}