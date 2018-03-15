<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::enableForeignKeyConstraints();
        Schema::create('sales', function (Blueprint $table) {
            $table->decimal('price',7,2);
            $table->integer('product_id');
            $table->integer('customer_id');
            $table->timestamps();
           
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('customer_id')->references('customer_id')->on('customers');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
