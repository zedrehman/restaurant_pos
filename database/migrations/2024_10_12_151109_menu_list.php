<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MenuList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->integer('id');
            $table->string('id_name')->nullable();
            $table->string('menu_name');
            $table->string('menu_url')->nullable();
            $table->string('icon')->nullable();
            $table->integer('is_has_sub_menu')->nullable();
        });

        Schema::create('sub_menus', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('menu_id');
            $table->string('id_name')->nullable();
            $table->string('menu_name');
            $table->string('menu_url')->nullable();
            $table->string('icon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
        Schema::dropIfExists('sub_menus');
    }
}
