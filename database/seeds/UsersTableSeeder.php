<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		
		
		$users = array(
		
				[
                    'name' => 'Administrator',
                    'email' => 'admin@app.com',
                    'password' => bcrypt('123456'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'Agency',
                    'email' => 'agency@app.com',
                    'password' => bcrypt('123456'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'End',
                    'email' => 'endcustomer@app.com',
                    'password' => bcrypt('123456'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
		);
		
		
	    	DB::table('users')->insert($users);

    }
}
