<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttemptedOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempted_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('valid')->unsigned();

            $table->json('usernames') -> nullable();

            // $table->DateTime('start');
            // $table->DateTime('end');
            $table->timestamps();
        });

        // Schema::table('attempted_orders', function (Blueprint $table) {
        //   $table->foreign('user_id')
        //     ->references('id')
        //     ->on('users');
        // });
        //
        // Schema::table('attempted_orders', function (Blueprint $table) {
        //   $table->foreign('order_id')
        //     ->references('id')
        //     ->on('orders');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attempted_orders');
    }
}
