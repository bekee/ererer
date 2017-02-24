<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', ['uses' => 'IndexController@index']);
Route::get('login', ['uses' => 'LoginController@index']);
Route::post('login', ['uses' => 'LoginController@login']);
Route::get('logout', ['uses' => 'IndexController@logout']);
Route::get('signup', ['uses' => 'IndexController@signup']);
Route::post('signup', ['uses' => 'IndexController@signupClient']);
Route::get('signup/{referralCode?}', ['uses' => 'IndexController@referral']);
Route::post('signup_ref', ['uses' => 'IndexController@signupReferral']);


Route::group(['middleware' => 'auth'], function () {
	Route::group(['namespace' => 'Admin', 'middleware' => ['role:admin'], 'prefix' => 'admin'], function () {
		Route::get('/', ['uses' => 'DashboardController@index']);
		
		Route::get('banks', ['uses' => 'BankController@index']);
		Route::get('bank/{id}/edit', ['uses' => 'BankController@edit']);
		Route::post('banks', ['uses' => 'BankController@newBank']);
		Route::patch('banks/{id}', ['uses' => 'BankController@update']);
		
		Route::get('first_time_referral_bonuses', ['uses' => 'ReferralBonusController@index']);
		Route::post('first_time_referral_bonuses', ['uses' => 'ReferralBonusController@newBonus']);
		
		Route::get('cycler', ['uses' => 'CyclerController@index']);
		Route::get('cycler/{id}/edit', ['uses' => 'CyclerController@edit']);
		Route::get('r_cycler/{id}', ['uses' => 'CyclerController@destroy']);
		Route::post('cycler', ['uses' => 'CyclerController@newCycle']);
		Route::patch('cycler/{id}', ['uses' => 'CyclerController@update']);
		
		
		Route::get('publish', ['uses' => 'MatchesController@publish']);
		Route::get('matches', ['uses' => 'MatchesController@index']);
		Route::get('match/{id}', ['uses' => 'MatchesController@matchMe']);
		Route::post('match/{id}', ['uses' => 'MatchesController@match']);
		
		//Other Setting
		Route::get('other_setting', ['uses' => 'OtherSettingController@index']);
		Route::patch('other_setting/{id}', ['uses' => 'OtherSettingController@update']);
		
		
		//Provide Help
		Route::get('provide_help', ['uses' => 'ProvideHelpController@index']);
		
		//Get Help
		Route::get('get_help', ['uses' => 'GetHelpController@index']);
		
		
		//Clear SAves
		Route::get('clear', ['uses' => 'MatchesController@clear']);
		
		//Clients
		Route::get('active_clients', ['uses' => 'ClientController@active']);
		
	});
	
	Route::group(['namespace' => 'Client', 'middleware' => ['role:client', 'blocked', 'suspend'], 'prefix' => 'dashboard'], function () {
		
		//Email Confirmation
		Route::get('email_sent', ['uses' => 'EmailController@emailSent']);
		Route::get('email_not_confirmed', ['uses' => 'EmailController@notConfirmed']);
		Route::get('resend_email', ['uses' => 'EmailController@resend']);
		Route::get('confirm_email/{code}', ['uses' => 'EmailController@confirm']);
		
		
		Route::group(['middleware' => 'email'], function () {
			
			//Add A Bank
			Route::get('add_bank', ['uses' => 'MyBankController@index']);
			Route::post('add_bank', ['uses' => 'MyBankController@add']);
			Route::post('change_bank', ['uses' => 'MyBankController@change']);
			
			Route::group(['middleware' => 'bank'], function () {
				
				Route::get('/', ['uses' => 'DashboardController@index']);
				
				
				//Provide Help
				Route::get('provide_help', ['uses' => 'ProvideHelpController@index']);
				Route::post('provide_help', ['uses' => 'ProvideHelpController@provideHelp']);
				
				
				//Get Help
				Route::get('get_help', ['uses' => 'GetHelpController@index']);
				Route::post('get_help', ['uses' => 'GetHelpController@getHelp']);
				
				
				//My Referrals
				Route::get('my_referrals', ['uses' => 'MyReferralController@index']);
				
				//Bonuses
				Route::get('referral_bonuses', ['uses' => 'MyBonusController@index']);
				
				
				//Testimonies
				Route::get('testimonies', ['uses' => 'MyTestimonyController@index']);
				
				
				//Proof
				Route::patch('upload_proof/{id}', ['uses' => 'MyProofController@proof']);
				
				
				//Confirm Proof
				Route::get('confirm_proof/{id}', ['uses' => 'MyProofController@confirm']);
				
				//Add Hour
				Route::get('add_hour/{id}', ['uses' => 'MyProofController@addHour']);
				
				//Confirm
				Route::get('confirm_proof/{id}', ['uses' => 'MyProofController@confirm']);
				
				//Withdraw
				Route::get('to_wallet/{id}', ['uses' => 'MyProofController@withdraw']);
				
				//First Time Bonus Withdrawal
				Route::get('first_time/{id}', ['uses' => 'MyBonusController@withdraw']);
				
				
				//Withdraw Bonus
				Route::get('move_bonus', ['uses' => 'MyBonusController@BonusWithdraw']);
				
				
			});
		});
	});
});
