<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class CitySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();
        
        $data = [
            [
                'name'  => 'Sarajevo',
                'country_id'  => '1',
            ],    
            [
                'name'  => 'Tuzla',
                'country_id'  => '1',
            ],                                                                              
        ];
        
        DB::table('cities')->insert($data);
    }
}
