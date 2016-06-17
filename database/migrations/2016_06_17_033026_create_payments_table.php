<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no');
            $table->integer('product_id');
            $table->string('product_name');
            $table->string('product_details',500);
            $table->decimal('fee');
            $table->string('status');
            $table->string('status_text')->nullable();
            $table->string('payment_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('payments');
    }
}
