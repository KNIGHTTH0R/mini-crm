<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $range = 1000;

        for($i = 0; $i < $range; $i++) {
            \App\Employee::create([
                'first_name' => $faker->name,
                'last_name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'company_id' => $faker->randomElement($array = range(1, $range)),
            ]);
        }
    }
}
