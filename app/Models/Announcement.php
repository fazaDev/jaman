<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Announcement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'status',
        'is_featured',
        'published_at',
        'expires_at',
        'sort_order',
        'meta_description',
        'meta_keywords',
        'meta_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'meta_data' => 'array',
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($announcement) {
            if (empty($announcement->slug)) {
                $announcement->slug = Str::slug($announcement->title);
            }
            if (empty($announcement->published_at) && $announcement->status === 'published') {
                $announcement->published_at = now();
            }
        });

        static::updating(function ($announcement) {
            if ($announcement->status === 'published' && $announcement->getOriginal('status') !== 'published' && empty($announcement->published_at)) {
                $announcement->published_at = now();
            }
        });
    }

    /**
     * Scope a query to only include published announcements.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now())
                    ->where(function ($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                    });
    }

    /**
     * Scope a query to only include featured announcements.
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
     * Check if announcement is published.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published' && $this->published_at <= now() && 
               ($this->expires_at === null || $this->expires_at > now());
    }

    /**
     * Check if announcement is draft.
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Check if announcement has expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at <= now();
    }

    /**
     * Get status options.
     */
    public static function getStatusOptions(): array
    {
        return [
            'draft' => 'Draft',
            'published' => 'Published',
            'archived' => 'Archived',
        ];
    }
}