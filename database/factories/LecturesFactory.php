<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lectures;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecture>
 */
class LecturesFactory extends Factory
{
    protected $model = Lectures::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lectureName' => $this->faker->word,
            'teacherName' => $this->faker->name,
        ];
    }
}
