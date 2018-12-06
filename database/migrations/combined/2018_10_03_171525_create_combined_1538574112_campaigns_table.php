<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1538574112CampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('campaigns')) {
            Schema::create('campaigns', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->text('keywords')->nullable();
                $table->integer('daily_budget')->nullable();
                $table->string('title');
                $table->string('undertitle');
                $table->string('shortdescription')->nullable();
                $table->string('description');
                $table->string('logo')->nullable();
                $table->string('image')->nullable();
                $table->string('email')->nullable();
                $table->tinyInteger('active')->nullable()->default('1');
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('campaigns');
    }
}
