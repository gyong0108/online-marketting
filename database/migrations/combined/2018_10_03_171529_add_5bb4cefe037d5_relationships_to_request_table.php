<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bb4cefe037d5RelationshipsToRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests', function(Blueprint $table) {
            if (!Schema::hasColumn('requests', 'adgroup_id')) {
                $table->integer('adgroup_id')->unsigned()->nullable();
                $table->foreign('adgroup_id', '214974_5bb4c9f230eb1')->references('id')->on('campaigns')->onDelete('cascade');
                }
                if (!Schema::hasColumn('requests', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '214974_5bb4c9f24852c')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('requests', function(Blueprint $table) {
            if(Schema::hasColumn('requests', 'adgroup_id')) {
                $table->dropForeign('214974_5bb4c9f230eb1');
                $table->dropIndex('214974_5bb4c9f230eb1');
                $table->dropColumn('adgroup_id');
            }
            if(Schema::hasColumn('requests', 'created_by_id')) {
                $table->dropForeign('214974_5bb4c9f24852c');
                $table->dropIndex('214974_5bb4c9f24852c');
                $table->dropColumn('created_by_id');
            }
            
        });
    }
}
