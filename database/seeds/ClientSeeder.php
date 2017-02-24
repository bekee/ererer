<?php

use App\ClientDetail;
use App\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$user = new User();
		$user->email = "frank@gmail.com";
		$user->route = "dashboard";
		$user->password = bcrypt('12345');
		$user->phone = '+2349089765669';
		$user->email_confirm = 1;
		$user->save();
		
		$userClient = new ClientDetail();
		$userClient->first_name = "Emmanuel";
		$userClient->last_name = "Okafor";
		$userClient->user_id = $user->id;
		$userClient->created_by = $user->id;
		$userClient->updated_by = $user->id;
		$userClient->ref_code = "AkfdFDVDFDF";
		$userClient->ref_url = env('APP_URL') . "/signup/AkfdFDVDFDF";
		
		$userClient->save();
		
	}
}
