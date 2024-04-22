<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MeneuManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name')->nullable();
            $table->integer('sorting')->default(0)->nullable();
            $table->string('image')->nullable();
            $table->boolean('active')->nullable()->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('menu_catalogues', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_categories_id');
            $table->string('short_code');
            $table->string('menu_name');
            $table->integer('sale_price');
            $table->integer('current_stock');
            $table->integer('food_type');
            $table->string('image')->nullable();
            $table->boolean('active')->nullable()->default(0);
            $table->string('description', 400)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('outlets_menu', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name');
            $table->integer('outlet_id');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('food_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->softDeletes();
            $table->timestamps();
        });

        Artisan::call('db:seed --class=FoodTypes');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_categories');
        Schema::dropIfExists('menu_catalogues');
        Schema::dropIfExists('outlets_menu');
    }
}
