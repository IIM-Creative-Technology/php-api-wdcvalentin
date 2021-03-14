<?php

namespace Database\Factories;

use App\Models\Mark;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class MarkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mark::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $class_id = DB::table('school_classes')->inRandomOrder()->limit(1)->value('id');
        $teacher_id = DB::table('teachers')->inRandomOrder()->limit(1)->value('id');
        $student_id = DB::table('students')->inRandomOrder()->limit(1)->value('id');
        return [
            'mark' => $this->faker->numberBetween(0, 20),
            'student_id' => $student_id,
            'schoolclass_id' => $class_id,
            'subject_id' => $teacher_id,
        ];
    }
}
