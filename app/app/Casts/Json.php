<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

/**
 *  class Json
 * @var Json
 */
class Json implements CastsAttributes
{
    /**
     * Get Json
     * @param $model
     * @param string $key
     * @param $value
     * @param array $attributes
     * @return mixed|null
     */
    public function get($model, string $key, $value, array $attributes): mixed
    {
        return json_decode($value, true);
    }

    /**
     * Set Json
     * @param $model
     * @param string $key
     * @param $value
     * @param array $attributes
     * @return false|string
     */
    public function set($model, string $key, $value, array $attributes): bool|string
    {
        return json_encode($value);
    }
}
