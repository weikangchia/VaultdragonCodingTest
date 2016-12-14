<?php

use Illuminate\Database\Seeder;

use App\Object;

class ObjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('objects')->delete();

        for ($i = 1; $i <= 5; $i++)
        {
            $objects = Object::create(array(
                'key' => 'key'.$i
            ));
        }
    }
}
