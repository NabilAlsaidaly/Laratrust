<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inverter extends Model
{
    use HasFactory;
    protected $table = 'inverter';
    protected $fillable = [
        'name',
        'price',
        'quantities',
        'capacity',
        'description',
        'image',
    ];


    public function owns()
    {
        return $this->hasMany(Own::class, 'inverter_id');
    }

    public function companies()
    {
        return $this->hasManyThrough(Company::class, Own::class, 'inverter_id', 'id', 'id', 'companies_id');
    }
}
