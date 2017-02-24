<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCyclerRequest extends FormRequest
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
		switch ($this->method()) {
			case 'GET':
			case 'DELETE': {
				return [];
			}
			case 'POST': {
				return [
					'amount' => 'required|numeric',
					'percentage' => 'required|numeric',
					'days' => 'required|numeric',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
					'amount' => 'required|numeric',
					'percentage' => 'required|numeric',
					'days' => 'required|numeric',
				];
			}
			default:
				break;
		}
	}
	
	public function messages()
	{
		return [
			'amount.required' => "Amount is required",
			'amount.numeric' => "Amount must be numeric",
			'percentage.required' => "Percentage is required",
			'percentage.numeric' => "Percentage must be numeric",
			'days.required' => "Days is required",
			'days.numeric' => "Days must be numeric",
		];
	}
}
