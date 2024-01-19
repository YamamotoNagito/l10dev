<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Likes extends Model
{
    use HasFactory;

    protected $table = 'likes'; // テーブル名を指定

    public $timestamps = false; // created_atとupdated_atを無効にする

    protected $fillable = [
        'reviewId',
        'userId',
        'createdAt',
        // 他のカラムを追加
    ];

    // リレーション定義
    public function review()
    {
        return $this->belongsTo(Review::class, 'reviewId', 'reviewId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }
}
