<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'button_text',
        'button_url',
        'button_new_tab',
        'status',
        'sort_order',
        'settings',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'button_new_tab' => 'boolean',
        'settings' => 'array',
        'sort_order' => 'integer',
    ];

    /**
     * Scope to get only active sliders.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get sliders ordered by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Scope to get sliders with local images only.
     */
    public function scopeLocalImages($query)
    {
        return $query->where(function ($q) {
            $q->whereNotNull('image_path')
              ->where('image_path', '!=', '')
              ->where('image_path', 'NOT LIKE', 'http://%')
              ->where('image_path', 'NOT LIKE', 'https://%');
        });
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
     * Get the full URL for the image (local storage only).
     */
    public function getImageUrlAttribute(): string
    {
        // Only return local storage URLs, ignore external URLs
        if (empty($this->image_path) || str_starts_with($this->image_path, 'http')) {
            return '';
        }

        return Storage::url($this->image_path);
    }

    /**
     * Check if slider has a button.
     */
    public function hasButton(): bool
    {
        return !empty($this->button_text) && !empty($this->button_url);
    }

    /**
     * Get button target attribute.
     */
    public function getButtonTargetAttribute(): string
    {
        return $this->button_new_tab ? '_blank' : '_self';
    }

    /**
     * Get overlay opacity setting.
     */
    public function getOverlayOpacity(): float
    {
        return $this->settings['overlay_opacity'] ?? 0.5;
    }

    /**
     * Get text position setting.
     */
    public function getTextPosition(): string
    {
        return $this->settings['text_position'] ?? 'center';
    }

    /**
     * Get animation type setting.
     */
    public function getAnimationType(): string
    {
        return $this->settings['animation_type'] ?? 'fade';
    }
}
