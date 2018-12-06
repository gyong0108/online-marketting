<?php

use Illuminate\Database\Seeder;

class CampaignSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Online Marketing', 'keywords' => 'Online Marketing, Marketing Online, Online Marketing München', 'daily_budget' => 10, 'title' => '12345678901234567890', 'undertitle' => '12345678901234567890', 'shortdescription' => '123456789012345678901234567890123456789012345678901234567890', 'description' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890', 'logo' => null, 'image' => null, 'email' => null, 'active' => 0, 'created_by_id' => 1,],

        ];

        foreach ($items as $item) {
            \App\Campaign::create($item);
        }
    }
}
