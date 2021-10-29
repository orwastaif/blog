<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Password_reset extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'user_id',
        'reset_code',
    ];
}
