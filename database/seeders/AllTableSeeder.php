<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\BookLocation;
use App\Models\BookSection;

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class AllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //USER
        $fakerUsers = Faker::create();

        DB::table('users')->insert([
            'name' => 'Admin I',
            'id_number' => 123456,
            'grade_and_section' => null,
            'office_or_department' => $fakerUsers->randomElement([$fakerUsers->jobTitle, null]),
            'password' => Hash::make('password'),
            'role' => 1,
            'id_pic' => $fakerUsers->randomElement([$fakerUsers->imageUrl(), null]),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $fakerUsers = Faker::create();

        DB::table('users')->insert([
            'name' => 'Admin II',
            'id_number' => 67890,
            'grade_and_section' => null,
            'office_or_department' => $fakerUsers->randomElement([$fakerUsers->jobTitle, null]),
            'password' => Hash::make('password'),
            'role' => 1,
            'id_pic' => $fakerUsers->randomElement([$fakerUsers->imageUrl(), null]),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // for ($i = 0; $i < 50; $i++) {
        //     DB::table('users')->insert([
        //         'name' => $fakerUsers->name,
        //         'id_number' => $fakerUsers->unique()->numberBetween(100000, 999999),
        //         'grade_and_section' => $fakerUsers->randomElement(['Grade-7', 'Grade-8', 'Grade-9', 'Grade-10', 'Grade-11', 'Grade-12']),
        //         'office_or_department' => $fakerUsers->randomElement([$fakerUsers->jobTitle, null]),
        //         'password' => Hash::make('password'),
        //         'role' => $fakerUsers->randomElement([0, 1, -1]),
        //         'id_pic' => $fakerUsers->randomElement([$fakerUsers->imageUrl(), null]),
        //         'remember_token' => Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

        // //AUTHOR
        // $fakerAuthor = Faker::create();
        // for ($i = 1; $i <= 50; $i++) {
        //     Author::create([
        //         'author' => $fakerAuthor->name,
        //         'author_id' => $fakerAuthor->unique()->numberBetween(1, 50)
        //     ]);
        // }

        //BOOK SECTION
        $arrays = ['Circulation Section','General Reference Section','Fiction Section','Filipiniana Section','LRMDS Section','Periodical Section','Reserve Section', 'Research Papers Section'];

        foreach ($arrays as $array) {
            BookSection::create([
                'section_name' => $array,
            ]);
        }

        //BOOK LOCATION
        // $locationArrays = ['Rack 1', 'Rack 2', 'Rack 3', 'Rack 4'];

        // foreach ($locationArrays as $array) {
        //     BookLocation::create([
        //         'name' => $array,
        //     ]);
        // }

        //BOOK
        // $faker = Faker::create();
        // foreach (range(1, 30) as $index) {
        //     Book::create([
        //         'book_title' => $faker->sentence,
        //         'author_id' => $faker->unique()->numberBetween(1, 50),
        //         'section_id' => $faker->numberBetween(1, 6),
        //         'class_no' => $faker->numerify('###'),
        //         'accession' => $faker->numerify('###'),
        //         'edition' => $faker->numerify('#th Edition'),
        //         'publication_year' => $faker->year(),
        //         'date_acquired' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //         'no_of_copies' => 4,
        //         'on_hand_per_count' => $faker->randomDigitNotNull,
        //         'book_status' => $faker->randomElement(['available', 'not-available']),
        //         'book_condition' =>$faker->randomElement(['functional', 'not-functional']),
        //         'isbn' => $faker->isbn13,
        //         'publisher' => $faker->company,
        //         'number_of_pages' => $faker->randomDigitNotNull,
        //         'location_id' => $faker->randomElement(['1', '2', '3']),
        //         'summary' => $faker->paragraph,
        //         'added_by' => $faker->name,
        //         'is_available' => 1,
        //         'available_copies' => 4

        //     ]);
        // }
    }
}

