<?php

namespace Database\Seeders;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory(10)->create();
        Student::create([
            'studentID' => 'ST001',
            'name' => 'John',
            'status' => 'active',
            'age' => 23,
            'image'=> ''
        ]);
    }
}
