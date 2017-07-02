<?php

use Illuminate\Database\Seeder;

class ActionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['follow', 'like', 'view'];

        foreach ($names as $name) {
          $action = new \App\ActionType;
          $action -> name = $name;
          $action -> save();
        }

    }
}
