<?php
use Illuminate\Database\Seeder;
class FarmerTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$faker = Faker\Factory::create ();
		
		for($i = 0; $i < 10; $i ++) {
			DB::table ( 'Farmer' )->insert ( [ 
					'farmer_name' => $faker->name,
					'password' => $faker->password,
					'email' => $faker->unique ()->email 
			] );
		}
	}
}
