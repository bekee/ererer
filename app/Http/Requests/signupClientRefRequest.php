<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class signupClientRefRequest extends FormRequest
{
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
		switch ($this->method()) {
			case 'GET':
			case 'DELETE': {
				return [];
			}
			case 'POST': {
				return [
					'register-first-name' => 'required|min:3|max:50',
					'register-last-name' => 'required|min:3|max:50',
					'register-mobile' => 'phone:NG|required',
					'register-email' => 'required|email|unique:users,email',
					'password' => 'required|min:5|max:15|confirmed',
					'password_confirmation' => 'required|min:5|max:15',
					'ref' => 'required',
//					'g-recaptcha-response' => 'required|captcha',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
				
				];
			}
			default:
				break;
		}
	}
}
