<?php

use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $sites = ['facebook', 'instagram', 'twitter'];

      foreach ($sites as $site) {
        $seed = new App\Sites();
        $seed -> name = $site;
        $seed -> save();
      }
    }
}
