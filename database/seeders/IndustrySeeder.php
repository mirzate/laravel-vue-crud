<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class IndustrySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('industries')->delete();
        
        $data = [
            [
                'name'  => 'Chemical industry',
            ],    
            [
                'name'  => 'Rail Industry',
            ],                                                                              
        ];
        
        DB::table('industries')->insert($data);
    }
}
