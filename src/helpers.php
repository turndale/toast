<?php

use Turndale\Toast\Services\ToastService;

if (! function_exists('toast')) {
    /**
     * Get the ToastService instance
     *
     * @param  string|null  $method
     * @param  mixed  ...$args
     * @return ToastService|mixed|null
     */
    function toast(?string $method = null, ...$args): mixed
    {
        $service = app(ToastService::class);

        if ($method === null) {
            return $service;
        }

        if (str_starts_with($method, 'flash')) {
            return $service->$method(...$args);
        }

        return $service->$method(...$args);
    }
}
