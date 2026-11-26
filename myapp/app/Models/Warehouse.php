<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = ['name', 'location', 'status'];
    protected $casts = ['status' => 'boolean'];
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function puchases()
    {
        return $this->hasMany(Purchases::class);
    
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
