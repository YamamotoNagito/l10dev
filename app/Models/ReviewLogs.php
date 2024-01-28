<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ReviewLogs extends Model
{
    use HasFactory;

    protected $table = 'reviewLogs';
    protected $primaryKey = 'reviewLogId';
    public $timestamps = false;

    protected $fillable = [
        'lectureId',
        'userId',
        'attendanceYear',
        'attendanceConfirm',
        'weeklyAssignments',
        'midtermAssignments',
        'finalAssignments',
        'pastExamPossession',
        'grades',
        'creditLevel',
        'interestLevel',
        'skillLevel',
        'comments',
        'status',
        'createdAt',
    ];

    /**
     * このレビューを投稿したユーザーを取得
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    /**
     * このレビューに関連する講義を取得
     */
    public function lecture()
    {
        return $this->belongsTo(Lectures::class, 'lectureId');
    }
}
