<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class UserWalletSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $users = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'someeamil@email.com',
                'age' => 18,
                'password' => bcrypt('password!1'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'Donald Trump',
                'email' => 'trump@email.com',
                'age' => 79,
                'password' => bcrypt('makeAmericaGreatAgain!'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        User::insertOrIgnore($users);

        $wallets = [
            [
                'id' => 1,
                'user_id' => $users[0]['id'],
                'balance' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'user_id' => $users[1]['id'],
                'balance' => 100000000.24,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        Wallet::insertOrIgnore($wallets);
    }
}
