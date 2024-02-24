<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tablesetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('brand_short_name');
            $table->string('phone_number')->nullable();
            $table->string('FSSAI_no')->nullable();
            $table->string('GST_no')->nullable();
            $table->string('PAN_no')->nullable();
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->boolean('active')->default(0);
            $table->timestamps();
        });

        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->string('outlet_name');
            $table->time('start_day_time');
            $table->time('close_day_time');
            $table->dateTime('next _reset_bill_date')->nullable();
            $table->integer('next_reset_bill')->nullable();
            $table->dateTime('next_reset_kot_date')->nullable();
            $table->integer('next_reset_kot')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('notification_email')->nullable();
            $table->integer('city_id');
            $table->integer('zip_code');
            $table->string('locality')->nullable();
            $table->string('outlet_code')->nullable();
            $table->string('address');
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('active')->default(0)->comment('0 in active, 1 Active');
            $table->boolean('is_logout_pos')->default(0)->comment('0 in active, 1 Active');
            $table->boolean('is_passcode_protection')->default(0)->comment('0 in active, 1 Active');
            $table->string('GST_no')->nullable();
            $table->timestamps();
        });
        Schema::create('outlets_designation', function (Blueprint $table) {
            $table->id();
            $table->string('designation_name');
            $table->boolean('active')->default(0)->comment('0 in active, 1 Active');
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
        Schema::dropIfExists('brands');
        Schema::dropIfExists('outlets');
        Schema::dropIfExists('outlets_designation');
    }
}
