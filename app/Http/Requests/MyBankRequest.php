<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyBankRequest extends FormRequest
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
					'acc_name' => 'required',
					'acc_number' => 'required|unique:client_banks,acc_number|digits:10',
					'bank_id' => 'required',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
					'acc_number' => 'required|unique:client_banks,acc_number|digits:10',
					'bank_id' => 'required',
				];
			}
			default:
				break;
		}
	}
	
	public function messages()
	{
		return [
			'acc_name.required' => "Account name is required",
			'acc_number.required' => "Account number is required",
			'acc_number.unique' => "Account is already in use",
			'acc_number.digits' => "Account number must 10 NUBAN digit",
			'bank_id.required' => "You must select a bank",
		];
	}
}
