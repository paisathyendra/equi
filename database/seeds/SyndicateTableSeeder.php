<?php

use Illuminate\Database\Seeder;

class SyndicateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Syndicate::class, 10)->create();
    }
}
