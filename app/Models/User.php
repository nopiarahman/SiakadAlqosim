<?php

namespace App\Models;

use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var string<int, string>
     */
    protected $fillable = [
        'name', 'username', 'password','marhalah_id'
    ];

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
    public function getEmailAttribute()
    {
        return $this->username;
    }

    public function setEmailAttribute($value)
    {
        $this->username = $value;
    }
    /**
     * Get the marhalah that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marhalah()
    {
        return $this->belongsTo(Marhalah::class);
    }
    /**
     * Get all of the guru for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function guru()
    {
        return $this->hasMany(Guru::class);
    }
    /**
     * Get all of the santri for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function santri(): HasMany
    {
        return $this->hasMany(Santri::class);
    }
    /**
     * Get the wali associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wali(): HasOne
    {
        return $this->hasOne(Wali::class);
    }
}
