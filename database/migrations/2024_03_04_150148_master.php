<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Master extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_groups', function (Blueprint $table) {
            $table->id();
            $table->string('product_group_name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tax_configuration', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id');
            $table->string('tax_value');
            $table->string('tax_name');
            $table->integer('product_group_id');
            $table->integer('tax_display_name');
            $table->boolean('include_in_rate')->default(0);
            $table->boolean('is_dividable')->default(0);
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('product_groups');
        Schema::dropIfExists('tax_configuration');
    }
}
