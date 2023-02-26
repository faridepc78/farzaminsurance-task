<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Repositories\Property\PropertyRepositoryInterface;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $propertyRepository = resolve(PropertyRepositoryInterface::class);

        if (!$propertyRepository->getCount()) {
            Property::factory(10)->create();
        } else {
            $this->command->warn('Properties has already been created');
        }
    }
}
