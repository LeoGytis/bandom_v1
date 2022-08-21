<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // ========================== Restaurant ==========================

        $names = ['Berneliu uzeiga', 'Juodas Vilkas', 'Balta Avele', 'Cepelinai Tau', 'Katmandu', 'Cili pica', 'Pienine', 'Bistro', 'Kultura'];

        foreach (range(1, 10) as $_) {
                DB::table('restaurants')->insert([
                'name' => $names[rand(0, count($names) - 1)],
                'city' => $faker->city,
                'address' => $faker->address,
                'work_time' => '11 - 22',
            ]);
        }

        // // ========================== Hotel ==========================
        // foreach (range(1, 10) as $_) {
        //     $hotels = ['Radisson Blue', 'Clarion', 'Grand Budapest', 'Old Town Hotel', 'Central Hotel', 'Scandic Hotel', 'Park Hotel', 'Grand Tower Hotel', 'Parken Inn'];

        //     $photopath = 'http://localhost/bandom/public/images/hotels/';

        //     DB::table('hotels')->insert([
        //         'name' => $hotels[rand(0, count($hotels) - 1)],
        //         'price' => rand(100, 500),
        //         'photo' => $photopath . rand(1,9) . '.jpg',
        //         'trip_time' => rand(7, 14),
        //         'country_id' => rand(1, 10),
        //     ]);
        // }

        // ========================== USERS ==========================
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123'),
            'role' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'role' => 10,
        ]);

        DB::table('users')->insert([
            'name' => 'Gytis',
            'email' => 'leogytis@gmail.com',
            'password' => Hash::make('123'),
            'role' => 10,
        ]);
    }
}
