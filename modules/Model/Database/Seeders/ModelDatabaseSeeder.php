<?php

namespace Modules\Model\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Mark\Entities\Mark;
use Modules\Model\Entities\Model;

class ModelDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $markId = Mark::firstOrCreate([
            'name' => 'Renault',
            'slug' => Str::slug('Renault', '-')
        ])->id;

        $models = [
            [
                'name' => 'Megane 1',
                'year_start' => 2001,
                'year_end' => 2003,
                'engine' => "1.5",
                'engine_type' => 'fuel',
                'transmission' => 'manual',
                'transmission_type' => 'mechanic',
                'slug' => Str::slug('Megane 1', '-'),
                'mark_id' => $markId
            ],
            [
                'name' => 'Megane 2',
                'year_start' => 2002,
                'year_end' => 2009,
                'engine' => "1.5",
                'engine_type' => 'fuel',
                'transmission' => 'manual',
                'transmission_type' => 'mechanic',
                'slug' => Str::slug('Megane 2', '-'),
                'mark_id' => $markId
            ],
            [
                'name' => 'Megane 3',
                'year_start' => 2008,
                'year_end' => 2014,
                'engine' => "1.5",
                'engine_type' => 'fuel',
                'transmission' => 'manual',
                'transmission_type' => 'mechanic',
                'slug' => Str::slug('Megane 3', '-'),
                'mark_id' => $markId
            ]
        ];

        foreach ($models as $model) {
            Model::firstOrCreate($model);
        }
        // $this->call("OthersTableSeeder");
    }
}
