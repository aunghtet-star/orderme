<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PizzaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'name' => 'admin',
            'email' => 'bee@gamil.com',
            'phone' => '09767612050',
            'address' => 'Taungtha',
            'role' => 'user',
            'password' =>Hash::make('kzma541999')
        ];
    }
}
