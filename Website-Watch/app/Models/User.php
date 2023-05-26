<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = "user";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'phone_number',
        'address',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'timestamp',
    ];

    public function comment()
    {
        return $this->belongsTo(User::class, 'customers', 'id');
    }
    public function currentTime()
    {
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh');
        return $currentTime->toDateTimeString();
    }
    public function maxID()
    {
        return DB::table('users')
            ->select(DB::raw("MAX(id) AS ID_Max "))
            ->get();
    }
    public function getAllUsers($search = null)
    {
        $users = User::first('id');
        if (!empty($search)) {
            $users = $users->where(function ($query) use ($search) {
                $query->orWhere('users.name', 'like', '%' . $search . '%');
                $query->orWhere('users.email', 'like', '%' . $search . '%');
                $query->orWhere('users.address', 'like', '%' . $search . '%');
                $query->orWhere('users.phone_number', 'like', '%' . $search . '%');
            });
        }
        $users = $users->paginate(10);
        return $users;
    }
}
