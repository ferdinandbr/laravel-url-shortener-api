<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Url;
use Illuminate\Support\Str;

class UrlFactory extends Factory
{
    protected $model = Url::class;

    public function definition()
    {
      return [
        'id' => $this->faker->unique()->randomDigitNotNull(),
        'url' => $this->faker->url(),
        'identifier' => $identifier = $this->faker->unique()->uuid(),
        'short_url' => url('/').'/api/redirect/?identifier='.$identifier,
        'expiration' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+03 days', $timezone = null),
        'created_at' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = 'now', $timezone = null),
        'updated_at' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = 'now', $timezone = null),
      ];
    }
}
