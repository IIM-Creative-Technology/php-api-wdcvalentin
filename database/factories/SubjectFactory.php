<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class SubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $class_id = DB::table('school_classes')->inRandomOrder()->limit(1)->value('id');
        $teacher_id = DB::table('teachers')->inRandomOrder()->limit(1)->value('id');

        return [
            'name' => $this->faker->firstName(),
            'week_date' => $this->faker->dateTime(),
            'schoolclass_id' => $class_id,
            'teacher_id' => $teacher_id,
        ];
    }
}
