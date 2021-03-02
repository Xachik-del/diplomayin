<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'text',
        'status',
        'user_id',
        'post_id'
    ];


    public function post()
    {
        return $this->belongsTo(BlogPost::class, 'post_id', 'id');
    }


    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromDate($value)->diffForHumans();
    }
}
