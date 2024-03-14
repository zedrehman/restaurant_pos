<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Coupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_name', 255)->nullable();
            $table->string('coupon_code', 255)->nullable();
            $table->boolean('coupon_type')->default(1)->comment("1=Fixed, 2=percentage");
            $table->string('amount', 10);
            $table->string('max_off', 10)->nullable();
            $table->string('end_date', 255)->nullable();
            $table->string('description', 255)->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
