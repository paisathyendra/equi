<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('cascade');
        });

        Schema::table('syndicates', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function(Blueprint $table) {
            $table->dropForeign('companies_user_id_foreign');
        });

        Schema::table('syndicates', function(Blueprint $table) {
            $table->dropForeign('syndicates_user_id_foreign');
        });
    }
}
