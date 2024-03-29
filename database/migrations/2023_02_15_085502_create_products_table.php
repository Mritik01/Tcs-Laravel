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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('catid');
            $table->integer('subcatid');
            $table->string('product_name');
            $table->string('product_des');
            $table->string('product_img')->nullable();
            $table->integer('regprice');
            $table->integer('saleprice');
            $table->integer('stock');
            $table->integer('status')->default(1)->comment('1 for active and 0 for false');
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
        Schema::dropIfExists('products');
    }
};
