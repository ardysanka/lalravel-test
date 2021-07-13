<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrepaidBalance extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->morphMany(Order::class, 'orderable');
    }
}
