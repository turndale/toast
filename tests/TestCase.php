<?php

namespace Turndale\Toast\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Turndale\Toast\ToastServiceProvider;
use Livewire\LivewireServiceProvider;
use Flux\FluxServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            FluxServiceProvider::class,
            ToastServiceProvider::class,
        ];
    }
}
