<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1538574832RequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('requests')) {
            Schema::create('requests', function (Blueprint $table) {
                $table->increments('id');
                $table->string('landingpage');
                $table->string('target')->nullable();
                $table->string('city')->nullable();
                $table->string('not_clear')->nullable();
                $table->tinyInteger('no_phonenumber')->nullable()->default('0');
                $table->tinyInteger('no_email')->nullable()->default('0');
                $table->tinyInteger('no_form')->nullable()->default('0');
                $table->tinyInteger('no_content')->nullable()->default('0');
                $table->tinyInteger('no_faq')->nullable()->default('0');
                $table->string('other_keywords')->nullable();
                $table->datetime('aswered')->nullable();
                
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
        Schema::dropIfExists('requests');
    }
}
