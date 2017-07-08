<?php

use Illuminate\Database\Seeder;

class StartupCoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed = new App\StartupCoins;
        $seed -> coins = 50;
        $seed -> from = '2017-07-01 00:00:00';
        $seed -> to = '2017-07-10 00:00:00';
        $seed -> save();

    }
}
