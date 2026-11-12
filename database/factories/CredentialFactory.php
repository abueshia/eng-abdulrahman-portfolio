<?php

/**
 * CredentialFactory
 *
 * Generates academic degree and professional certification records for automated tests.
 */

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\CredentialTypeEnum;
use App\Models\Credential;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Credential>
 */
class CredentialFactory extends Factory
{
    protected $model = Credential::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => [
                'en' => 'B.Sc. in Computer & Systems Engineering',
                'ar' => 'بكالوريوس هندسة الحاسبات والنظم',
            ],
            'organization' => [
                'en' => 'Faculty of Engineering',
                'ar' => 'كلية الهندسة',
            ],
            'type' => CredentialTypeEnum::AcademicDegree,
            'issued_at' => now()->subYears(4)->toDateString(),
            'expires_at' => null,
            'credential_id' => 'CERT-'.fake()->numerify('#####'),
            'credential_url' => 'https://example.com/verify',
            'description' => [
                'en' => 'Specialized in Software Engineering, Distributed Systems, and Database Architecture.',
                'ar' => 'تخصص هندسة البرمجيات والنظم الموزعة وهيكلة قواعد البيانات.',
            ],
            'is_active' => true,
            'sort_order' => 1,
        ];
    }
}
