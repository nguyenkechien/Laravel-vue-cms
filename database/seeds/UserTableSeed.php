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
            'name' => 'webadmin1',
            'email' => 'webadmin1@gmail.com',
            'password' => Hash::make('Webadmin@111xyz&!'),
          ],
          [
            'name' => 'webadmin2',
            'email' => 'webadmin2@gmail.com',
            'password' => Hash::make('Webadmin@222xyz&!'),
          ],
          [
            'name' => 'webadmin3',
            'email' => 'webadmin3@gmail.com',
            'password' => Hash::make('Webadmin@333xyz&!'),
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
