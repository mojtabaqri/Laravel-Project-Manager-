<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusToState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('help_desks', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->enum('state',['Completed','referred','incompleted','doing'])->default('doing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('help_desks', function (Blueprint $table) {
            //
        });
    }
}
