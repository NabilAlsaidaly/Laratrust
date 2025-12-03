<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class company extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $guard= 'company';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'website',
        'contact',
        'location',
        'comm_id',
        'combank_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function technicians()
    {
        return $this->hasMany(Technician::class, 'companies_id');
    }

    public function batteries()
    {
        return $this->hasManyThrough(Battery::class, Own::class, 'companies_id', 'id', 'id', 'battery_id');
    }

    public function inverter()
    {
        return $this->hasManyThrough(inverter::class, Own::class, 'companies_id', 'id', 'id', 'inverter_id');
    }

    public function solar()
    {
        return $this->hasManyThrough(solar_panel::class, Own::class, 'companies_id', 'id', 'id', 'solar_panel_id');
    }

    public function categories()
    {
        return $this->hasManyThrough(Categories::class, Own::class, 'companies_id', 'id', 'id', 'categories_id');
    }

    public function buys()
    {
        return $this->hasMany(Buy::class, 'companies_id');
    }
}
