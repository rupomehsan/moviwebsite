<?php

namespace App\Models;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];
    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        $protocol = request()->secure();
        if ($protocol == false) {
            $protocol = str_contains(config('app.url'), 'https') ? 'https://' : 'http://';
        }

        return $protocol . $_SERVER['HTTP_HOST'] . '/uploads/user/' . $this->image;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
        'created_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_profile()
    {
        return $this->hasMany(UserProfile::class);
    }

    public function user_verification()
    {
        return $this->hasMany(UserVerification::class);
    }

    public function user_role()
    {
        return $this->belongsTo(UserRole::class);
    }
}
