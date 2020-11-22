<?php

namespace Jangid\Regverlogin\Http\Controllers;

use Illuminate\Http\Request;
use Hemus\Regverlogin\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;


class UserController extends Controller
{
    use Notifiable;
    public $validation;
    
    public function __construct()
    {
        $this->validation = new ValidationController;
    }
    
    public function index(){
        return view('regverlogin::dashboard');
    }
    public function attempt(Request $request){
        $data = $request->all();
        $validation = $this->validation->validateLoginData($data); 
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
            return redirect('/dashboard');
        }else{
            return redirect()->back()->withErrors(['invalid' => 'Invalid Email or Password']);
        }
    }

}
