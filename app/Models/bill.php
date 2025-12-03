<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
    use HasFactory;
    protected $table = 'bill';
    protected $fillable = [
        'value',
        'date',
    ];

    public function buy()
    {
        return $this->hasMany(Buy::class);
    }
}
