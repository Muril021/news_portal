<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $appends = [
        'limited_title',
    ];

    protected $fillable = [
        'banner',
        'title',
        'subtitle',
        'content',
        'slug',
        'user_id',
        'category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($news) {
            $news->slug = Str::slug($news->title);
        });
    }

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->format('d/m/Y H:i');
    }

    public function getLimitedTitleAttribute()
    {
        return Str::limit($this->attributes['title'], 50);
    }
}
