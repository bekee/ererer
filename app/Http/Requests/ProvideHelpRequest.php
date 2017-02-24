<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProvideHelpRequest extends FormRequest
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
					'provideHelp' => 'required|numeric|min:5000',
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
	public function messages()
	{
		return [
			'provideHelp.required'=>"Amount is required",
			'provideHelp.numeric'=>"Amount must be number(s)",
			'provideHelp.min'=>"You cannot provide less than Fr 10,000"
		];
	}
}
