<?php

use App\User;
use Illuminate\Database\Seeder;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Ahmad Muhrani',
            'email' => 'ahmadmuhrani89@gmail.com',
            'password' => bcrypt('sundulgan')
        ]);
    }
}
