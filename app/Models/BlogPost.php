<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogPost extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'content',
        'status',
        'is_published',
        'published_at',
        'image',
        'views',
        'is_featured',
        'category_id',
        'user_id',
    ];


    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    public function getPublishedAtAttribute($value)
    {
        return Carbon::createFromDate($value)->diffForHumans();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function related()
    {
        return self::all()->where('status', 1)->except($this->id);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function getUserPosts($id)
    {
        return self::query()->where('user_id', $id)->where('status', 1);
    }

    public function deletePost()
    {
        $this->status = 0;
        $this->views = 0;
        $this->is_featured = 0;
        $this->is_published = 0;
        $this->published_at = null;
        $this->save();
        $this->delete();
    }


    public static function findBySlug($slug)
    {
        return self::query()->where('slug', $slug)->firstOrFail();
    }
}
