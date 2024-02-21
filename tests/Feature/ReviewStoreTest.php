<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Lectures;

class ReviewStoreTest extends TestCase
{

    use RefreshDatabase;

    protected $user;
    protected $lecture;

    protected function setUp(): void
    {
        parent::setUp();
        // テスト用のロールを追加するシーダーを実行
        $this->artisan('db:seed', ['--class' => 'UsersTableSeeder']);
        // ユーザーと授業を作成
        $this->user = User::factory()->create();
        $this->lecture = Lectures::factory()->create();

    }

    /**
     * A basic feature test example.
     */
    public function test_post_review_success()
    {
        $requestPayload = [
            'userId' => $this->user->userId,
            'lectureName' => $this->lecture->lectureName,
            'teacherName' => $this->lecture->teacherName,
            'attendanceYear' => 2021,
            'attendanceConfirm' => '出席確認',
            'weeklyAssignments' => '週課題',
            'midtermAssignments' => '中間課題',
            'finalAssignments' => '期末課題',
            'pastExamPossession' => '過去問所持',
            'grades' => '成績',
            'creditLevel' => 3,
            'interestLevel' => 3,
            'skillLevel' => 3,
            'comments' => 'コメント',
        ];

        $response = $this->json('POST', '/api/reviews', $requestPayload);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        // データベースにレビューが正しく作成されたことの検証
        $this->assertDatabaseHas('reviews', [
            'userId' => $this->user->userId,
            'attendanceYear' => 2021,
            'attendanceConfirm' => '出席確認',
            'weeklyAssignments' => '週課題',
            'midtermAssignments' => '中間課題',
            'finalAssignments' => '期末課題',
            'pastExamPossession' => '過去問所持',
            'grades' => '成績',
            'creditLevel' => 3,
            'interestLevel' => 3,
            'skillLevel' => 3,
            'comments' => 'コメント',
        ]);
    }

    // 存在しない授業名の場合にエラーになることのテスト
    public function test_post_review_with_invalid_lecture_name()
    {
        $requestPayload = [
            'userId' => $this->user->userId,
            'lectureName' => '存在しない授業名',
            'teacherName' => $this->lecture->teacherName,
            'attendanceYear' => 2021,
            'attendanceConfirm' => '出席確認',
            'weeklyAssignments' => '週課題',
            'midtermAssignments' => '中間課題',
            'finalAssignments' => '期末課題',
            'pastExamPossession' => '過去問所持',
            'grades' => '成績',
            'creditLevel' => 3,
            'interestLevel' => 3,
            'skillLevel' => 3,
            'comments' => 'コメント',
        ];

        $response = $this->json('POST', '/api/reviews', $requestPayload);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => false,
                'message' => '授業が存在しません',
            ]);

        // データベースにレビューが作成されていないことの検証
        $this->assertDatabaseMissing('reviews', [
            'userId' => $this->user->userId,
            'attendanceYear' => 2021,
            'attendanceConfirm' => '出席確認',
            'weeklyAssignments' => '週課題',
            'midtermAssignments' => '中間課題',
            'finalAssignments' => '期末課題',
            'pastExamPossession' => '過去問所持',
            'grades' => '成績',
            'creditLevel' => 3,
            'interestLevel' => 3,
            'skillLevel' => 3,
            'comments' => 'コメント',
        ]);
    }
}
