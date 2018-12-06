<?php

use Illuminate\Database\Seeder;

class RoleSeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            1 => [
                'permission' => [1, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 28, 29, 30, 31, 32, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 2, 3, 4, 5, 6],
            ],
            2 => [
                'permission' => [17, 18, 19, 20, 22, 23, 24, 25, 28, 29, 30, 31, 32, 39, 43, 44, 45, 46, 48, 49, 50, 51, 53, 54, 55, 56, 58, 59, 60, 61, 2, 3, 4, 5],
            ],
            3 => [
                'permission' => [28, 29, 30, 31, 32, 39],
            ],
            4 => [
                'permission' => [28, 29, 30, 31, 32, 39],
            ],
            5 => [
                'permission' => [28, 29, 30, 31, 32, 39],
            ],

        ];

        foreach ($items as $id => $item) {
            $role = \App\Role::find($id);

            foreach ($item as $key => $ids) {
                $role->{$key}()->sync($ids);
            }
        }
    }
}
