<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use Faker\Factory as Faker;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {
            Job::create([
                'title' => $faker->jobTitle,
                'description' => $faker->paragraph(5),
                'company' => $faker->company,
                'location' => $faker->city,
                'job_type' => $faker->randomElement(['Full-time', 'Part-time', 'Remote', 'Contract']),
                'experience' => $faker->randomElement(['Entry Level', 'Mid Level', 'Senior Level']),
                'salary' => $faker->randomElement(['Ksh 50,000 - 70,000', 'Ksh 80,000 - 120,000', 'Negotiable']),
                'what_you_will_do' => $faker->paragraph(4),
                'requirements' => $faker->paragraph(3),
                'nice_to_have' => $faker->sentence(10),
                'category' => $faker->randomElement(['IT', 'Finance', 'Marketing', 'Design', 'Engineering']),
                'expires_at' => $faker->dateTimeBetween('+10 days', '+60 days'),
            ]);
        }
    }
}
