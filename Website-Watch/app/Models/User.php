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

    protected $primaryKey = "id";
    protected $keyType = 'string';
    public $timestamps = false;

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
    public function getAllUsers($search = null, $times = [])
    {
        $users = User::leftJoin('orders', 'orders.customers', '=', 'users.id')
            ->select([
                'users.*',
                DB::raw('COALESCE(SUM(orders.total), 0) as userTotalMoney'),
                DB::raw('COALESCE(COUNT(orders.id), 0) as userTotalOrder'),
            ])
            ->groupBy('users.name')
            ->orderBy('users.created_at', 'asc');

        if (!empty($search)) {
            $users = $users->where(function ($query) use ($search) {
                $query->orWhere('users.id', $search);
                $query->orWhere('users.name', 'like', '%' . $search . '%');
                $query->orWhere('users.email', 'like', '%' . $search . '%');
                $query->orWhere('users.address', 'like', '%' . $search . '%');
                $query->orWhere('users.phone_number', 'like', '%' . $search . '%');
            });
        }
        if (!empty($times)) {
            $users = $users->whereYear('users.created_at', '=', $times[0]);
            $users = $users->whereMonth('users.created_at', '=', $times[1]);
        }
        $users = $users->paginate(10);
        return $users;
    }
}
