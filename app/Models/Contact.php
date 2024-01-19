<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Contacts extends Model
{
    use HasFactory;

    protected $table = 'contact';
    protected $primaryKey = 'contactId';

    // public $timestamps = true;
    public $timestamps = false; // 自動更新を無効にする

    protected $fillable = [
        'name',
        'email',
        'category',
        'message',
        'createdAt',
    ];

}
