<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Modifiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modifiers', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id');
            $table->string('modifier_name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('modifiers_ingredient', function (Blueprint $table) {
            $table->id();
            $table->integer('modifiers_id');
            $table->integer('ingrediant_id');
            $table->integer('quantity');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modifiers');
        Schema::dropIfExists('modifiers_ingredient');
    }
}
