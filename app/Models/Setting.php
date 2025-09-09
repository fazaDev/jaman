<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
        'is_public',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_public' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Clear cache when settings are updated
        static::saved(function () {
            Cache::forget('settings');
            Cache::forget('public_settings');
        });

        static::deleted(function () {
            Cache::forget('settings');
            Cache::forget('public_settings');
        });
    }

    /**
     * Scope a query to only include public settings.
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    /**
     * Scope a query to order by group and sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('group')->orderBy('sort_order')->orderBy('key');
    }

    /**
     * Scope a query to filter by group.
     */
    public function scopeGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    /**
     * Get a setting value by key.
     */
    public static function get($key, $default = null)
    {
        $settings = Cache::remember('settings', 3600, function () {
            return static::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Set a setting value.
     */
    public static function set($key, $value, $type = 'text', $group = null)
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
            ]
        );
    }

    /**
     * Get all public settings for frontend.
     */
    public static function getPublicSettings()
    {
        return Cache::remember('public_settings', 3600, function () {
            return static::public()->pluck('value', 'key')->toArray();
        });
    }

    /**
     * Get settings by group.
     */
    public static function getByGroup($group)
    {
        return static::where('group', $group)
            ->ordered()
            ->get()
            ->mapWithKeys(function ($setting) {
                return [$setting->key => $setting->value];
            })
            ->toArray();
    }

    /**
     * Get the parsed value based on type.
     */
    public function getParsedValueAttribute()
    {
        switch ($this->type) {
            case 'boolean':
                return filter_var($this->value, FILTER_VALIDATE_BOOLEAN);
            case 'number':
                return is_numeric($this->value) ? (float) $this->value : 0;
            case 'json':
                return json_decode($this->value, true) ?? [];
            default:
                return $this->value;
        }
    }

    /**
     * Get available setting types.
     */
    public static function getTypes()
    {
        return [
            'text' => 'Text',
            'textarea' => 'Textarea',
            'number' => 'Number',
            'boolean' => 'Boolean',
            'file' => 'File',
            'json' => 'JSON',
        ];
    }

    /**
     * Get available groups.
     */
    public static function getGroups()
    {
        return [
            'general' => 'General',
            'contact' => 'Contact Information',
            'social' => 'Social Media',
            'seo' => 'SEO Settings',
            'appearance' => 'Appearance',
            'email' => 'Email Settings',
            'api' => 'API Configuration',
        ];
    }
}
