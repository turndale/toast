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

    public function test_flash_warning_stores_in_session()
    {
        toast()->flashWarning('Flash warning', 'Warning Title');
        
        $this->assertTrue(session()->has('toast'));
        $toast = session('toast');
        
        $this->assertEquals('Flash warning', $toast['text']);
        $this->assertEquals('Warning Title', $toast['heading']);
        $this->assertEquals('warning', $toast['variant']);
        $this->assertEquals(6000, $toast['duration']);
    }

    public function test_flash_info_stores_in_session()
    {
        toast()->flashInfo('Flash info', 'Info Title');
        
        $this->assertTrue(session()->has('toast'));
        $toast = session('toast');
        
        $this->assertEquals('Flash info', $toast['text']);
        $this->assertEquals('Info Title', $toast['heading']);
        $this->assertEquals('info', $toast['variant']);
        $this->assertEquals(6000, $toast['duration']);
    }

    // Simple flash tests (Laravel's familiar patterns)
    public function test_simple_flash_success_stores_in_session()
    {
        toast()->simpleFlashSuccess('Simple success message');
        
        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Simple success message', session('success'));
    }

    public function test_simple_flash_error_stores_in_session()
    {
        toast()->simpleFlashError('Simple error message');
        
        $this->assertTrue(session()->has('error'));
        $this->assertEquals('Simple error message', session('error'));
    }

    public function test_simple_flash_warning_stores_in_session()
    {
        toast()->simpleFlashWarning('Simple warning message');
        
        $this->assertTrue(session()->has('warning'));
        $this->assertEquals('Simple warning message', session('warning'));
    }

    public function test_simple_flash_info_stores_in_session()
    {
        toast()->simpleFlashInfo('Simple info message');
        
        $this->assertTrue(session()->has('info'));
        $this->assertEquals('Simple info message', session('info'));
    }

    public function test_simple_flash_generic_stores_in_session()
    {
        toast()->simpleFlash('success', 'Generic flash message');
        
        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Generic flash message', session('success'));
    }

    // Same-page session tests (non-flash)
    public function test_session_success_stores_in_session()
    {
        toast()->sessionSuccess('Session success message');
        
        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Session success message', session('success'));
    }

    public function test_session_error_stores_in_session()
    {
        toast()->sessionError('Session error message');
        
        $this->assertTrue(session()->has('error'));
        $this->assertEquals('Session error message', session('error'));
    }

    public function test_session_warning_stores_in_session()
    {
        toast()->sessionWarning('Session warning message');
        
        $this->assertTrue(session()->has('warning'));
        $this->assertEquals('Session warning message', session('warning'));
    }

    public function test_session_info_stores_in_session()
    {
        toast()->sessionInfo('Session info message');
        
        $this->assertTrue(session()->has('info'));
        $this->assertEquals('Session info message', session('info'));
    }

    // Test that Laravel's native session patterns work (simulating what blade partial checks)
    public function test_native_session_flash_success_pattern()
    {
        session()->flash('success', 'Native flash success');
        
        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Native flash success', session('success'));
    }

    public function test_native_session_flash_error_pattern()
    {
        session()->flash('error', 'Native flash error');
        
        $this->assertTrue(session()->has('error'));
        $this->assertEquals('Native flash error', session('error'));
    }

    public function test_native_session_flash_warning_pattern()
    {
        session()->flash('warning', 'Native flash warning');
        
        $this->assertTrue(session()->has('warning'));
        $this->assertEquals('Native flash warning', session('warning'));
    }

    public function test_native_session_flash_info_pattern()
    {
        session()->flash('info', 'Native flash info');
        
        $this->assertTrue(session()->has('info'));
        $this->assertEquals('Native flash info', session('info'));
    }

    // Toast helper function tests
    public function test_toast_helper_returns_toast_service_instance()
    {
        $service = toast();
        
        $this->assertInstanceOf(\Turndale\Toast\Services\ToastService::class, $service);
    }

    public function test_toast_helper_all_instant_methods_are_callable()
    {
        $service = toast();
        
        // Verify all instant methods exist and are callable
        $this->assertTrue(method_exists($service, 'alert'));
        $this->assertTrue(method_exists($service, 'success'));
        $this->assertTrue(method_exists($service, 'error'));
        $this->assertTrue(method_exists($service, 'warning'));
        $this->assertTrue(method_exists($service, 'server'));
        $this->assertTrue(method_exists($service, 'invalid'));
    }

    public function test_toast_helper_all_flash_methods_are_callable()
    {
        $service = toast();
        
        // Verify all flash methods exist and are callable
        $this->assertTrue(method_exists($service, 'flash'));
        $this->assertTrue(method_exists($service, 'flashSuccess'));
        $this->assertTrue(method_exists($service, 'flashError'));
        $this->assertTrue(method_exists($service, 'flashWarning'));
        $this->assertTrue(method_exists($service, 'flashInfo'));
        $this->assertTrue(method_exists($service, 'flashServer'));
    }

    public function test_toast_helper_all_simple_flash_methods_are_callable()
    {
        $service = toast();
        
        // Verify all simple flash methods exist and are callable
        $this->assertTrue(method_exists($service, 'simpleFlash'));
        $this->assertTrue(method_exists($service, 'simpleFlashSuccess'));
        $this->assertTrue(method_exists($service, 'simpleFlashError'));
        $this->assertTrue(method_exists($service, 'simpleFlashWarning'));
        $this->assertTrue(method_exists($service, 'simpleFlashInfo'));
    }

    public function test_toast_helper_all_session_methods_are_callable()
    {
        $service = toast();
        
        // Verify all session methods exist and are callable
        $this->assertTrue(method_exists($service, 'sessionSuccess'));
        $this->assertTrue(method_exists($service, 'sessionError'));
        $this->assertTrue(method_exists($service, 'sessionWarning'));
        $this->assertTrue(method_exists($service, 'sessionInfo'));
    }

    public function test_toast_helper_can_chain_flash_success()
    {
        toast()->flashSuccess('Chained flash success');
        
        $this->assertTrue(session()->has('toast'));
        $this->assertEquals('Chained flash success', session('toast')['text']);
        $this->assertEquals('success', session('toast')['variant']);
    }

    public function test_toast_helper_can_chain_simple_flash_error()
    {
        toast()->simpleFlashError('Chained simple error');
        
        $this->assertTrue(session()->has('error'));
        $this->assertEquals('Chained simple error', session('error'));
    }

    public function test_toast_helper_can_chain_session_warning()
    {
        toast()->sessionWarning('Chained session warning');
        
        $this->assertTrue(session()->has('warning'));
        $this->assertEquals('Chained session warning', session('warning'));
    }
}
