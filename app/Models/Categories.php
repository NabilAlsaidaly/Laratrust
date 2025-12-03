<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'price',
        'quantities',
        'description',
        'image',
    ];

    public function owns()
    {
        return $this->hasMany(Own::class, 'categories_id');
    }

    public function companies()
    {
        return $this->hasManyThrough(company::class, Own::class, 'categories_id', 'id', 'id', 'companies_id');
    }
}
