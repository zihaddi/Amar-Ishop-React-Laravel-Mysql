<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('oid');
            $table->unsignedBigInteger('pid');
            $table->foreign('oid')->references('id')->on('orders');
            $table->foreign('pid')->references('id')->on('products');
            $table->integer('quantity');
            $table->integer('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderdetails');
    }
};
