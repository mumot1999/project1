<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new App\User();
      $user -> name = "Bartek";
      $user -> email = "mumot1999@gmail.com";
      $user -> password = bcrypt('mamut123');
      $user -> save();

      $user = new App\User;
      $user -> name = "Kuba";
      $user -> email = "kuba@gmail.com";
      $user -> password = bcrypt('mamut123');
      $user -> save();
    }
}
