<?php

use App\Models\Settings;

if (! function_exists('settings')) {
    function settings($key) {
        $setting = Settings::where('key', $key)->first();

        return $setting?->value;
    }
}

if (! function_exists('update_settings')) {
    function update_settings($key, $value) {
        $setting = Settings::where('key', $key)->first();

        if($setting){
            $setting->value = $value;
            $setting->save();
        }
    }
}