<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5bb4c7882e1f5CampaignKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('campaign_keyword')) {
            Schema::create('campaign_keyword', function (Blueprint $table) {
                $table->integer('campaign_id')->unsigned()->nullable();
                $table->foreign('campaign_id', 'fk_p_214972_214973_keywor_5bb4c7882e34a')->references('id')->on('campaigns')->onDelete('cascade');
                $table->integer('keyword_id')->unsigned()->nullable();
                $table->foreign('keyword_id', 'fk_p_214973_214972_campai_5bb4c7882e408')->references('id')->on('keywords')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_keyword');
    }
}
