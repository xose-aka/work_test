<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplier1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_1', function (Blueprint $table) {
            $table->id();
            $table->string('codart');
            $table->string('descrizione_marca');
            $table->string('macrocategoria');
            $table->string('categoria');
            $table->string('subcategoria');
            $table->string('descrizione_aggiuntiva');
            $table->string('scheda')->nullable();
            $table->double('prezzolistino');
            $table->integer('disponibilita');
            $table->double('spesespedizione');
            $table->string('immagine');
            $table->string('serial');
            $table->string('ean');
            $table->string('descrizione_articolo');
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
        Schema::dropIfExists('supplier_1');
    }
}
