<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function products()
    {
        return $this->belongsToMany("App\Models\Product")->withTimestamps();
    }
}
