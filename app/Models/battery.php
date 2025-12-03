<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class battery extends Model
{
    use HasFactory;
    protected $table = 'battery';
    protected $fillable = [
        'name',
        'price',
        'quantities',
        'capacity',
        'type',
        'image',
    ];

    public function owns()
    {
        return $this->hasMany(Own::class, 'battery_id');
    }

    public function companies()
    {
        return $this->hasManyThrough(Company::class, Own::class, 'battery_id', 'id', 'id', 'companies_id');
    }
}
