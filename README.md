<h1 align="center">Laratron</h1>
<p align="center">
🖼Laravel SSR using Rendertron 🖼
</p>
<p align="center">
<img src="https://img.shields.io/packagist/vpre/sandulat/laratron.svg">
<img src="https://img.shields.io/github/license/sandulat/laratron.svg">
<a href="https://twitter.com/intent/follow?screen_name=sandulat">
  <img src="https://img.shields.io/twitter/follow/sandulat.svg?style=social">
</a>
<p>

## About

Since we know that not all crawlers can render Javascript, we have to implement SSR (Server-Side Rendering). Implementing SSR in Laravel may be a headache and the easiest solution could be [Rendertron](https://github.com/GoogleChrome/rendertron).

**Laratron** is a tiny middleware for your Laravel app that detects whether the visitor is a crawler and passes the request to Rendertron.

About Rendertron (from official Readme):
> Rendertron is designed to enable your Progressive Web App (PWA) to serve the correct content to any bot that doesn't render or execute JavaScript. Rendertron runs as a standalone HTTP server. Rendertron renders requested pages using Headless Chrome, auto-detecting when your PWA has completed loading and serializes the response back to the original request. To use Rendertron, your application configures middleware to determine whether to proxy a request to Rendertron. Rendertron is compatible with all client side technologies, including web components.

## Installation
First of all we need to install Rendertron. Please consult the [official documentation](https://github.com/GoogleChrome/rendertron) for more info.
To install Laratron run this inside your project:
```bash
composer require sandulat/laratron
```

## Configuration
Laratron exposes only one simple option, the URL of Rendertron, which can be set in your env file:
```bash
RENDERTRON_URL=http://localhost:3000
```

## Usage
After installation you can use the middleware **`laratron`** on any route that you'd like to be server-side rendered.

```php
Route::get('/', function () {
    return view('home');
})->middleware('laratron');
```

Or you can apply it on the entire `web` middleware group in `App\Http\Kernel`:
```php
'web' => [
    // ...
    \Sandulat\Laratron\Http\Middleware\LaratronMiddleware::class,
],
```

## Credits

Created by [Stratulat Alexandru](https://twitter.com/sandulat).

<a href="https://coltorapps.com/">
  <img src="https://coltorapps.com/images/logo_transparent.png" width="150px">
</a>
