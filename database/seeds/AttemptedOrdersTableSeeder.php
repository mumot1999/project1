<?php

use Illuminate\Database\Seeder;

class AttemptedOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $attemptedOrders = new \App\AttemptedOrders;
      $attemptedOrders -> user_id = 1;
      $attemptedOrders -> order_id = 1;
      $attemptedOrders -> valid = 1;
      $attemptedOrders -> save();
    }
}
