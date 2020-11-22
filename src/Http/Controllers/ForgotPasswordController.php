<?php

namespace Jangid\Regverlogin\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Jangid\Regverlogin\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Jangid\Regverlogin\Mail\ForgotPasswordEmail;
use Jangid\Regverlogin\Http\Controllers\ValidationController;

class ForgotPasswordController extends Controller
{
    use Notifiable;
    public $validation;
    
    public function __construct()
    {   
        $this->validation = new ValidationController;
    }
    
    public function index(){
        return view('regverlogin::forgot_password');
    }

    public function attemptForgot(Request $request){
        
        $data = $request->all();
        $validation = $this->validation->validateLoginData($data);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $token = Str::random(32);
        $data = $this->validation->unsetFields($data);   
        Mail::to($data['email'])->send(new ForgotPasswordEmail($data['email'],$token));
        DB::table('password_resets')->insert([
            'email' => $data['email'],
            'token' => $token,
        ]);
        return redirect()->back()->with('success','Please Check your mail to reset password.');
    }

    public function resetPasswordIndex($token){
        $checkToken = DB::table('password_resets')->where('token','=',$token)->where('status','=',0)->first();
        if($checkToken == null){
            return redirect('/forgot')->withErrors(['error' => "Link Expired Request Again"]);
        }else{
            return view('regverlogin::reset_password',['token' => $token]);
        }      
    }
    public function resetPassword(Request $request,$token = null){
        
        $data = $request->all();
        if($token != "" && $token != null){
            $checkToken = DB::table('password_resets')->where('token','=',$token)->where('status','=',0)->first();
            if($checkToken == null){
               return redirect()->back()->withErrors(['error' => "Link Expired Request Again"])->withInput();    
            }
            $validation = $this->validation->validateRequestData($data);
            if($validation->fails()){
                return redirect()->back()->withErrors($validation)->withInput();
            }            
            $data = $this->validation->unsetFields($data);
            DB::table('users')->where('email',$checkToken->email)->update(['password' => Hash::make($data['password'])]);
            DB::table('password_resets')->where('token',$token)->update(['status' => 1]);
            return redirect('/login')->with('success','Password has been Changed Login with new password');
        }else{
            return redirect()->back()->withErrors(['error' => "Something is wrong Try Again"])->withInput();
        }
    }

}
