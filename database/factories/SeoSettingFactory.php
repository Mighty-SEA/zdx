<?php

namespace Database\Factories;

use App\Models\SeoSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeoSetting>
 */
class SeoSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'site_title' => fake()->sentence(3),
            'meta_description' => fake()->paragraph(1),
            'meta_keywords' => implode(', ', fake()->words(5)),
            'og_title' => fake()->sentence(3),
            'og_description' => fake()->paragraph(1),
            'og_image' => fake()->imageUrl(1200, 630),
            'twitter_card' => 'summary_large_image',
            'google_analytics' => 'UA-' . fake()->randomNumber(8),
            'google_tag_manager' => 'GTM-' . fake()->randomNumber(6),
        ];
    }
} 