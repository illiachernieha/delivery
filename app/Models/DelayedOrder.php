<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelayedOrder extends Model
{
    use HasFactory;

    protected $table = 'delayed_orders';

    protected $fillable = [
        'orderId',
        'expectedTime',
        'deliveryTime',
        'status'
    ];
}
