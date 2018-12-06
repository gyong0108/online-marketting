<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Drop5bb4cdd26cc3a5bb4cdd26a464CampaignKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('campaign_keyword');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(! Schema::hasTable('campaign_keyword')) {
            Schema::create('campaign_keyword', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('campaign_id')->unsigned()->nullable();
            $table->foreign('campaign_id', 'fk_p_214972_214973_keywor_5bb4c7882b62e')->references('id')->on('campaigns');
                $table->integer('keyword_id')->unsigned()->nullable();
            $table->foreign('keyword_id', 'fk_p_214973_214972_campai_5bb4c7882c642')->references('id')->on('keywords');
                
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
}
