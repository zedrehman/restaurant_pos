<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ingrediant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingrediant', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id');
            $table->string('ingrediant_name')->nullable();
            $table->string('cost')->nullable();
            $table->integer('unit_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('ingrediant_stock', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id');
            $table->string('ingrediant_id')->nullable();
            $table->string('stock_value')->nullable();
            $table->string('ingrediant_price')->nullable();
            $table->date('stock_date')->nullable();
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
        Schema::dropIfExists('ingrediant');
        Schema::dropIfExists('ingrediant_stock');
    }
}
