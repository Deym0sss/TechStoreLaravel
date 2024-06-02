<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
    
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'type_brand');
    }

}
