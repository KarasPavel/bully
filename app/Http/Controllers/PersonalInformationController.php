<?php
/**
 * Created by PhpStorm.
 * User: pinofran
 * Date: 08.05.18
 * Time: 14:07
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PersonalInformationController extends Controller
{
    protected $changePass;
    protected $passwordFromSite;
    protected $checkPass;
    protected $password;

    public function index()
    {
        if (view()->exists('personal_information')){
            return view('personal_information');
        }
        abort(404);
    }


    public function update(Request $request)
    {


        if($request->isMethod('post')) {

            $this->validate($request, [
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'number' => 'sometimes|nullable|string|min:10|max:20',
                'currentPassword' => 'required_with:password',
                'password' => 'sometimes|nullable|string|min:8|confirmed',
            ]);

            /*if(isset($request->password) && !empty($request->password)){
                $this->validate($request, [
                    'currentPassword' => 'required',
                ]);
            }*/
            if(isset($request->currentPassword) && !empty($request->currentPassword)){
                if (Hash::check($request->currentPassword, Auth::user()->password)) {


                    if(isset($request->password) && !empty($request->password)){
                        $this->passwordFromSite = bcrypt($request->password);

                        $this->checkPass = explode("$", $this->passwordFromSite);
                        //dd($this->checkPass);
                        if($this->checkPass[1] == '2y'){
                            $this->changePass = explode("$2y", $this->passwordFromSite);
                            $this->password = '$2a' . $this->changePass[1];
                        }else{
                            $this->password = $this->passwordFromSite;
                        }
                        $password = $this->password ;
                        //$password = Hash::make($request->password);

                    }else{
                        $password = Auth::user()->password;
                    }

                    if(isset($request->photo) && !empty($request->photo)){
                        $pathUserImage = $request->file('photo')->move(public_path() . '/img/photo/', $request->photo . '.jpg');
                    }else{
                        $pathUserImage = Auth::user()->photo;
                    }
                    DB::table('users')
                        ->where('id', Auth::user()->id)
                        ->update(['firstName' => $request->firstName, 'lastName' => $request->lastName, 'phone' => $request->number,
                            'password' => $password, 'photo' => $pathUserImage]);
                    return redirect('account');
                }else{
                    $error = 'These credentials do not match our records.';
                    return redirect()->action('PersonalInformationController@notCredentials', ['error' => $error]);
                }
            }else{
                if(isset($request->photo) && !empty($request->photo)){
                    $pathUserImage = $request->file('photo')->move(public_path() . '/img/photo/', $request->photo . '.jpg');
                }else{
                    $pathUserImage = Auth::user()->photo;
                }
                DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update(['firstName' => $request->firstName, 'lastName' => $request->lastName, 'phone' => $request->number,
                        'photo' => $pathUserImage]);
                return redirect('account');
            }

        }
    }

    public function notCredentials()
    {
        $error = $_GET['error'];
        return view('personal_information', compact('error'));
    }
}