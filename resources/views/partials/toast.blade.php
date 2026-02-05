@php
    $toastData = null;

    // Support for full toast array: session('toast', [...]) or ->with('toast', [...])
    if (session()->has('toast')) {
        $toastData = session('toast');
        $toastData['variant'] ??= 'success';
    }
    // Support for simple patterns: session('success', 'msg') or ->with('success', 'msg')
    elseif (session()->has('success')) {
        $toastData = [
            'variant' => 'success',
            'text' => session('success'),
        ];
    }
    elseif (session()->has('error')) {
        $toastData = [
            'variant' => 'danger',
            'text' => session('error'),
        ];
    }
    elseif (session()->has('warning')) {
        $toastData = [
            'variant' => 'warning',
            'text' => session('warning'),
        ];
    }
    elseif (session()->has('info')) {
        $toastData = [
            'variant' => 'warning',
            'text' => session('info'),
        ];
    }

    if ($toastData) {
        $toastData['heading'] ??= '';
        $toastData['duration'] ??= 6000;
    }
@endphp

@if ($toastData)
    <div x-data x-init='$nextTick(() => { $flux.toast(@json($toastData)) })'></div>
@endif
