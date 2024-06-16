<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_master', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_no');
            $table->tinyText('address');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('order_table', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id')->nullable();
            $table->integer('kot')->nullable();
            $table->integer('table_id')->nullable();
            $table->string('bill_type')->nullable();
            $table->decimal('total_bill_amount', 18, 2)->nullable();
            $table->decimal('discount', 18, 2)->nullable();
            $table->decimal('cgts_value', 18, 2)->nullable();
            $table->decimal('cgts', 18, 2)->nullable();
            $table->decimal('sgts_value', 18, 2)->nullable();
            $table->decimal('sgts', 18, 2)->nullable();
            $table->decimal('igts_value', 18, 2)->nullable();
            $table->decimal('igts', 18, 2)->nullable();
            $table->decimal('total_bill_amount_with_tax', 18, 2)->nullable();
            $table->integer('payment_id')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('transaction_id')->nullable();
            $table->tinyInteger('is_bill_saved')->default(0);
            $table->integer('customer_id')->nullable();
            $table->string('kot_note')->nullable();
            $table->tinyInteger('is_settled')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('order_table_menu_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('menu_id');
            $table->integer('quantity');
            $table->decimal('amount', 18, 2);
            $table->decimal('total', 18, 2);
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
        Schema::dropIfExists('customer_master');
        Schema::dropIfExists('order_table');
        Schema::dropIfExists('order_table_menu_items');
    }
}
