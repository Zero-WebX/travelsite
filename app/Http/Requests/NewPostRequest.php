<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			 
			'caption' => 'required|max:150',
			'tags' => [
    'required',
    'string',
    'max:150',
    'regex:/^[\pL\d\s\-]+$/u'  // ← Вот это ключ
],
			'content' => 'required|string',
			'postimg' => 'image|mimes:jpeg,png,jpg|max:2048',
			
			
			
		
            //
        ];
    }

public function messages() {
		return [
			'caption.required' => 'Поле "Заголовок поста" является обязательным',
			'content.required' => 'Поле "Содержание" является обязательным'
			
			
			
		];
	}
}