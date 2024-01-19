<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class LectureDetailTimes extends Model
{
    use HasFactory;

    protected $table = 'lectureDetailTimes'; // テーブル名を指定

    protected $primaryKey = 'lectureTimeId'; // プライマリキーのカラム名を指定

    public $timestamps = false;

    protected $fillable = [
        'lectureDetailId',
        'year',
        'term',
        'dayOfWeek',
        'timePeriod',
    ];

    // リレーション定義
    public function lectureDetail()
    {
        return $this->belongsTo(LectureDetails::class, 'lectureDetailId', 'lectureDetailId');
    }
}
