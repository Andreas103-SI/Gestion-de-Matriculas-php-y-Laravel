<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id' => $this->faker->randomElement(Student::pluck('id')->toArray()),
            'course_id' => $this->faker->randomElement(Course::pluck('id')->toArray()),
            'enrollment_document' => $this->faker->uuid(),
            'enrollment_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }
}
