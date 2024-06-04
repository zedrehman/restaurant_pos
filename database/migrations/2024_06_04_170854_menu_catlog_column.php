<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MenuCatlogColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_catalogues', function (Blueprint $table) {
            $table->string('ready_in')->nullable()->after('current_stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_catalogues', function (Blueprint $table) {
            $table->dropColumn('ready_in');
        });
    }
}
