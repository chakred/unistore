<?php

namespace Modules\Model\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Model\Entities\Model as CarModel;
use Modules\Mark\Entities\Mark;

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
        $markId = Mark::whereSlug('renault')->first()->id;

        // Warning.
        if ($markId) {
            $this->command->error('Error! Mark id is not found. Marks table must be seeded firstly.');
            return;
        }

        $models = [
            [
                'name' => 'Megane 1',
                'mark_id' => $markId,
                'year_start' => 2001,
                'year_end' => 2006,
                'engine' => "1.5",
                'engine_type' => 'fuel',
                'transmission' => 'manual',
                'transmission_type' => 'mechanic',
                'slug' => Str::slug('Megane 1', '-')
            ],
            [
                'name' => 'Megane 2',
                'mark_id' => $markId,
                'year_start' => 2006,
                'year_end' => 2010,
                'engine' => "1.5",
                'engine_type' => 'fuel',
                'transmission' => 'manual',
                'transmission_type' => 'mechanic',
                'slug' => Str::slug('Megane 2', '-')
            ],
            [
                'name' => 'Megane 3',
                'mark_id' => $markId,
                'year_start' => 2010,
                'year_end' => 2014,
                'engine' => "1.5",
                'engine_type' => 'fuel',
                'transmission' => 'manual',
                'transmission_type' => 'mechanic',
                'slug' => Str::slug('Megane 3', '-')
            ]
        ];

        foreach ($models as $model) {
            CarModel::firstOrcreate($model);
        }
        // $this->call("OthersTableSeeder");
    }
}
