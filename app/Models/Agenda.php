<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Agenda extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'start_date',
        'end_date',
        'location',
        'status',
        'is_featured',
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
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($agenda) {
            if (empty($agenda->slug)) {
                $agenda->slug = Str::slug($agenda->title);
            }
        });
    }

    /**
     * Scope a query to only include published agendas.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope a query to only include featured agendas.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order by start date.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now())
                    ->orderBy('start_date', 'asc');
    }

    /**
     * Scope a query to get past agendas.
     */
    public function scopePast($query)
    {
        return $query->where('start_date', '<', now())
                    ->orderBy('start_date', 'desc');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Check if agenda is published.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Check if agenda is draft.
     */
    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    /**
     * Check if agenda is upcoming.
     */
    public function isUpcoming(): bool
    {
        return $this->start_date && $this->start_date > now();
    }

    /**
     * Check if agenda is in progress.
     */
    public function isInProgress(): bool
    {
        return $this->start_date && $this->end_date && 
               $this->start_date <= now() && $this->end_date >= now();
    }

    /**
     * Check if agenda is past.
     */
    public function isPast(): bool
    {
        return $this->start_date && $this->start_date < now();
    }

    /**
     * Get status options.
     */
    public static function getStatusOptions(): array
    {
        return [
            'draft' => 'Draft',
            'published' => 'Published',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed',
        ];
    }
}