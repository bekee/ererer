<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchRequest extends FormRequest
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
					'amount.*' => 'numeric',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
					'amount.*' => 'numeric',
				];
			}
			default:
				break;
		}
	}
	
	/*public function messages()
	{
		return [
			'amount.numeric.*' => "All money values must be numeric",
		];
	}*/
}
