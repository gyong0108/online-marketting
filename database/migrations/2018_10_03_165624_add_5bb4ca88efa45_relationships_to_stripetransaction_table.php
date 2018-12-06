<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bb4ca88efa45RelationshipsToStripeTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stripe_transactions', function(Blueprint $table) {
            if (!Schema::hasColumn('stripe_transactions', 'transaction_user_id')) {
                $table->integer('transaction_user_id')->unsigned()->nullable();
                $table->foreign('transaction_user_id', '214975_5bb4ca881e1f9')->references('id')->on('users')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stripe_transactions', function(Blueprint $table) {
            
        });
    }
}
