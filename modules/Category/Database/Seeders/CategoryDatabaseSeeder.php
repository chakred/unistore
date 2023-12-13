<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Category\Entities\Category;
class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $categories = [
            [
                'name' => 'Spare parts',
                'desc' => 'Spare parts for maintenance',
                'slug' => Str::slug('Spare parts', '-')
            ],
            [
                'name' => 'Braking system',
                'desc' => 'Braking system',
                'slug' => Str::slug('Braking system', '-')
            ],
            [
                'name' => 'Engine and Exhaust System',
                'desc' => 'Engine and Exhaust System',
                'slug' => Str::slug('Engine and Exhaust System', '-')
            ],
            [
                'name' => 'Suspension and Steering',
                'desc' => 'Suspension and Steering',
                'slug' => Str::slug('Suspension and Steering', '-')
            ],
            [
                'name' => 'Transmission',
                'desc' => 'Transmission',
                'slug' => Str::slug('Transmission', '-')
            ],
            [
                'name' => 'Cooling and Heating',
                'desc' => 'Cooling and Heating',
                'slug' => Str::slug('Cooling and Heating', '-')
            ],
            [
                'name' => 'Body and Components',
                'desc' => 'Body and Components',
                'slug' => Str::slug('Body and Components', '-')
            ],
            [
                'name' => 'Electricity and Lighting',
                'desc' => 'Electricity and Lighting',
                'slug' => Str::slug('Electricity and Lighting', '-')
            ],
            [
                'name' => 'Auto goods and Auto chemicals',
                'desc' => 'Auto goods and Auto chemicals',
                'slug' => Str::slug('Auto goods and Auto chemicals', '-')
            ]
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate($category);
        }
    }
}
