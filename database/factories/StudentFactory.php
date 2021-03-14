<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $class_id = DB::table('school_classes')->inRandomOrder()->limit(1)->value('id');
        $className = DB::table('school_classes')
                        ->where('school_classes.id', $class_id)
                        ->select('school_classes.name')
                        ->get();

        return [
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'age' => $this->faker->buildingNumber,
            'class' => $className[0]->name,
            'schoolclass_id' => $class_id,
        ];
    }
}
