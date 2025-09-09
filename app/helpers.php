<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Get a setting value by key.
     */
    function setting($key, $default = null)
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('public_settings')) {
    /**
     * Get all public settings for frontend use.
     */
    function public_settings()
    {
        return Setting::getPublicSettings();
    }
}

if (! function_exists('settings_by_group')) {
    /**
     * Get settings by group.
     */
    function settings_by_group($group)
    {
        return Setting::getByGroup($group);
    }
}