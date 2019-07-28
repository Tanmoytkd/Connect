<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'id' => 0,
            'parent_id' => 0,
            'section_type' => 'master',
            'name' => 'master'
        ]);
    }
}
