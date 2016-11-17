<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('degree')->insert([
            'name' => 'Хэлний бэлтгэл',
        ]);

        DB::table('degree')->insert([
            'name' => 'Бакалавар',
        ]);

        DB::table('degree')->insert([
            'name' => 'Магистр, Доктор',
        ]);
    }
}
