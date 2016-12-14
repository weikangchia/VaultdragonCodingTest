<?php

use Illuminate\Database\Seeder;

use App\Object;
use App\ObjectValue;

class ObjectsValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('objects_values')->delete();

        $faker = Faker\Factory::create();

        foreach (range(1,10) as $index) {
            $objects = Object::orderByRaw("RANDOM()")->first();
            ObjectValue::create([
                'object_id'  => $objects->id,
                'value'      => $faker->word,
                'created_at' => $faker->dateTime($max = 'now')
            ]);
        }
    }
}
