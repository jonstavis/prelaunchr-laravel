<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request {

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
			'email' => 'unique:users|required|email|regex:/^[^\+]*$/'	
			//'email' => 'unique:users|required|email'	
		];
	}

	public function messages()
	{
		return [
			'email.required' => "Please enter a valid email address.",
			'email.unique' => "That email address is already taken.",
			'email.email' => "Please enter a valid email address.",
			'email.regex' => "Please enter a valid email address.  Sorry, + signs are not allowed!",
		];
	}

}
