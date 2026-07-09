<?php

namespace Modules\Good\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Category\Database\Seeders\CategoryDatabaseSeeder;
use Modules\Category\Entities\Category;
use Modules\Good\Entities\Country;
use Modules\Good\Entities\Good;
use Modules\Mark\Database\Seeders\MarkDatabaseSeeder;
use Modules\Model\Database\Seeders\ModelDatabaseSeeder;
use Modules\Model\Entities\Model as ModelEntity;

class GoodDatabaseSeeder extends Seeder
{
    /**
     * Auto parts names grouped by category slug.
     *
     * @var array<string, string[]>
     */
    private array $itemsByCategory = [
        'spare-parts' => [
            'Oil Filter', 'Air Filter', 'Cabin Filter', 'Fuel Filter', 'Wiper Blade Set', 'Drive Belt',
        ],
        'braking-system' => [
            'Brake Pads Set', 'Brake Disc', 'Brake Caliper', 'Brake Hose', 'Master Brake Cylinder', 'ABS Sensor',
        ],
        'engine-and-exhaust-system' => [
            'Cylinder Head Gasket', 'Timing Belt Kit', 'Spark Plug', 'Muffler', 'Catalytic Converter', 'Engine Mount',
        ],
        'suspension-and-steering' => [
            'Shock Absorber', 'Suspension Spring', 'Control Arm', 'Tie Rod End', 'Ball Joint', 'Stabilizer Link',
        ],
        'transmission' => [
            'Clutch Kit', 'Transmission Oil', 'Release Bearing', 'CV Joint', 'Drive Shaft', 'Gearbox Mount',
        ],
        'cooling-and-heating' => [
            'Radiator', 'Water Pump', 'Thermostat', 'Cooling Fan', 'Heater Core', 'Radiator Hose',
        ],
        'body-and-components' => [
            'Front Bumper', 'Hood', 'Side Mirror', 'Door Handle', 'Front Fender', 'Windshield',
        ],
        'electricity-and-lighting' => [
            'Headlight', 'Tail Light', 'Alternator', 'Starter Motor', 'Battery', 'Ignition Coil',
        ],
        'auto-goods-and-auto-chemicals' => [
            'Engine Oil', 'Antifreeze', 'Body Polish', 'Interior Cleaner', 'Silicone Grease', 'Glass Cleaner',
        ],
    ];

    /**
     * @var string[]
     */
    private array $currencies = ['USD', 'UAH', 'EUR'];

    /**
     * @var int[]
     */
    private array $discountOptions = [0, 0, 0, 5, 10, 15];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CountriesTableSeeder::class);
        $this->call(CategoryDatabaseSeeder::class);
        $this->call(MarkDatabaseSeeder::class);
        $this->call(ModelDatabaseSeeder::class);

        $categories = Category::all();
        $models = ModelEntity::with('mark')->get();
        $countries = Country::all();

        for ($i = 1; $i <= 50; $i++) {
            $category = $categories->random();
            $model = $models->random();
            $items = $this->itemsByCategory[$category->slug] ?? $this->itemsByCategory['spare-parts'];
            $itemName = $items[array_rand($items)];

            $name = "{$itemName} {$model->mark->name} {$model->name}";
            $cost = random_int(50, 5000);
            $slug = Str::slug($name . '-' . $i, '-');

            Good::create([
                'id_inner' => 'GD-' . str_pad((string) $i, 5, '0', STR_PAD_LEFT),
                'name' => $name,
                'desc' => "{$itemName} for {$model->mark->name} {$model->name} ({$model->year_start}-{$model->year_end})",
                'brand' => $model->mark->name,
                'country' => $countries->random()->name,
                'cost' => $cost,
                'profit' => round($cost * (random_int(10, 40) / 100), 2),
                'discount' => $this->randomDiscount(),
                'currency' => $this->currencies[array_rand($this->currencies)],
                'quantity' => random_int(0, 200),
                'item' => strtoupper(Str::random(8)),
                'mark_id' => $model->mark_id,
                'model_id' => $model->id,
                'category_id' => $category->id,
                'active' => true,
                'slug' => $slug,
            ]);
        }
    }

    /**
     * @return int
     */
    private function randomDiscount(): int
    {
        return $this->discountOptions[array_rand($this->discountOptions)];
    }
}
