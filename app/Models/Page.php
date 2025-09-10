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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['icon'];

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

    /**
     * Get the appropriate icon for this page.
     */
    public function getIconAttribute(): string
    {
        $iconMap = [
            // About/Profile related
            'about' => 'fas fa-info-circle',
            'tentang-kami' => 'fas fa-info-circle',
            'profil' => 'fas fa-building-columns',
            'profile' => 'fas fa-info-circle',

            // Contact related
            'contact' => 'fas fa-headset',
            'kontak' => 'fas fa-headset',

            // Services related
            'services' => 'fas fa-building',
            'layanan' => 'fas fa-building',
            'pelayanan' => 'fas fa-building',
            'bidang' => 'fas fa-building',

            // Vision/Mission
            'vision' => 'fas fa-eye',
            'visi' => 'fas fa-eye',
            'visi-misi' => 'fas fa-eye',
            'mission' => 'fas fa-bullseye',
            'misi' => 'fas fa-bullseye',

            // History
            'history' => 'fas fa-history',
            'sejarah' => 'fas fa-history',

            // Organization
            'structure' => 'fas fa-sitemap',
            'struktur' => 'fas fa-sitemap',
            'struktur-organisasi' => 'fas fa-sitemap',
            'organisasi' => 'fas fa-sitemap',

            // Team/Staff
            'team' => 'fas fa-users',
            'tim' => 'fas fa-users',
            'pegawai' => 'fas fa-users',
            'staff' => 'fas fa-users',

            // News/Information
            'news' => 'fas fa-newspaper',
            'berita' => 'fas fa-newspaper',
            'informasi' => 'fas fa-info',
            'pengumuman' => 'fas fa-bullhorn',

            // Gallery
            'gallery' => 'fas fa-images',
            'galeri' => 'fas fa-images',
            'foto' => 'fas fa-camera',
            'video' => 'fas fa-video',

            // Programs
            'program' => 'fas fa-tasks',
            'kegiatan' => 'fas fa-calendar-alt',
            'agenda' => 'fas fa-calendar',

            // Documents
            'document' => 'fas fa-file-alt',
            'dokumen' => 'fas fa-file-alt',
            'publikasi' => 'fas fa-book',
            'laporan' => 'fas fa-file-pdf',

            // Other
            'pengaduan' => 'fas fa-exclamation-triangle',
            'perizinan' => 'fas fa-certificate',
            'data' => 'fas fa-chart-bar',
            'statistik' => 'fas fa-chart-line',
        ];

        return $iconMap[$this->slug] ?? 'fas fa-file-alt';
    }
}
