<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'bsmtrans',
                'email' => 'bsm@gmail.com',
                'password' => bcrypt('bsmtrans'),
            ],
        ];

        User::insert($user);
    }
}
