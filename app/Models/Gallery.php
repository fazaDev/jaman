<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'file_path',
        'thumbnail_path',
        'alt_text',
        'metadata',
        'status',
        'sort_order',
        'category',
        'tags',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'metadata' => 'array',
        'tags' => 'array',
        'sort_order' => 'integer',
    ];

    /**
     * Scope to get only active galleries.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get galleries ordered by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Scope to get only images.
     */
    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }

    /**
     * Scope to get only videos.
     */
    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    /**
     * Scope to filter by category.
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get available type options.
     */
    public static function getTypeOptions(): array
    {
        return [
            'image' => 'Image',
            'video' => 'Video',
        ];
    }

    /**
     * Get available status options.
     */
    public static function getStatusOptions(): array
    {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ];
    }

    /**
     * Get available category options.
     */
    public static function getCategoryOptions(): array
    {
        return [
            'portfolio' => 'Portfolio',
            'events' => 'Events',
            'products' => 'Products',
            'team' => 'Team',
            'office' => 'Office',
            'general' => 'General',
        ];
    }

    /**
     * Get the full URL for the file.
     */
    public function getFileUrlAttribute(): string
    {
        if (str_starts_with($this->file_path, 'http')) {
            return $this->file_path;
        }
        
        return Storage::url($this->file_path);
    }

    /**
     * Get the full URL for the thumbnail.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if (!$this->thumbnail_path) {
            return $this->file_url; // Use original file if no thumbnail
        }
        
        if (str_starts_with($this->thumbnail_path, 'http')) {
            return $this->thumbnail_path;
        }
        
        return Storage::url($this->thumbnail_path);
    }

    /**
     * Check if gallery item is an image.
     */
    public function isImage(): bool
    {
        return $this->type === 'image';
    }

    /**
     * Check if gallery item is a video.
     */
    public function isVideo(): bool
    {
        return $this->type === 'video';
    }

    /**
     * Get video duration in human readable format.
     */
    public function getVideoDuration(): ?string
    {
        if (!$this->isVideo() || !isset($this->metadata['duration'])) {
            return null;
        }
        
        $seconds = $this->metadata['duration'];
        $minutes = floor($seconds / 60);
        $seconds = $seconds % 60;
        
        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    /**
     * Get file dimensions.
     */
    public function getDimensions(): ?string
    {
        if (!isset($this->metadata['width']) || !isset($this->metadata['height'])) {
            return null;
        }
        
        return $this->metadata['width'] . ' x ' . $this->metadata['height'];
    }

    /**
     * Get file size in human readable format.
     */
    public function getFileSize(): ?string
    {
        if (!isset($this->metadata['size'])) {
            return null;
        }
        
        $bytes = $this->metadata['size'];
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
