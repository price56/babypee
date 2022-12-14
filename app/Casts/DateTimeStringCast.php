<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DateTimeStringCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return Carbon::parse($value)->toDateTimeString();
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
