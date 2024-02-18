<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCreationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // テスト用のロールを追加するシーダーを実行
        $this->artisan('db:seed', ['--class' => 'UsersTableSeeder']);
    }

    public function testCreateNewUser()
    {
        $requestPayload = [
            'userName' => 'テストユーザー',
            'userEmail' => 'test@example.com',
            'password' => 'password',
            'category' => 'テストカテゴリ',
            'faculty' => 'テスト学部',
            'department' => 'テスト学科',
            'admissionYear' => "2021",
        ];

        $response = $this->json('POST', '/api/register', $requestPayload);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'id' => true,
                'role' => true,
            ]);

        // データベースにユーザーが正しく作成されたことの検証
        $this->assertDatabaseHas('users', [
            'userEmail' => 'test@example.com',
        ]);
    }

    // 不正なメールアドレスの場合にエラーになることのテスト
    public function testCreateNewUserWithInvalidEmail()
    {
        $requestPayload = [
            'userName' => 'テストユーザー',
            'userEmail' => 'invalid-email',
            'password' => 'password',
            'category' => 'テストカテゴリ',
            'faculty' => 'テスト学部',
            'department' => 'テスト学科',
            'admissionYear' => "2021",
        ];

        $response = $this->json('POST', '/api/register', $requestPayload);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'メールアドレスの形式が正しくありません。',
                'errors' => [
                    'userEmail' => [
                        'メールアドレスの形式が正しくありません。'
                    ]
                ]
            ]);

        // データベースにユーザーが作成されていないことの検証
        $this->assertDatabaseMissing('users', [
            'userEmail' => 'invalid-email',
        ]);
    }

    // アドレスが重複した場合にエラーになることのテスト
    public function testCreateNewUserWithDuplicateEmail()
    {
        $requestPayload = [
            'userName' => 'テストユーザー',
            'userEmail' => 'test1@test.co.jp',
            'password' => 'password',
            'category' => 'テストカテゴリ',
            'faculty' => 'テスト学部',
            'department' => 'テスト学科',
            'admissionYear' => "2021",
        ];

        $response = $this->json('POST', '/api/register', $requestPayload);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'id' => true,
                'role' => true,
            ]);

        $response = $this->json('POST', '/api/register', $requestPayload);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'このメールアドレスは既に使用されています。',
                'errors' => [
                    'userEmail' => [
                        'このメールアドレスは既に使用されています。'
                    ]
                ]
            ]);
    }

    // requiredパラメータがない場合にエラーになることのテスト
    public function testCreateNewUserWithMissingRequiredParameters()
    {
        $requestPayload = [];

        $response = $this->json('POST', '/api/register', $requestPayload);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'ユーザー名は必須項目です。 (and 6 more errors)',
                'errors' => [
                    'userName' => [
                        'ユーザー名は必須項目です。'
                    ],
                    'userEmail' => [
                        'メールアドレスは必須項目です。'
                    ],
                    'password' => [
                        'パスワードは必須項目です。'
                    ],
                    'category' => [
                        'カテゴリは必須項目です。'
                    ],
                    'faculty' => [
                        '学部は必須項目です。'
                    ],
                    'department' => [
                        '学科は必須項目です。'
                    ],
                    'admissionYear' => [
                        '入学年度は必須項目です。'
                    ],
                ]
            ]);
        }

    // 型が異なる場合にエラーになることのテスト
    public function testCreateNewUserWithInvalidTypeParameters()
    {
        $requestPayload = [
            'userName' => 123,
            'userEmail' => 123,
            'password' => 123,
            'category' => 123,
            'faculty' => 123,
            'department' => 123,
            'admissionYear' => 123,
        ];

        // ユーザー作成リクエストを送信
        $response = $this->json('POST', '/api/register', $requestPayload);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'ユーザー名は文字列である必要があります。 (and 8 more errors)',
                'errors' => [
                    'userName' => [
                        'ユーザー名は文字列である必要があります。'
                    ],
                    'userEmail' => [
                        'メールアドレスは文字列である必要があります。'
                    ],
                    'password' => [
                        'パスワードは文字列である必要があります。'
                    ],
                    'category' => [
                        'カテゴリは文字列である必要があります。'
                    ],
                    'faculty' => [
                        '学部は文字列である必要があります。'
                    ],
                    'department' => [
                        '学科は文字列である必要があります。'
                    ],
                    'admissionYear' => [
                        '入学年度は文字列である必要があります。'
                    ],
                ]
            ]);
    }

    // 文字列情報の最大長を超えた場合にエラーになることのテスト
    public function testCreateNewUserWithTooLongStringParameters()
    {
        $requestPayload = [
            'userName' => str_repeat('a', 256),
            'userEmail' => str_repeat('a', 256) . '@example.com',
            'password' => str_repeat('a', 256),
            'category' => str_repeat('a', 256),
            'faculty' => str_repeat('a', 256),
            'department' => str_repeat('a', 256),
            'admissionYear' => str_repeat('a', 256),
        ];

        $response = $this->json('POST', '/api/register', $requestPayload);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'ユーザー名は255文字以内で入力してください。 (and 6 more errors)',
                'errors' => [
                    'userName' => [
                        'ユーザー名は255文字以内で入力してください。'
                    ],
                    'userEmail' => [
                        'メールアドレスは255文字以内で入力してください。'
                    ],
                    'password' => [
                        'パスワードは255文字以内で入力してください。'
                    ],
                    'category' => [
                        'カテゴリは255文字以内で入力してください。'
                    ],
                    'faculty' => [
                        '学部は255文字以内で入力してください。'
                    ],
                    'department' => [
                        '学科は255文字以内で入力してください。'
                    ],
                    'admissionYear' => [
                        "入学年度は255文字以内で入力してください。"
                    ],
                ]
            ]);
    }
}
