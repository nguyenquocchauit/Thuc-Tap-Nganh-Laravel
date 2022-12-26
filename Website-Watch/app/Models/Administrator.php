<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $guard = "admin";
    protected $table = "administrator";
    protected $primaryKey = "id";
    protected $guarded = [];
}
