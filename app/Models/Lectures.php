<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Lectures extends Model
{
    use HasFactory;

    protected $table = 'lectures';
    protected $primaryKey = 'lectureId';
    public $timestamps = true;

    protected $fillable = [
        'lectureName',
        'teacherName',
    ];
}
