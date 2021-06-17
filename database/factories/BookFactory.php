<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
            'isbn' => $this->faker->ean13(),
            'authors' => $this->faker->name($array = array($gender = 'male'|'female')),
            'country' => $this->faker->country(),
            'number_of_pages' => $this->faker->numberBetween($min = 300, $max = 700),
            'publisher' => $this->faker->words($nb = 2),
            'released_date' => $this->faker->date(json_encode($format = 'Y-m-d'))
        ];
    }
}
