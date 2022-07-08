<?php

namespace Database\Factories;

use App\Enum\Auth\DeviceType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randPhoneNumber = rand(1, 99999999);
        $phoneNumber = '010' . sprintf('%08d', $randPhoneNumber);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $phoneNumber,
            'app_type' => ([DeviceType::ANDROID, DeviceType::IOS][rand(0 ,1)])->value,
            'password' => 'password1234', // password1234
            'remember_token' => Str::random(10),
        ];
    }

}
