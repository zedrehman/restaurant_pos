<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExpenseType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_type', function (Blueprint $table) {
            $table->id();
            $table->string('type_name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('outlet_expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('outlet_id');
            $table->integer('expense_type_id');
            $table->date('expense_date')->nullable();
            $table->decimal('expense_amount', 18, 2)->nullable();            
            $table->string('description')->nullable();
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
        Schema::dropIfExists('expense_type');
        Schema::dropIfExists('outlet_expenses');
    }
}
