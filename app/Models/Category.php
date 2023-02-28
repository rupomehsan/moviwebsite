<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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

        return $protocol . $_SERVER['HTTP_HOST'] . '/uploads/category/' . $this->image;
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
    public function video_setting()
    {
        return $this->hasMany(VideoSetting::class);
    }
    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function video()
    {
        return $this->hasMany(Video::class);
    }
    public function banner()
    {
        return $this->hasMany(Banner::class);
    }

}
