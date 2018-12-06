<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'user_management_access',],
            ['id' => 2, 'title' => 'permission_access',],
            ['id' => 3, 'title' => 'permission_create',],
            ['id' => 4, 'title' => 'permission_edit',],
            ['id' => 5, 'title' => 'permission_view',],
            ['id' => 6, 'title' => 'permission_delete',],
            ['id' => 7, 'title' => 'role_access',],
            ['id' => 8, 'title' => 'role_create',],
            ['id' => 9, 'title' => 'role_edit',],
            ['id' => 10, 'title' => 'role_view',],
            ['id' => 11, 'title' => 'role_delete',],
            ['id' => 12, 'title' => 'user_access',],
            ['id' => 13, 'title' => 'user_create',],
            ['id' => 14, 'title' => 'user_edit',],
            ['id' => 15, 'title' => 'user_view',],
            ['id' => 16, 'title' => 'user_delete',],
            ['id' => 17, 'title' => 'user_action_access',],
            ['id' => 18, 'title' => 'user_action_create',],
            ['id' => 19, 'title' => 'user_action_edit',],
            ['id' => 20, 'title' => 'user_action_view',],
            ['id' => 21, 'title' => 'user_action_delete',],
            ['id' => 22, 'title' => 'internal_notification_access',],
            ['id' => 23, 'title' => 'internal_notification_create',],
            ['id' => 24, 'title' => 'internal_notification_edit',],
            ['id' => 25, 'title' => 'internal_notification_view',],
            ['id' => 26, 'title' => 'internal_notification_delete',],
            ['id' => 28, 'title' => 'campaign_access',],
            ['id' => 29, 'title' => 'campaign_create',],
            ['id' => 30, 'title' => 'campaign_edit',],
            ['id' => 31, 'title' => 'campaign_view',],
            ['id' => 32, 'title' => 'campaign_delete',],
            ['id' => 38, 'title' => 'request_access',],
            ['id' => 39, 'title' => 'request_create',],
            ['id' => 40, 'title' => 'request_edit',],
            ['id' => 41, 'title' => 'request_view',],
            ['id' => 42, 'title' => 'request_delete',],
            ['id' => 43, 'title' => 'stripe_transaction_access',],
            ['id' => 44, 'title' => 'stripe_transaction_create',],
            ['id' => 45, 'title' => 'stripe_transaction_edit',],
            ['id' => 46, 'title' => 'stripe_transaction_view',],
            ['id' => 47, 'title' => 'stripe_transaction_delete',],
            ['id' => 48, 'title' => 'stripe_upgrade_access',],
            ['id' => 49, 'title' => 'stripe_upgrade_create',],
            ['id' => 50, 'title' => 'stripe_upgrade_edit',],
            ['id' => 51, 'title' => 'stripe_upgrade_view',],
            ['id' => 52, 'title' => 'stripe_upgrade_delete',],
            ['id' => 53, 'title' => 'subscription_access',],
            ['id' => 54, 'title' => 'subscription_create',],
            ['id' => 55, 'title' => 'subscription_edit',],
            ['id' => 56, 'title' => 'subscription_view',],
            ['id' => 57, 'title' => 'subscription_delete',],
            ['id' => 58, 'title' => 'payment_access',],
            ['id' => 59, 'title' => 'payment_create',],
            ['id' => 60, 'title' => 'payment_edit',],
            ['id' => 61, 'title' => 'payment_view',],
            ['id' => 62, 'title' => 'payment_delete',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
