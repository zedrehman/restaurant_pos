<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OutletUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_no', 20)->after('email')->nullable();
            $table->integer('outlet_id')->after('remember_token');
            $table->string('address', 400)->after('outlet_id')->nullable();
            $table->integer('city_id')->after('address')->nullable();
            $table->integer('postal_code')->after('city_id')->nullable();
            $table->boolean('active')->after('postal_code')->default(1);
        });

        Schema::create('user_type', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('outlet_id');
            $table->dropColumn('phone_no');
            $table->dropColumn('address');
            $table->dropColumn('city_id');
            $table->dropColumn('postal_code');
            $table->dropColumn('active');
        });

        Schema::dropIfExists('user_type');
    }
}
