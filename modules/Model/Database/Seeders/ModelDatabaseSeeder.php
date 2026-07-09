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

        $modelsByMark = [
            'Renault' => [
                ['name' => 'Megane 1', 'year_start' => 2001, 'year_end' => 2003, 'engine' => '1.5'],
                ['name' => 'Megane 2', 'year_start' => 2002, 'year_end' => 2009, 'engine' => '1.5'],
                ['name' => 'Megane 3', 'year_start' => 2008, 'year_end' => 2014, 'engine' => '1.5'],
            ],
            'Smart' => [
                ['name' => 'Fortwo', 'year_start' => 2007, 'year_end' => 2014, 'engine' => '1.0'],
                ['name' => 'Forfour', 'year_start' => 2004, 'year_end' => 2015, 'engine' => '1.1'],
            ],
            'Volkswagen' => [
                ['name' => 'Golf 4', 'year_start' => 1997, 'year_end' => 2003, 'engine' => '1.6'],
                ['name' => 'Golf 5', 'year_start' => 2003, 'year_end' => 2008, 'engine' => '1.6'],
                ['name' => 'Passat B5', 'year_start' => 1996, 'year_end' => 2005, 'engine' => '1.8'],
            ],
            'Toyota' => [
                ['name' => 'Corolla', 'year_start' => 2001, 'year_end' => 2007, 'engine' => '1.6'],
                ['name' => 'Camry', 'year_start' => 2006, 'year_end' => 2011, 'engine' => '2.4'],
                ['name' => 'RAV4', 'year_start' => 2005, 'year_end' => 2012, 'engine' => '2.0'],
            ],
            'BMW' => [
                ['name' => '3 Series E46', 'year_start' => 1998, 'year_end' => 2005, 'engine' => '2.0'],
                ['name' => '5 Series E39', 'year_start' => 1995, 'year_end' => 2003, 'engine' => '2.5'],
            ],
            'Ford' => [
                ['name' => 'Focus 2', 'year_start' => 2004, 'year_end' => 2011, 'engine' => '1.6'],
                ['name' => 'Fiesta', 'year_start' => 2008, 'year_end' => 2017, 'engine' => '1.4'],
                ['name' => 'Mondeo 4', 'year_start' => 2007, 'year_end' => 2014, 'engine' => '2.0'],
            ],
            'Skoda' => [
                ['name' => 'Octavia A5', 'year_start' => 2004, 'year_end' => 2013, 'engine' => '1.6'],
                ['name' => 'Fabia', 'year_start' => 2007, 'year_end' => 2014, 'engine' => '1.2'],
            ],
            'Audi' => [
                ['name' => 'A4 B6', 'year_start' => 2000, 'year_end' => 2004, 'engine' => '1.8'],
                ['name' => 'A6 C5', 'year_start' => 1997, 'year_end' => 2004, 'engine' => '2.4'],
            ],
            'Hyundai' => [
                ['name' => 'Elantra', 'year_start' => 2006, 'year_end' => 2010, 'engine' => '1.6'],
                ['name' => 'Tucson', 'year_start' => 2004, 'year_end' => 2010, 'engine' => '2.0'],
            ],
            'Opel' => [
                ['name' => 'Astra H', 'year_start' => 2004, 'year_end' => 2010, 'engine' => '1.6'],
                ['name' => 'Vectra C', 'year_start' => 2002, 'year_end' => 2008, 'engine' => '1.8'],
            ],
        ];

        foreach ($modelsByMark as $markName => $models) {
            $markId = Mark::firstOrCreate([
                'name' => $markName,
                'slug' => Str::slug($markName, '-')
            ])->id;

            foreach ($models as $model) {
                Model::firstOrCreate([
                    'name' => $model['name'],
                    'year_start' => $model['year_start'],
                    'year_end' => $model['year_end'],
                    'engine' => $model['engine'],
                    'engine_type' => 'fuel',
                    'transmission' => 'manual',
                    'transmission_type' => 'mechanic',
                    'slug' => Str::slug($markName . ' ' . $model['name'], '-'),
                    'mark_id' => $markId
                ]);
            }
        }
    }
}
