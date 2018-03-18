<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::enableForeignKeyConstraints();
        Schema::create('purchases', function (Blueprint $table) {
            $table->decimal('price',7,2);
            $table->enum('status', ['SALABLE', 'DAMAGED-SALABLE','DAMAGED']);            
            $table->integer('product_id');
            $table->integer('supplier_id');
            
            //supplier_id column on the  purchase table that references the supplier_id column on a suppliers table:
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers');
            //product_id column on the  purchase table that references the product_id column on a products table:
            $table->foreign('product_id')->references('product_id')->on('products');
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
        Schema::dropIfExists('purchase');
    }
}
