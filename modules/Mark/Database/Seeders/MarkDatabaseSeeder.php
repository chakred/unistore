<?php

namespace Modules\Mark\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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

        Mark::firstOrcreate([
            'name' => 'test',
            'slug' => 'test'
        ]);

        // $this->call("OthersTableSeeder");
    }
}
