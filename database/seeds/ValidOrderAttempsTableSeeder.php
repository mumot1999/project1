<?php

use Illuminate\Database\Seeder;

class ValidOrderAttempsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $validAttemps = new App\ValidOrderAttemps;
        $validAttemps -> attempt_id = 1;
        $validAttemps -> save();
    }
}
