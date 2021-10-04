<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 200; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->jobTitle,
                'body' => $faker->text,
                'created_at' => $faker->dateTime
            ]);
        }
    }
}
