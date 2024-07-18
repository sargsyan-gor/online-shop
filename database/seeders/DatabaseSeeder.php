<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('posts')->insert([
                'user_id' => $faker->numberBetween(1,10),
                'title' => $faker->name,
                'content' => $faker->unique()->safeEmail,
                'price' => $faker->numberBetween(10,20),
            ]);
        }
    }
}
