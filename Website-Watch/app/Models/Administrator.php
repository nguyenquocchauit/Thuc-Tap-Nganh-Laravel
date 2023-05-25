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
    protected $guarded = [];
    public $timestamps = false;

    public function currentTime()
    {
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh');
        return $currentTime->toDateTimeString();
    }
    public function maxID()
    {
        return DB::table('administrator')
            ->select(DB::raw("MAX(id) AS ID_Max "))
            ->get();
    }
}
