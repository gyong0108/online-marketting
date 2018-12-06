<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1538575825CampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            if(Schema::hasColumn('campaigns', 'adgroup_id')) {
                $table->dropForeign('214972_5bb4ccb65c6dd');
                $table->dropIndex('214972_5bb4ccb65c6dd');
                $table->dropColumn('adgroup_id');
            }
            
        });
Schema::table('campaigns', function (Blueprint $table) {
            
if (!Schema::hasColumn('campaigns', 'name')) {
                $table->string('name')->nullable();
                }
if (!Schema::hasColumn('campaigns', 'keywords')) {
                $table->text('keywords')->nullable();
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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('keywords');
            
        });
Schema::table('campaigns', function (Blueprint $table) {
                        
        });

    }
}
