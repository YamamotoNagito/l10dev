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

    protected $table = 'lecture_details'; // テーブル名を指定

    protected $primaryKey = 'lecture_detail_id'; // プライマリーキーのカラム名を指定

    protected $fillable = [
        'lecture_id',
        'lecture_code',
        'syllabus_url',
        'location',
        'faculty',
        'category',
        'grade',
    ];
}
