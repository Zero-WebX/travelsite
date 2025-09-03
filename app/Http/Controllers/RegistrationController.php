<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegRequest;
use App\Models\User;

class RegistrationController extends Controller
{
    //
	public function registration(RegRequest $req){
		
		/// Валидация в laravel встроенная
		
	$newuser =  new User();
	$newuser->name =$req->input('username');
	$newuser->password =$req->input('password');	
	$newuser->email =$req->input('email');
	$newuser->save();
	return	redirect()->route('registration')->with('success', 'Вы успешно зарегистрированы!');
		 
	}
}
