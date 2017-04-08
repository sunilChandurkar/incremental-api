<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Lesson;
use App\Tag;

class LessonTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        //$lessonIds = Lesson::lists('id'); //returns [1,2,3....]

        $lessonIds =  DB::table('lessons')->pluck('id')->toArray();

        //$tagIds = Tag::lists('id');

        $tagIds =  DB::table('tags')->pluck('id')->toArray();

        foreach (range(1,30) as $index) {
        	DB::table('lesson_tag')->insert([
        		'lesson_id' => $faker->randomElement($lessonIds),
        		'tag_id' => $faker->randomElement($tagIds)
        		]);
        }
    }
}
