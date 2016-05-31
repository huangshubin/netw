<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */

    protected $redirectPath="/";
    public function __construct()
    {
      $this->middleware('guest')->except(['showPwdChange','changePwd']);
    }
    public function showPwdChange()
    {
        return view( 'auth.passwords.change' );
    }
    public function changePwd(Request $request)
    {
        $oldPwd=$request->oldpwd;
        $newPwd=$request->password;
        $confirmPwd=$request->password_confirmation;

        $validate=Validator::make($request->all(),[
                 'oldpwd'=>'required|min:6',
                 'password' => 'required|confirmed|min:6',
        ]);
        $user=Auth::user();
        $validate->after(function($validate) use ($oldPwd,$user){
            $currPwd=$user->password;
            $match=Hash::check($oldPwd,$currPwd);
           if(!$match)
           {
               $validate->errors()->add('oldpwd','the old password is not right');
           }
        });

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }

        
        $user->password=bcrypt($newPwd);
         $user->save();
        return view('auth.passwords.change',['result'=>'Change Password Success']);
    }
}
