# Toast

A Laravel Package for Flux Toast integration.

This package provides a wrapper around [Livewire Flux](https://fluxui.dev) Toasts to simplify their usage and parameter arrangement, and adds support for flash messages using Laravel sessions.

## Installation

You can install the package via composer:

```bash
composer require turndale/toast
```

## Usage

### Basic Usage

The primary reason for this wrapper is that the native `Flux::toast()` method uses named arguments or a specific order that might be cumbersome for frequent simple alerts. This package provides a `toast()` helper with a fluent or simple API.

```php
// Show a simple alert
toast()->alert('Something happened.');

// Show a success alert
toast()->success('Operation successful!');

// Show an error alert
toast()->error('Something went wrong.');

// Set a custom title and duration
toast()->success('Profile updated', 'Success', 3000);
```

### Flash Messages

Flash messages are stored in the session and displayed on the next page load. This is useful for redirects (e.g., after storing a form).

```php
// Flash a success message
toast()->flashSuccess('This will show on the next page load.');

// Flash an error
toast()->flashError('Something went wrong.');
```

Alternatively, you can use Laravel's native session helper directly:

```php
session()->flash('toast', [
    'text' => 'Your changes have been saved.',
    'heading' => 'Success', // Optional, defaults to ''
    'variant' => 'success', // Optional, defaults to 'success'
    'duration' => 6000, // Optional, defaults to 6000
]);
```

Or simply:

```php
session()->flash('toast', [
    'text' => 'Your changes have been saved.',
]);
```

To display these flash messages, you must include the package's view in your layout file (e.g., `resources/views/components/layouts/app.blade.php`), typically near where you include `<flux:toast />`.

```blade
<body>
    <!-- ... -->

    <flux:toast />
    @include('toast::partials.toast')

    @fluxScripts
</body>
```

The `@include('toast::partials.toast')` directive handles checking the session for a toast message and triggering it via Alpine.

## Requirements

- PHP 8.2+
- Laravel 12+
- Livewire 3+
- Flux Pro (Toast component is a Pro Component)

## Why this package?

Regular Flux Toast usage:

```php
Flux::toast(
    text: 'Message',
    heading: 'Title',
    variant: 'success'
);
```

This package:

```php
toast()->success('Message', 'Title');
```

The helper provides a more concise syntax for common use cases.

### Defaults

- **Duration**: By default, Flux toasts last for 5 seconds (5000ms). This package changes the default to **6 seconds (6000ms)** to give users slightly more time to read notifications. You can override this by passing a third argument to any method.
