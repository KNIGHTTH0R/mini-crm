<?php

use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 10; $i++) {

            $path = $faker->image('/tmp', 100, 100);
            $name = explode('tmp/',$path)[1];
            $ext = explode('.',$name)[1];
            $image = new UploadedFile(
                $path,
                $name,
                'image/'.$ext
            );

            \App\Company::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'logo' => $image,
                'website' => $faker->url
            ]);
        }
    }
}
