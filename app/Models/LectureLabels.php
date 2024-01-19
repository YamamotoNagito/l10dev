<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class LectureLabels extends Model
{
    use HasFactory;

    protected $table = 'lectureLabels'; // テーブル名を指定

    public $timestamps = false; // created_atとupdated_atを無効にする

    protected $fillable = [
        'lectureId',
        'labelId',
        // 他のカラムを追加
    ];

    // プライマリキーの設定
    protected $primaryKey = ['lectureId', 'labelId'];

    // リレーション定義
    public function lecture()
    {
        return $this->belongsTo(Lectures::class, 'lectureId', 'lectureId');
    }

    public function label()
    {
        return $this->belongsTo(Labels::class, 'labelId', 'labelId');
    }
}
