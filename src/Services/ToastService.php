<?php

namespace Turndale\Toast\Services;

use Flux\Flux;

class ToastService
{
    public function alert(string $message = '', string $title = '', int $duration = 6000): void
    {
        Flux::toast(text: $message, heading: $title, duration: $duration);
    }

    public function success(string $message = '', string $title = '', int $duration = 6000): void
    {
        Flux::toast(text: $message, heading: $title, duration: $duration, variant: 'success');
    }

    public function error(string $message = '', string $title = '', int $duration = 6000): void
    {
        Flux::toast(text: $message, heading: $title, duration: $duration, variant: 'danger');
    }

    public function warning(string $message = '', string $title = '', int $duration = 6000): void
    {
        Flux::toast(text: $message, heading: $title, duration: $duration, variant: 'warning');
    }

    public function server(string $message = 'Try again later or contact support', string $title = 'Something went wrong', string $type = 'danger', int $duration = 6000): void
    {
        Flux::toast(text: $message, heading: $title, duration: $duration, variant: $type);
    }

    public function invalid(string $message = 'Check form for validation errors', string $title = '', string $type = 'danger', int $duration = 6000): void
    {
        Flux::toast(text: $message, heading: $title, duration: $duration, variant: $type);
    }

    public function flash(string $message = '', string $title = '', int $duration = 6000): void
    {
        session()->flash('toast', [
            'text' => $message,
            'heading' => $title,
            'duration' => $duration,
        ]);
    }

    public function flashSuccess(string $message = '', string $title = '', int $duration = 6000): void
    {
        session()->flash('toast', [
            'variant' => 'success',
            'text' => $message,
            'heading' => $title,
            'duration' => $duration,
        ]);
    }

    public function flashError(string $message = '', string $title = '', int $duration = 6000): void
    {
        session()->flash('toast', [
            'variant' => 'danger',
            'text' => $message,
            'heading' => $title,
            'duration' => $duration,
        ]);
    }

    public function flashWarning(string $message = '', string $title = '', int $duration = 6000): void
    {
        session()->flash('toast', [
            'variant' => 'warning',
            'text' => $message,
            'heading' => $title,
            'duration' => $duration,
        ]);
    }

    public function flashServer(string $message = 'Something went wrong, please try again later or contact support', string $title = '', int $duration = 6000): void
    {
        session()->flash('toast', [
            'variant' => 'danger',
            'text' => $message,
            'heading' => $title,
            'duration' => $duration,
        ]);
    }

    public function flashInfo(string $message = '', string $title = '', int $duration = 6000): void
    {
        session()->flash('toast', [
            'variant' => 'warning',
            'text' => $message,
            'heading' => $title,
            'duration' => $duration,
        ]);
    }

    /**
     * Simple flash helpers using Laravel's familiar session patterns.
     * These use the simple session keys: 'success', 'error', 'warning', 'info'
     */
    public function simpleFlash(string $type, string $message): void
    {
        session()->flash($type, $message);
    }

    public function simpleFlashSuccess(string $message): void
    {
        session()->flash('success', $message);
    }

    public function simpleFlashError(string $message): void
    {
        session()->flash('error', $message);
    }

    public function simpleFlashWarning(string $message): void
    {
        session()->flash('warning', $message);
    }

    public function simpleFlashInfo(string $message): void
    {
        session()->flash('info', $message);
    }

    /**
     * Same-page session alerts (non-flash, for current request).
     * These persist in session until manually cleared or page refresh.
     */
    public function sessionSuccess(string $message): void
    {
        session(['success' => $message]);
    }

    public function sessionError(string $message): void
    {
        session(['error' => $message]);
    }

    public function sessionWarning(string $message): void
    {
        session(['warning' => $message]);
    }

    public function sessionInfo(string $message): void
    {
        session(['info' => $message]);
    }
}
