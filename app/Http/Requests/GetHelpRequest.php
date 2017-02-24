<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetHelpRequest extends FormRequest
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
					'getHelp' => 'required|numeric|min:10000',
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
			'getHelp.required' => "Amount is required",
			'getHelp.numeric' => "Amount must be number(s)",
			'getHelp.min' => "Get Help must be a minimum of Fr 10,000",
		];
	}
}
