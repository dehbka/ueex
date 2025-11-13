<?php

namespace Feature\Api;

use App\Http\Api\Enums\ResourceStatus;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase;

    private const PAYLOAD = [
        'name' => 'Test Company',
        'edrpou' => '123456789',
        'address' => 'Test Address',
    ];

    public function test_company_create(): void
    {
        $response = $this->postJson('/api/company', self::PAYLOAD);

        $expectedCompany = Company::where('edrpou', '123456789')
            ->first();

        $response->assertStatus(201);
        $response->assertJson([
            'company_id' => $expectedCompany->id,
            'status' => ResourceStatus::created->value,
            'version' => 1,
        ]);
    }

    public function test_company_update(): void
    {
        $payload = self::PAYLOAD;

        $this->postJson('/api/company', $payload);

        $payload['name'] = 'Test Company 2';
        $response = $this->postJson('/api/company', $payload);

        $expectedCompany = Company::where('edrpou', '123456789')
            ->first();

        $response->assertStatus(200);
        $response->assertJson([
            'company_id' => $expectedCompany->id,
            'status' => ResourceStatus::updated->value,
            'version' => 2,
        ]);
    }

    public function test_company_duplicate(): void
    {
        $this->postJson('/api/company', self::PAYLOAD);
        $response = $this->postJson('/api/company', self::PAYLOAD);

        $expectedCompany = Company::where('edrpou', '123456789')
            ->first();

        $response->assertStatus(200);
        $response->assertJson([
            'company_id' => $expectedCompany->id,
            'status' => ResourceStatus::duplicate->value,
            'version' => 1,
        ]);
    }

    #[DataProvider('failedValidationDataProvider')]
    public function test_failed_validation(array $payload): void
    {
        $response = $this->postJson('/api/company', $payload);

        $response->assertStatus(422);
    }

    public static function failedValidationDataProvider(): array
    {
        return [
            'missing name' => [
                [
                    'edrpou' => '123456789',
                    'address' => 'Test Address',
                ]
            ],
            'missing edrpou' => [
                [
                    'name' => 'name',
                    'address' => 'Test Address',
                ]
            ],
            'missing address' => [
                [
                    'name' => 'name',
                    'edrpou' => '123456789',
                ]
            ],
            'not string name' => [
                [
                    'name' => 1,
                    'edrpou' => '12321321',
                    'address' => 'Test Address',
                ]
            ],
            'not string edrpou' => [
                [
                    'name' => 'name',
                    'edrpou' => 1,
                    'address' => 'Test Address',
                ]
            ],
            'not string address' => [
                [
                    'name' => 'name',
                    'edrpou' => '12321321',
                    'address' => 1,
                ]
            ],
            'too long name' => [
                [
                    'name' => str_repeat('t', 257),
                    'edrpou' => '12321321',
                    'address' => 'Test Address',
                ]
            ],
            'too long edrpou' => [
                [
                    'name' => 'name',
                    'edrpou' => str_repeat('t', 11),
                    'address' => 'Test Address',
                ]
            ],
        ];
    }
}
