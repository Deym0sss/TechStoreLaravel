<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('price');
            $table->string('img');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('brand_id');
            $table->timestamps();
         
            $table->foreign('type_id')->references('id')->on('types')
             ->onDelete('cascade'); 
       
            $table->foreign('brand_id')->references('id')->on('brands')
             ->onDelete('cascade'); 
        });
    }
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
