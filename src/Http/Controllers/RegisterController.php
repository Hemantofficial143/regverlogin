<?php

namespace Jangid\Regverlogin\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Hemus\Regverlogin\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Hemus\Regverlogin\Mail\EmailVerification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Hemus\Regverlogin\Http\Controllers\ValidationController;

class RegisterController extends Controller
{
    public $validation;
    use Notifiable;
    public function __construct()
    {
        $this->validation = new ValidationController;
    }
    
    public function index(){
        return view('regverlogin::register');
    }

    public function store(Request $request){
        $data = $request->all();
        $validation = $this->validation->validateRequestData($data);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $token = Str::random(32);
        $data['ver_token'] = $token;
        $data['password'] = Hash::make($data['password']);
        $data = $this->validation->unsetFields($data);
        Mail::to($data['email'])->send(new EmailVerification($data['name'],$data['ver_token']));
        User::create($data);    
        return redirect()->back()->with('success','Please Check your Email and Verify Account');
    }   

    public function verify($token){
        $check_user = User::where('ver_token',$token)->where('status',0)->first();
        if($check_user->id > 0){
            $check_user->status = 1;
            $check_user->save();
            return redirect('/register')->with('success','Account Verified login now');
        }else{
            return redirect('/register');
        }
    }

}
