<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = "user";

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
    public function maxID()
    {
        return DB::table('users')
            ->select(DB::raw("MAX(id) AS ID_Max "))
            ->get();
    }
    public function getAllUsers($search = null) {
        $users = User::first('id');
        if(!empty($search)) {
            $users = $users->where(function($query) use ($search) {
                $query->orWhere('users.name','like','%'.$search.'%');
                $query->orWhere('users.email','like','%'.$search.'%');
                $query->orWhere('users.address','like','%'.$search.'%');
            });
        }
        $users = $users->paginate(10);
        return $users;
    }
}
