<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('note')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->unsignedBigInteger('district_id');
            $table->integer('subtotal');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('orderitem_id');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('orderitem_id')->references('id')->on('order_items');
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
        Schema::dropIfExists('orders');
    }
}
