<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceInfo extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'device_id'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
