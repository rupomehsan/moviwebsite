<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    // protected $hidden = [
    //     'updated_at',
    //     'created_at',
    // ];

    protected $appends = ['added_on', 'user_image_url'];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAddedOnAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getUserImageUrlAttribute()
    {
        $imageurl = '';
        if (!empty($this->user->image)) {
            $imageurl = $this->user->image;
        }
        $protocol = request()->secure();
        if ($protocol == false) {
            $protocol = str_contains(config('app.url'), 'https') ? 'https://' : 'http://';
        }
        return $protocol . $_SERVER['HTTP_HOST'] . '/uploads/user/' . $imageurl;
//        return $_SERVER['HTTP_HOST']. '/uploads/user/'. $imageurl;
    }

}
