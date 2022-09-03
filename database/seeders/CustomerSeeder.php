<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class CustomerSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->delete();
        
        $data = [
            [
                'name'  => 'Lunarpages Ltd',
                'city_id'  => '1',
                'address'  => '45  Caxton Place',
                'industry_id'  => '1'
            ],    
                                                                          
        ];
        
        DB::table('customers')->insert($data);
    }
}
