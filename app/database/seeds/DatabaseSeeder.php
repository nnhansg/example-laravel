<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('UserTableSeeder');

        $this->command->info('User table seeded!');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array('name' => 'Nhan Nguyen 1',
        					'email' => 'nnhansg@gmail.com',
        					'password' => '$2y$10$HErIfhs/awvLVSmwuQrLM.xVY2ZQAfuELGJIeCPBPh5oBsf7cv9LW'));

        User::create(array('name' => 'Nhan Nguyen 2',
        					'email' => 'nhantidus@gmail.com',
        					'password' => '$2y$10$HErIfhs/awvLVSmwuQrLM.xVY2ZQAfuELGJIeCPBPh5oBsf7cv9LW'));
    }

}