<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $now = new DateTime;
        $users = [
          [
            'name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin@111xyz&!'),
          ],
          [
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('admin@222xyz&!'),
          ],
          [
            'name' => 'admin3',
            'email' => 'admin3@gmail.com',
            'password' => Hash::make('admin@333xyz&!'),
          ],
        ];

        foreach ($users as $user) {
          User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password'],
          ]);
        }

    }
}
