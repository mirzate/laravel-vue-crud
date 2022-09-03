<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        # php artisan db:seed --class=CountrySeeder
        # php artisan db:seed --class=CitySeeder
        # php artisan db:seed --class=IndustrySeeder
        # php artisan db:seed --class=ContactTypeSeeder
        # php artisan db:seed --class=CustomerSeeder

        $this->call(CountrySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(IndustrySeeder::class);
        $this->call(ContactTypeSeeder::class);
        \App\Models\Customer::factory(10)->create(); 
        \App\Models\Contact::factory(10)->create(); 
    }
}
