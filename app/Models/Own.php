<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Own extends Model
{
    use HasFactory;

    protected $fillable = [
        'companies_id',
        'solar_panel_id',
        'inverter_id',
        'battery_id',
    ];

    // Define relationships if needed
    public function company()
    {
        return $this->belongsTo(Company::class, 'companies_id');
    }

    public function solarPanel()
    {
        return $this->belongsTo(solar_panel::class, 'solar_panel_id');
    }

    public function inverter()
    {
        return $this->belongsTo(inverter::class, 'inverter_id');
    }

    public function battery()
    {
        return $this->belongsTo(Battery::class, 'battery_id');
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'categories_id');
    }
}
