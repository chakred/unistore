<?php

namespace Modules\Mark\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Mark\Entities\Mark;

class MarkDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $marks = [
            [
                'name' => 'Renault',
                'slug' => Str::slug('Renault', '-')
            ],
            [
                'name' => 'Smart',
                'slug' => Str::slug('Smart', '-')
            ],
        ];

        foreach ($marks as $mark) {
            Mark::firstOrcreate($mark);
        }
    }
}
