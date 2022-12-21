<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = "id";
    protected $guarded = [];
    public $timestamps = false;
    public function maxID()
    {
        return DB::table('orders')
            ->select(DB::raw("MAX(id) AS ID_Max "))
            ->get();
    }
    public function currentTime()
    {
        $currentTime = Carbon::now();
        return $currentTime->toDateTimeString();
    }
}
