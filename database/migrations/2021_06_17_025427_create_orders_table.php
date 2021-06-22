<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('rowid')->nullable();
            $table->string('serial',50)->nullable();
            $table->foreignId('user_id')->constrained();
            $table->string('status',50)->default('TBC');
            $table->string('type',50)->default('B');
            $table->timestamp('schedule_at')->nullable();
            $table->string('table_serial')->nullable();
            $table->string('pay_type',50)->nullable();
            $table->string('receive_name',50)->nullable();
            $table->string('receive_phone',50)->nullable();
            $table->string('receive_address',250)->nullable();
            $table->boolean('paided')->default(false);
            $table->string('remark',250)->nullable();
            $table->integer('total')->default(0);
            $table->string('paid_serial',50)->nullable();
            $table->string('paid_remark',250)->nullable();
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('orders');
    }
}
