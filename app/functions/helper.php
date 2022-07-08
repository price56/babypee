<?php

use App\Enum\Auth\DeviceType;
use Jenssegers\Agent\Agent;

if (!function_exists('getDeviceType')) {
    function getDeviceType(): string|null
    {
        $agent = new Agent();

        return match(true) {
            $agent->isiOS(), $agent->isiPad() => DeviceType::IOS->value,
            $agent->isAndroidOS() => DeviceType::ANDROID->value,
            default => null,
        };
    }
}
