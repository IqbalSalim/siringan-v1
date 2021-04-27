<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function rooms()
    {
        return $this->belongsToMany("App\Models\Room");
    }
    public function houses()
    {
        return $this->belongsToMany("App\Models\House");
    }
}
