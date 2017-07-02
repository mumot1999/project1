<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('url');
            $table->integer('score_target');
            $table->integer('site_id')->unsigned();
            $table->integer('action_id')->unsigned();
            $table->integer('cost');
            $table->DateTime('expiry_date');
            $table->timestamps();
        });

        // Schema::table('orders', function (Blueprint $table) {
        //   $table->foreign('author_id')
        //     ->references('id')
        //     ->on('users');
        // });
        //
        // Schema::table('orders', function (Blueprint $table) {
        //   $table->foreign('site_id')
        //     ->references('id')
        //     ->on('sites');
        // });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
