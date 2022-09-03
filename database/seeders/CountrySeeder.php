<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class CountrySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
        
        $data = [
            [
                'name'  => 'Bosnia and Herzegovina',
            ],
            [
                'name'  => 'United Kingdom',
            ],
            [
                'name'  => 'Njemacka',
            ],
            [
                'name'  => 'Austria',
            ],                                                                     
        ];
        
        DB::table('countries')->insert($data);
    }
}
