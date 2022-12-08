<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = "order_details";
    protected $primaryKey = "id";
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(OrderDetail::class, 'product', 'id');
    }
}