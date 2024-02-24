<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // ユーザーを作成
        $this->user = User::factory()->create();

        // ここでactingAsを使用してユーザーを認証済みにする
        $this->actingAs($this->user);
    }

    /** @test */
    public function a_contact_can_be_created()
    {
        // テストデータの準備
        $contactData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'category' => 'General Inquiry',
            'message' => 'This is a test message.'
        ];

        // 問い合わせ作成のルートをPOSTリクエストで呼び出し
        $response = $this->post('/api/contact', $contactData);

        // リダイレクトを検証
        $response->assertRedirect('/somewhere');

        // データベースにデータが保存されたか検証
        $this->assertDatabaseHas('contacts', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'category' => 'General Inquiry',
            'message' => 'This is a test message.'
        ]);
    }

    // 渡した値の長さが長すぎる場合にエラーになることのテスト。エラーメッセージも検証
    public function test_contact_form_max_length_validation()
    {
        $contactData = [
            'name' => str_repeat('a', 33),
            'email' => str_repeat('a', 256) . '@example.com',
            'category' => str_repeat('a', 33),
            'message' => str_repeat('a', 2001)
        ];

        $response = $this->post('/api/contact', $contactData);

        $response->assertSessionHasErrors([
            'name' => '名前は最大32文字までです。',
            'email' => 'メールアドレスは255文字以内で入力してください。',
            'category' => 'カテゴリーは最大32文字までです。',
            'message' => 'メッセージは最大2000文字までです。',
        ]);
    }

    // バリデーションエラーメッセージが正しいことのテスト
    public function test_contact_form_error_messages()
    {
        $contactData = [
            'name' => '',
            'email' => '',
            'category' => '',
            'message' => ''
        ];

        $response = $this->post('/api/contact', $contactData);

        $response->assertSessionHasErrors([
            'name' => '名前は必須項目です。',
            'email' => 'メールアドレスは必須項目です。',
            'category' => 'カテゴリーは必須項目です。',
            'message' => 'メッセージは必須項目です。',
        ]);
    }
}
