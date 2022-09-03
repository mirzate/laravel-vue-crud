<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ContactTypeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_types')->delete();
        
        $data = [
            [
                'name'  => 'Phone',
            ],    
            [
                'name'  => 'Mobile',
            ],   
            [
                'name'  => 'Email',
            ],   
            [
                'name'  => 'Sype',
            ],                                                                              
        ];
        
        DB::table('contact_types')->insert($data);
    }
}
