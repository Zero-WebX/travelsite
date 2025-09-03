<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; ///авторизация пользователя
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			 
			'username' => 'required|max:50',
			'password' => 'required|min:8|max:50',
			'email' => 'required|email'
		
            //
        ];
    }
	
	public function messages() {
		return[
			'username.required' => 'Поле имя пользователя является обязательным',
			'password.required' => 'Поле пароль является обязательным',
			'password.min' => 'Пароль должен содержать не менеее 8 символов',
			'email.required' => 'Поле email является обязательным',
			'email.email' => 'Введите корректный email'
			
			
		];
	}
}
