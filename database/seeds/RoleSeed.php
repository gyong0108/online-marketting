<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Administrator (can create other users)', 'price' => null, 'stripe_plan_id' => null,],
            ['id' => 2, 'title' => 'Simple user', 'price' => null, 'stripe_plan_id' => null,],
            ['id' => 3, 'title' => 'free', 'price' => '0.00', 'stripe_plan_id' => 'free',],
            ['id' => 4, 'title' => 'Premium', 'price' => '29.95', 'stripe_plan_id' => 'premium',],
            ['id' => 5, 'title' => 'Professional', 'price' => '99.95', 'stripe_plan_id' => 'professional',],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
