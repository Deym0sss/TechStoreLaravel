<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketDevice extends Model
{
    use HasFactory;
    protected $fillable = ['basket_id', 'device_id'];

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
