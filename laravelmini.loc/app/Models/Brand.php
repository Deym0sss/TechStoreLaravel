<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    /**
     * Отношение "один ко многим" с моделью Device
     */
    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    /**
     * Отношение "многие ко многим" с моделью Type через таблицу TypeBrand
     */
    public function types()
    {
        return $this->belongsToMany(Type::class, 'type_brand');
    }
}
