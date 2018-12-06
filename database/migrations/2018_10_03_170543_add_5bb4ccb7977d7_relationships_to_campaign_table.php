<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bb4ccb7977d7RelationshipsToCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaigns', function(Blueprint $table) {
            if (!Schema::hasColumn('campaigns', 'adgroup_id')) {
                $table->integer('adgroup_id')->unsigned()->nullable();
                $table->foreign('adgroup_id', '214972_5bb4ccb65c6dd')->references('id')->on('keywords')->onDelete('cascade');
                }
                if (!Schema::hasColumn('campaigns', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '214972_5bb4c721d24a3')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('campaigns', function(Blueprint $table) {
            
        });
    }
}
