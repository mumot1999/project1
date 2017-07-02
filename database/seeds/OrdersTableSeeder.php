<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $seed = new App\Orders();
      $seed -> user_id = 1;
      $seed -> url = "facebook.pl/moje_zdj";
      $seed -> score_target = 100;
      $seed -> site_id = 1;
      $seed -> action_id = 2;
      $seed -> cost = 10;
      $seed -> expiry_date = "2017-07-01 00:00:00";
      $seed -> save();

      $seed = new App\Orders();
      $seed -> user_id = 1;
      $seed -> url = "facebook.pl/moje_zdj2";
      $seed -> score_target = 1001;
      $seed -> site_id = 1;
      $seed -> action_id = 2;
      $seed -> cost = 7;
      $seed -> expiry_date = "2017-07-01 00:00:00";
      $seed -> save();
    }
}
