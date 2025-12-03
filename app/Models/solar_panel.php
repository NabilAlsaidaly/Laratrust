<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solar_panel extends Model
{
    use HasFactory;
    protected $table = 'solar_panel';
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
        return $this->hasMany(Own::class, 'solar_panel_id');
    }

    public function companies()
    {
        return $this->hasManyThrough(Company::class, Own::class, 'solar_panel_id', 'id', 'id', 'companies_id');
    }
}
