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

    // Param Limit 가 있을 경우에만 paginate 처리
    if (!function_exists('choicePaginate')) {
        function choicePaginate($query)
        {
            $limit = request('limit', 15);

            return request()->has('simple')
                ? $query->latest('id')->simplePaginate($limit)
                : $query->latest('id')->paginate($limit);
        }
    }
}
