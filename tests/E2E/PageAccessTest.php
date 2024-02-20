<?php

namespace Tests\E2E;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // テスト用のロールを追加するシーダーを実行
        $this->artisan('db:seed', ['--class' => 'UsersTableSeeder']);
    }

    /** @test 認証なしページにアクセスできることのテスト */
    public function test_pages_are_accessible_without_authentication()
    {
        $publicEndpoints = [
            '/',
            '/register',
            '/login',
            '/class',
            '/terms',
            '/contact',
        ];

        foreach ($publicEndpoints as $endpoint) {
            $response = $this->get($endpoint);
            $response->assertStatus(200);
        }
    }
}
