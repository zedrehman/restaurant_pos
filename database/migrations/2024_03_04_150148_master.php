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
            $table->string('tax_display_name');
            $table->boolean('include_in_rate')->default(0);
            $table->boolean('is_dividable')->default(0);
            $table->boolean('active')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('kitchen_department', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id');
            $table->string('kitchen_department_name');
            $table->boolean('active')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('outlet_department', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id');
            $table->string('outlet_department_name');
            $table->integer('product_group_id');
            $table->boolean('active')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::create('table_management', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id');
            $table->string('table_name');
            $table->integer('outlet_department_id');
            $table->integer('max_person');
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
        Schema::dropIfExists('kitchen_department');
        Schema::dropIfExists('outlet_department');
        Schema::dropIfExists('table_management');
    }
}
