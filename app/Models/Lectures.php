<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Reviews;

class Lectures extends Model
{
    use HasFactory;

    protected $table = 'lectures';
    protected $primaryKey = 'lectureId';
    // migrationファイルにはcreated_atとupdated_atがないので、自動更新を無効にする
    public $timestamps = false;

    protected $fillable = [
        'lectureName',
        'teacherName',
    ];

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'lectureId', 'lectureId');
    }
}
