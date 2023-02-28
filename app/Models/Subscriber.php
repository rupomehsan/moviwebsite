<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */

    protected $appends = ['added_on'];
    public function getAddedOnAttribute()
    {
        return $this->created_at->format('d F Y');
    }

}
