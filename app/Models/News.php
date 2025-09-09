<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'featured_image_alt',
        'category_id',
        'author_id',
        'status',
        'is_featured',
        'allow_comments',
        'meta_data',
        'tags',
        'published_at',
        'views_count',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'allow_comments' => 'boolean',
        'meta_data' => 'array',
        'tags' => 'array',
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
            if (empty($news->published_at) && $news->status === 'published') {
                $news->published_at = now();
            }
        });

        static::updating(function ($news) {
            if ($news->status === 'published' && $news->getOriginal('status') !== 'published' && empty($news->published_at)) {
                $news->published_at = now();
            }
        });
    }

    /**
     * Get the category that owns the news.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the author that owns the news.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Scope a query to only include published news.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include featured news.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order by publication date.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Check if news is published.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published' && $this->published_at <= now();
    }

    /**
     * Check if news is draft.
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Get the featured image URL.
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image ? Storage::url($this->featured_image) : null;
    }

    /**
     * Get reading time estimate.
     */
    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->content));
        return max(1, ceil($words / 200)); // Average reading speed: 200 words per minute
    }

    /**
     * Increment the views count.
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Get excerpt or auto-generate from content.
     */
    public function getExcerptAttribute($value): string
    {
        if (!empty($value)) {
            return $value;
        }
        
        return Str::limit(strip_tags($this->content), 150);
    }
}
