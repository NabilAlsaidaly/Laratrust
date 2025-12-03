<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buy extends Model
{
    use HasFactory;
    protected $table = 'buy';
    protected $fillable = [
        'user_id',
        'solar_panel_id',
        'inverter_id',
        'battery_id',
        'bill_id',
        'categories_id',
        'companies_id',
        'quantities',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

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


    public function getItemPriceAttribute()
    {
        if ($this->solar_panel_id) {
            return $this->solarPanel ? $this->solarPanel->price : 0;
        } elseif ($this->inverter_id) {
            return $this->inverter ? $this->inverter->price : 0;
        } elseif ($this->battery_id) {
            return $this->battery ? $this->battery->price : 0;
        } elseif ($this->categories_id) {
            return $this->categories ? $this->categories->price : 0;
        }
        return 0;
    }
}
