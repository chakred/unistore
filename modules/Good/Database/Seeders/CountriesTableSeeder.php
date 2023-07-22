<?php

namespace Modules\Good\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Good\Entities\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $countries = [
            ['name' => 'USA', 'slug' => 'us'],
            ['name' => 'CHINA', 'slug' => 'cn'],
            ['name' => 'Germany', 'slug' => 'de'],
            ['name' => 'France', 'slug' => 'fr'],
            ['name' => 'Spain', 'slug' => 'es'],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate($country);
        }
        // $this->call("OthersTableSeeder");
    }
}
