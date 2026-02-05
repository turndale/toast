# Toast

A Laravel Package for Flux Toast integration.

This package provides a wrapper around [Livewire Flux](https://fluxui.dev) Toasts to simplify their usage and parameter arrangement, and adds support for flash messages using Laravel sessions.

## Installation

You can install the package via composer:

```bash
composer require turndale/toast
```

## Setup

Add the toast partial to your layout file (e.g., `resources/views/components/layouts/app.blade.php`).

**Important:** The `@include('toast::partials.toast')` must be placed **after** `@fluxScripts` because it uses the `$flux.toast()` function which is only available after Flux scripts are loaded.

```blade
<body>
    <!-- Your content -->

    <flux:toast />

    @fluxScripts
    @include('toast::partials.toast')
</body>
```

## Usage

### Quick Reference

| Method | Use Case | When Toast Shows |
|--------|----------|------------------|
| `toast()->success()` | Livewire components | Immediately |
| `toast()->flashSuccess()` | After redirect | Next page load |
| `session()->flash('success', 'msg')` | After redirect | Next page load |
| `redirect()->with('success', 'msg')` | After redirect | Next page load |
| `toast()->sessionSuccess()` | Same page alert | Current page |

---

## Instant Toasts (Same Page)

These methods show a toast immediately on the current page. Use these in Livewire components or anywhere you don't need a redirect.

### `alert()`

Show a simple alert toast.

```php
toast()->alert('Something happened.');
toast()->alert('Something happened.', 'Notice');
toast()->alert('Something happened.', 'Notice', 3000);
```

**Signature:** `alert(string $message = '', string $title = '', int $duration = 6000): void`

---

### `success()`

Show a success toast.

```php
toast()->success('Operation completed successfully!');
toast()->success('Profile updated', 'Success');
toast()->success('Profile updated', 'Success', 3000);
```

**Signature:** `success(string $message = '', string $title = '', int $duration = 6000): void`

---

### `error()`

Show an error toast.

```php
toast()->error('Something went wrong.');
toast()->error('Failed to save', 'Error');
toast()->error('Failed to save', 'Error', 8000);
```

**Signature:** `error(string $message = '', string $title = '', int $duration = 6000): void`

---

### `warning()`

Show a warning toast.

```php
toast()->warning('Please review your input.');
toast()->warning('Unsaved changes', 'Warning');
toast()->warning('Unsaved changes', 'Warning', 5000);
```

**Signature:** `warning(string $message = '', string $title = '', int $duration = 6000): void`

---

### `server()`

Show a server error toast with sensible defaults.

```php
toast()->server(); // "Try again later or contact support" with title "Something went wrong"
toast()->server('Custom error message');
toast()->server('Custom message', 'Custom Title');
toast()->server('Custom message', 'Custom Title', 'warning', 8000);
```

**Signature:** `server(string $message = 'Try again later or contact support', string $title = 'Something went wrong', string $type = 'danger', int $duration = 6000): void`

---

### `invalid()`

Show a validation error toast with sensible defaults.

```php
toast()->invalid(); // "Check form for validation errors"
toast()->invalid('Please fix the errors below.');
toast()->invalid('Please fix the errors', 'Validation Error');
```

**Signature:** `invalid(string $message = 'Check form for validation errors', string $title = '', string $type = 'danger', int $duration = 6000): void`

---

## Flash Toasts (After Redirect)

Flash messages are stored in the session and displayed on the next page load. Use these when redirecting after form submissions.

### Using Toast Helper Methods

#### `flash()`

Flash a basic toast message.

```php
toast()->flash('Your session has been updated.');
toast()->flash('Your session has been updated.', 'Notice');
toast()->flash('Your session has been updated.', 'Notice', 3000);

return redirect()->route('dashboard');
```

**Signature:** `flash(string $message = '', string $title = '', int $duration = 6000): void`

---

#### `flashSuccess()`

Flash a success toast message.

```php
toast()->flashSuccess('Your changes have been saved.');
toast()->flashSuccess('Profile updated successfully!', 'Success');
toast()->flashSuccess('Done!', 'Success', 3000);

return redirect()->route('profile');
```

**Signature:** `flashSuccess(string $message = '', string $title = '', int $duration = 6000): void`

---

#### `flashError()`

Flash an error toast message.

```php
toast()->flashError('Something went wrong.');
toast()->flashError('Failed to process request.', 'Error');
toast()->flashError('Please try again.', 'Error', 8000);

return redirect()->back();
```

**Signature:** `flashError(string $message = '', string $title = '', int $duration = 6000): void`

---

#### `flashWarning()`

Flash a warning toast message.

```php
toast()->flashWarning('Please review your input.');
toast()->flashWarning('Some fields are missing.', 'Warning');
toast()->flashWarning('Incomplete data.', 'Warning', 5000);

return redirect()->back();
```

**Signature:** `flashWarning(string $message = '', string $title = '', int $duration = 6000): void`

---

#### `flashInfo()`

Flash an info toast message.

```php
toast()->flashInfo('New features are available.');
toast()->flashInfo('Check out our latest updates.', 'Info');
toast()->flashInfo('Version 2.0 released!', 'Info', 5000);

return redirect()->route('home');
```

**Signature:** `flashInfo(string $message = '', string $title = '', int $duration = 6000): void`

---

#### `flashServer()`

Flash a server error toast with sensible defaults.

```php
toast()->flashServer(); // "Something went wrong, please try again later or contact support"
toast()->flashServer('Unable to connect to server.');
toast()->flashServer('Service unavailable.', 'Server Error');

return redirect()->back();
```

**Signature:** `flashServer(string $message = 'Something went wrong, please try again later or contact support', string $title = '', int $duration = 6000): void`

---

### Using Laravel's Native Session

The package also supports Laravel's familiar session patterns. These are great for simple messages.

#### Using `session()->flash()`

```php
session()->flash('success', 'Your changes have been saved.');
session()->flash('error', 'Something went wrong.');
session()->flash('warning', 'Please review your input.');
session()->flash('info', 'New updates available.');

return redirect()->route('dashboard');
```

#### Using `->with()` on Redirects

```php
return redirect()->route('dashboard')->with('success', 'Profile updated!');
return redirect()->back()->with('error', 'Invalid credentials.');
return redirect()->route('home')->with('warning', 'Session expiring soon.');
return redirect()->route('news')->with('info', 'New features available!');
```

#### Simple Flash Helpers

These are convenience wrappers around `session()->flash()`:

```php
toast()->simpleFlashSuccess('Your changes have been saved.');
toast()->simpleFlashError('Something went wrong.');
toast()->simpleFlashWarning('Please review your input.');
toast()->simpleFlashInfo('New updates available.');
toast()->simpleFlash('success', 'Generic flash message.');

return redirect()->route('dashboard');
```

| Method | Signature |
|--------|-----------|
| `simpleFlash()` | `simpleFlash(string $type, string $message): void` |
| `simpleFlashSuccess()` | `simpleFlashSuccess(string $message): void` |
| `simpleFlashError()` | `simpleFlashError(string $message): void` |
| `simpleFlashWarning()` | `simpleFlashWarning(string $message): void` |
| `simpleFlashInfo()` | `simpleFlashInfo(string $message): void` |

---

### Full Control with Array Syntax

For more control over the toast (custom heading, duration, variant), use the array syntax:

```php
session()->flash('toast', [
    'text' => 'Your changes have been saved.',
    'heading' => 'Success',        // Optional, defaults to ''
    'variant' => 'success',        // Optional: 'success', 'danger', 'warning'
    'duration' => 6000,            // Optional, defaults to 6000
]);

return redirect()->route('dashboard');
```

Or with redirect's `->with()`:

```php
return redirect()->route('dashboard')->with('toast', [
    'text' => 'Welcome back!',
    'heading' => 'Hello',
    'variant' => 'success',
    'duration' => 3000,
]);
```

---

## Same-Page Session Alerts

For alerts on the same page without redirect, you can store messages in the session. These persist until manually cleared or page refresh.

### Using Toast Helper

```php
toast()->sessionSuccess('Record saved successfully.');
toast()->sessionError('Failed to load data.');
toast()->sessionWarning('Connection unstable.');
toast()->sessionInfo('Background sync in progress.');
```

| Method | Signature |
|--------|-----------|
| `sessionSuccess()` | `sessionSuccess(string $message): void` |
| `sessionError()` | `sessionError(string $message): void` |
| `sessionWarning()` | `sessionWarning(string $message): void` |
| `sessionInfo()` | `sessionInfo(string $message): void` |

### Using Laravel's Native Session

```php
session(['success' => 'Record saved successfully.']);
session(['error' => 'Failed to load data.']);
session(['warning' => 'Connection unstable.']);
session(['info' => 'Background sync in progress.']);
```

> **Note:** Same-page session alerts persist until manually cleared or page refresh. For redirects, use flash messages instead.

---

## Supported Variants

| Variant | Toast Helper | Session Key |
|---------|--------------|-------------|
| Default | `alert()` | - |
| Success | `success()`, `flashSuccess()` | `success` |
| Error/Danger | `error()`, `flashError()` | `error` |
| Warning | `warning()`, `flashWarning()`, `flashInfo()` | `warning`, `info` |

> **Note:** Flux only supports `success`, `warning`, and `danger` variants. The `info` methods and session key are provided for convenience and map to the `warning` variant.

---

## Requirements

- PHP 8.2+
- Laravel 12+
- Livewire 3+
- Flux Pro (Toast component is a Pro Component)

---

## Why This Package?

Regular Flux Toast usage requires named arguments:

```php
Flux::toast(
    text: 'Your profile has been updated.',
    heading: 'Success',
    variant: 'success',
    duration: 6000
);
```

This package simplifies it to:

```php
toast()->success('Your profile has been updated.', 'Success');
```

And for redirects:

```php
// Before (manual)
session()->flash('toast', [
    'text' => 'Profile updated!',
    'variant' => 'success',
]);
return redirect()->route('profile');

// After (with this package)
toast()->flashSuccess('Profile updated!');
return redirect()->route('profile');

// Or even simpler
return redirect()->route('profile')->with('success', 'Profile updated!');
```

---

## Defaults

- **Duration**: By default, Flux toasts last for 5 seconds (5000ms). This package changes the default to **6 seconds (6000ms)** to give users slightly more time to read notifications. You can override this by passing a duration argument to any method that supports it.
