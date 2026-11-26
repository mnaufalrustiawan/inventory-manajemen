<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name', 'short_code'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
