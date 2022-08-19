<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commentary>
 */
class CommentaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomNumber = $this->faker->numberBetween(500, 1000);
        $randomChars =  $this->faker->countryCode;
        $slug = strtolower($randomChars) . $randomNumber;
        $label = 'Art. ' . $randomNumber . ' ' . $randomChars;
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;

        return [
            'slug' => $slug,
            'label_de' => $label,
            'content_de' => '<p>' . $this->faker->paragraph . '</p>',
            'suggested_citation_long' => $firstName . ' ' . $lastName . ', Kommentar zu ' . $label,
            'suggested_citation_short' => 'OK-' . $lastName . ', N. XXX zu ' . $label . '.',
            'doi' => 'xx.xxxx/onlinekommentar.' . $slug,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
