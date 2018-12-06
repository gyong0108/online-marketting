<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$OrXlpW4990hbqjRQcaOmRO0mE4kmGfVhBN9DE5oQga0E5aReYpGGG', 'remember_token' => '', 'approved' => 1, 'premium' => 0, 'stripe_customer_id' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
