<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_products', function (Blueprint $table) {
            $table->integer('product_id_s')->unsigned();
            $table->integer('product_id_t')->unsigned();

            $table->primary(['product_id_s', 'product_id_t']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('related_products');
    }
}
