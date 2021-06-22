<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('name',50);
            $table->string('spec',250)->nullable();
            $table->foreignId('category_id')->constrained();
            $table->integer('price_avgcost')->default(0);
            $table->integer('price')->unsigned()->default(0);
            $table->integer('qty')->default(1);
            $table->string('pic')->nullable();
            $table->text('desc')->nullable();
            $table->bigInteger('browse_count')->default(0);
            $table->boolean('enabled')->default(true);
            $table->boolean('hoted')->default(false);
            $table->string('remark',500)->nullable();
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('products');
    }
}
