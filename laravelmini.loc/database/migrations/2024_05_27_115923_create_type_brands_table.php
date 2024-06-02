<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_brands', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('brand_id');
            $table->timestamps();
              
            $table->foreign('type_id')->references('id')->on('types')
               ->onDelete('cascade'); 

            $table->foreign('brand_id')->references('id')->on('brands')
               ->onDelete('cascade'); 
               
            $table->unique(['type_id', 'brand_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_brands');
    }
}
