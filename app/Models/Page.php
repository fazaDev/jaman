<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Page extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'featured_image_alt',
        'meta_description',
        'meta_keywords',
        'status',
        'parent_id',
        'sort_order',
        'is_featured',
        'seo_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'seo_data' => 'array',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('title') && empty($page->getOriginal('slug'))) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    /**
     * Get the parent page.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    /**
     * Get the child pages.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id')->orderBy('sort_order');
    }

    /**
     * Get all descendants (children, grandchildren, etc.).
     */
    public function descendants(): HasMany
    {
        return $this->children()->with('descendants');
    }

    /**
     * Scope to get only published pages.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope to get only root pages (no parent).
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope to get featured pages.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get the page's breadcrumb trail.
     */
    public function getBreadcrumbsAttribute(): array
    {
        $breadcrumbs = [];
        $page = $this;

        while ($page) {
            array_unshift($breadcrumbs, [
                'title' => $page->title,
                'slug' => $page->slug,
            ]);
            $page = $page->parent;
        }

        return $breadcrumbs;
    }

    /**
     * Get available status options.
     */
    public static function getStatusOptions(): array
    {
        return [
            'draft' => 'Draft',
            'published' => 'Published',
            'archived' => 'Archived',
        ];
    }

    /**
     * Check if page has children.
     */
    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }

    /**
     * Get the full URL path including parent slugs.
     */
    public function getFullPathAttribute(): string
    {
        $path = [];
        $page = $this;

        while ($page) {
            array_unshift($path, $page->slug);
            $page = $page->parent;
        }

        return '/' . implode('/', $path);
    }
}
