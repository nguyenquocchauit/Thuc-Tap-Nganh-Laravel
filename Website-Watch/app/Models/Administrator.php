<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $guard = "admin";
    protected $table = "administrator";
    protected $primaryKey = "id";
    protected $keyType = 'string';
    protected $guarded = [];

    public $timestamps = false;


    public function getAllUsers($search = null)
    {
        $employeer = Administrator::orderBy('create_at', 'asc');
        if (!empty($search)) {
            $employeer = $employeer->where(function ($query) use ($search) {
                $query->orWhere('administrator.name', 'like', '%' . $search . '%');
                $query->orWhere('administrator.email', 'like', '%' . $search . '%');
                $query->orWhere('administrator.address', 'like', '%' . $search . '%');
                $query->orWhere('administrator.phone_number', 'like', '%' . $search . '%');
            });
        }
        $employeer = $employeer->paginate(10);
        return $employeer;
    }
}
