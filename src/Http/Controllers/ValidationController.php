<?php

namespace Jangid\Regverlogin\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Validator;



class ValidationController extends Controller
{
    public $unsetFields = [
        '_token',
        'confirm_password'
    ];
    public $validationRules = [
        'name' => 'required',
        'email' => 'required|regex:/^.+@.+$/i|unique:users',
        'password' => 'required|min:8',
        'confirm_password' => 'required|same:password',
    ];
    public $loginValidationRules = [
        'email' => 'required|regex:/^.+@.+$/i',
        'password' => 'required',
    ];

    public function validateRequestData($data){
        $rules = [];
        foreach ($data as $key => $value) {
            if(isset($this->validationRules[$key])){
                $rules[$key] = $this->validationRules[$key];
            }
        }
        $validation = Validator::make($data,$rules);

        return $validation;
    }

    public function validateLoginData($data){
        $rules = [];
        foreach ($data as $key => $value) {
            if(isset($this->loginValidationRules[$key])){
                $rules[$key] = $this->loginValidationRules[$key];
            }
        }
        $validation = Validator::make($data,$rules);
        return $validation;
    }

    public function unsetFields($data){
        foreach($data as $key => $val){
            if(in_array($key,$this->unsetFields)){
                unset($data[$key]);
            }
        }
        return $data;
    }
}
