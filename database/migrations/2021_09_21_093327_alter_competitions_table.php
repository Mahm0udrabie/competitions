<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->date('start')->nullable();
            $table->date('end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competitions', function (Blueprint $table) {
            if (Schema::hasColumn('competitions', 'start') && Schema::hasColumn('competitions', 'end')) {
                $table->dropColumn('start');
                $table->dropColumn('end');
            }
        });
    }
}
