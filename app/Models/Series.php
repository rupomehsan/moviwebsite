<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        $protocol = request()->secure();
        if ($protocol == false) {
            $protocol = str_contains(config('app.url'), 'https') ? 'https://' : 'http://';
        }

        return $protocol . $_SERVER['HTTP_HOST'] . '/uploads/series/' . $this->image;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    // protected $hidden = [
    //     'updated_at',
    //     'created_at',
    // ];
    public function video()
    {
        return $this->hasMany(Video::class);
    }

}
