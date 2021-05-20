<?php

namespace Database\Factories;

use App\Models\Comprador;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompradorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comprador::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'nombreComprador' => $this->faker->name(),
            'nitComprador' => $this->faker->text(),
        ];
    }
}
