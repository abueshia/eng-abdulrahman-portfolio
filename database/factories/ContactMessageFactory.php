<?php

/**
 * ContactMessageFactory
 *
 * Generates ContactMessage / ProjectInquiry records for automated tests.
 */

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;
use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactMessage>
 */
class ContactMessageFactory extends Factory
{
    protected $model = ContactMessage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->numerify('010########'),
            'subject' => 'Enterprise SaaS Platform Development',
            'service' => 'Full-Stack Laravel & React Development',
            'budget_range' => '$3,000 - $5,000',
            'timeline' => '2 Months',
            'message' => fake()->paragraph(),
            'type' => ContactMessageTypeEnum::ProjectInquiry,
            'status' => ContactMessageStatusEnum::New,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'PHPUnit Test Suite',
            'sort_order' => 1,
        ];
    }
}
