<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtherSettingRequest extends FormRequest
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
					'bonus_min_amount_withdrawal' => 'required|numeric',
					'max_referral_bonus_per_referrer' => 'required|numeric',
					'expected_matching_days' => 'required|numeric',
					'allowed_payment_hours' => 'required|numeric',
					'maturity_days' => 'required|numeric',
				];
			}
			case 'PUT':
			case 'PATCH': {
				return [
					'bonus_min_amount_withdrawal' => 'required|numeric',
					'max_referral_bonus_per_referrer' => 'required|numeric',
					'expected_matching_days' => 'required|numeric',
					'allowed_payment_hours' => 'required|numeric',
					'maturity_days' => 'required|numeric',
				];
			}
			default:
				break;
		}
	}
	
}
