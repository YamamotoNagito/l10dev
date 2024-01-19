<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class LectureDetails extends Model
{
    use HasFactory;

    protected $table = 'lectureDetails'; // テーブル名を指定

    protected $primaryKey = 'lectureDetailId'; // プライマリキーのカラム名を指定

    public $timestamps = false;

    protected $fillable = [
        'lectureId',
        'lectureCode',
        'syllabusUrl',
        'location',
        'faculty',
        'category',
        'grade',
        // 他のカラムを追加
    ];

    // リレーション定義
    public function lecture()
    {
        return $this->belongsTo(Lectures::class, 'lectureId', 'lectureId');
    }

    public function lectureDetailTime()
    {
        return $this->hasMany(LectureDetailTimes::class, 'lectureDetailId', 'lectureDetailId');
    }
}
