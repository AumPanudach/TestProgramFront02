<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert(array(
            ['name' => 'อะไหล่'],
            ['name' => 'เครื่องแต่งกาย'],
            ['name' => 'รองเท้า'],
            ['name' => 'แว่นตา'],
            ['name' => 'อปกรณ์เสริม'],
            ['name' => 'อิเล็กทรอนิกส์']
        ));
    }
}
