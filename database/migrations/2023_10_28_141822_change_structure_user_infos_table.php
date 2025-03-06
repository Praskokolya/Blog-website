<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStructureUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_infos', function (Blueprint $table) {
            $table->dropColumn('birthdate');
            $table->dropColumn('interests');
            $table->dropColumn('gender');
            $table->dropColumn('image');
            $table->dropColumn('registred_users_id');
        });

        Schema::table('user_infos', function (Blueprint $table) {
            $table->string('birthdate')->nullable()->default(null);
            $table->text('interests')->nullable()->default(null);
            $table->string('gender')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->integer('registred_users_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
