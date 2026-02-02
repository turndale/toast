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
}
