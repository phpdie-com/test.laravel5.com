<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExampleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('example')->truncate();
        $faker = \Faker\Factory::create();
        $insert = [];
        for ($i = 0; $i < 50; $i++) {
            $insert[] = [
                'title' => $faker->name,
                'content' => $faker->text(200),
                'tag' => $faker->numberBetween(1, 2).','.$faker->numberBetween(3, 4),
                'hit' => $faker->numberBetween(0, 100),
                'status' => $faker->numberBetween(0, 1),
                'address' => 'http://www.' . $faker->domainName,
                'created_at' => $faker->dateTimeBetween(
                    '2019-01-01',
                    'now',
                    'PRC'
                ),
                'updated_at' => $faker->dateTimeBetween(
                    '2021-02-01',
                    'now',
                    'PRC'
                ),
            ];
        }
        if ($insert) {
            DB::table('example')->insert($insert);
        }
    }
}
