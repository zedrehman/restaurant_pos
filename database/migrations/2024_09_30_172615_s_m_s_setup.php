<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SMSSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_setup', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id');
            $table->string('api')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('sender_id')->nullable();
            $table->string('template')->nullable();
            $table->string('template_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('email_setup', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id');
            $table->string('from_email')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('host')->nullable();
            $table->string('port')->nullable();
            $table->string('ssl')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('printer_setup', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id');
            $table->string('header_footer_size')->nullable();
            $table->string('item_font_size')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('terms_conditions_font_size')->nullable();
            $table->string('terms_conditions')->nullable();
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
        Schema::dropIfExists('sms_setup');
        Schema::dropIfExists('email_setup');
        Schema::dropIfExists('printer_setup');
    }
}
