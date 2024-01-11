<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Reviews extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $primaryKey = 'review_id';
    public $timestamps = true;

    protected $fillable = [
        'lecture_id',
        'user_id',
        'attendance_year',
        'attendance_confirm',
        'weekly_assignments',
        'midterm_assignments',
        'final_assignments',
        'past_exam_possession',
        'grades',
        'credit_level',
        'interest_level',
        'skill_level',
        'comments',
        'is_visible',
    ];

    /**
     * このレビューを投稿したユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * このレビューに関連する講義を取得
     */
    public function lecture()
    {
        return $this->belongsTo(Lectures::class, 'lecture_id');
    }
}
