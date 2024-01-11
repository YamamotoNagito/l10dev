<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $primaryKey = 'review_id';

    public $timestamps = false;

    // モデルのJSON形式に含める属性
    protected $visible = [
      'review_id',
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
      'created_at',
      'updated_at',
      'is_visible',
  ];
}

