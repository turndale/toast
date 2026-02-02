<?php

namespace Turndale\Toast\Tests;

use Flux\Flux;

class ToastTest extends TestCase
{
    public function test_alert_helper_calls_flux_toast()
    {
        Flux::shouldReceive('toast')
            ->once()
            ->withArgs(function ($text, $heading, $duration) {
                return $text === 'Alert message' && $heading === 'Alert Title' && $duration === 6000;
            });

        toast()->alert('Alert message', 'Alert Title');
    }

    public function test_success_helper_calls_flux_toast_with_success_variant()
    {
        Flux::shouldReceive('toast')
            ->once()
            ->withArgs(function ($text, $heading, $duration, $variant) {
                return $text === 'Success message' 
                    && $variant === 'success'
                    && $heading === 'Success Title'
                    && $duration === 6000;
            });

        toast()->success('Success message', 'Success Title');
    }

    public function test_error_helper_calls_flux_toast_with_danger_variant()
    {
        Flux::shouldReceive('toast')
            ->once()
            ->withArgs(function ($text, $heading, $duration, $variant) {
                return $text === 'Error message' 
                    && $variant === 'danger'
                    && $heading === 'Error Title'
                    && $duration === 6000;
            });

        toast()->error('Error message', 'Error Title');
    }

    public function test_override_duration()
    {
        Flux::shouldReceive('toast')
            ->once()
            ->withArgs(function ($text, $heading, $duration) {
                return $duration === 3000;
            });
            
        toast()->alert('Message', 'Title', 3000);
    }
    
    public function test_flash_success_stores_in_session()
    {
        toast()->flashSuccess('Flash message', 'Flash Title');
        
        $this->assertTrue(session()->has('toast'));
        $toast = session('toast');
        
        $this->assertEquals('Flash message', $toast['text']);
        $this->assertEquals('Flash Title', $toast['heading']);
        $this->assertEquals('success', $toast['variant']);
        $this->assertEquals(6000, $toast['duration']);
    }

    public function test_flash_error_stores_in_session()
    {
        toast()->flashError('Flash error', 'Flash Title');
        
        $this->assertTrue(session()->has('toast'));
        $toast = session('toast');
        
        $this->assertEquals('Flash error', $toast['text']);
        $this->assertEquals('danger', $toast['variant']);
    }
}
