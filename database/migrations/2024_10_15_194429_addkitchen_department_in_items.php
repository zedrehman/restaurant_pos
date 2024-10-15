<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddkitchenDepartmentInItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_catalogues', function (Blueprint $table) {
            $table->integer('kitchen_department_id')->nullable()->after('food_type');
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
            $table->dropColumn('kitchen_department_id');
        });
    }
}
