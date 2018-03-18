<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::enableForeignKeyConstraints();
        Schema::create('returns', function (Blueprint $table) {
            $table->integer('return_id')->autoIncrement()->unique();
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->timestamps();
           
            
            // ->references('customer_id')->on('customers');
            $table->foreign('customer_id')->references('customer_id')->on('customers');
            //->references('product_id')->on('products');
            $table->foreign('product_id')->references('product_id')->on('products');   
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returns');
    }
}
