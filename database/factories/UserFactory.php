<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'userName' => fake()->name(),
            'userEmail' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password'), // ここではbcryptを使用してパスワードをハッシュ化
            'universityName' => "広島大学", // デフォルトの大学名
            'category' => fake()->word(), // 任意のカテゴリー名
            'faculty' => fake()->word(), // 任意の学部名
            'department' => fake()->word(), // 任意の学科名
            'admissionYear' => fake()->year(), // 入学年
            'isActive' => true, // デフォルトでアクティブ
            'createdAt' => now(), // ユーザー作成日時
            'updatedAt' => now(), // 最終更新日時
            'lastLoginAt' => now(), // 最終ログイン日時
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
