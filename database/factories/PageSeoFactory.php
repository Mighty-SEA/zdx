<?php

namespace Database\Factories;

use App\Models\PageSeo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageSeo>
 */
class PageSeoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'route' => fake()->slug(),
            'page_id' => fake()->randomNumber(3),
            'title' => fake()->sentence(5),
            'meta_description' => fake()->paragraph(1),
            'meta_keywords' => implode(', ', fake()->words(5)),
            'og_title' => fake()->sentence(3),
            'og_description' => fake()->paragraph(1),
            'og_image' => fake()->imageUrl(1200, 630),
            'canonical_url' => fake()->url(),
            'is_indexed' => fake()->boolean(),
            'is_followed' => fake()->boolean(),
            'custom_robots' => fake()->randomElement(['noindex, nofollow', 'index, nofollow', 'noindex, follow', null]),
            'custom_schema' => fake()->optional()->randomElement([
                '{"@context":"https://schema.org","@type":"Article","headline":"Sample Article","description":"This is a sample schema"}',
                '{"@context":"https://schema.org","@type":"Product","name":"Sample Product","description":"This is a sample product"}',
                null
            ]),
        ];
    }
} 