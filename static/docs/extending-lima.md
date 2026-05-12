# Extending Lima

### Contents

- [Application structure](#application-structure)
- [Custom base controllers](#custom-base-controllers)
- [Custom views](#custom-views)
- [Runtime config](#runtime-config)
- [Using your own services](#using-your-own-services)

<a id="application-structure"></a>
### Application structure

Lima is intentionally small, so most application-specific decisions belong in your project rather than in the framework. The recommended structure from [Getting Started](/docs/getting-started) is a good default, but you can move controllers, models, and templates when a project needs something different.

Use `.env` for the paths Lima needs at boot:

```text
LIMA_CONTROLLER_PATH=Controllers
LIMA_MODEL_PATH=Models
LIMA_TEMPLATE_DIR=views
```

The controller and model paths are relative to the `app` folder. The template directory is relative to your project root.

<a id="custom-base-controllers"></a>
### Custom base controllers

One of the easiest ways to extend Lima is to create a controller that your application controls.

```php
use Lima\Core\Controller;

class AppController extends Controller
{
    protected function sharedViewData(): array
    {
        return [
            'siteName' => 'My Lima App',
        ];
    }

    protected function render($template, array $data = []): bool
    {
        return $this->view($template, array_merge($this->sharedViewData(), $data));
    }
}
```

Then extend it in your controllers:

```php
class Home extends AppController
{
    public function index(): void
    {
        $this->render('home');
    }
}
```

This is a practical place for authentication checks, shared view data, redirects, or service access.

<a id="custom-views"></a>
### Custom views

Lima's view object can be replaced through `system/overrides.php`.

```php
<?php

$overrides = [
    'View' => App\Support\AppView::class,
];
```

Your custom view can extend the core view and add helpers used across templates.

```php
namespace App\Support;

class AppView extends \Lima\Core\View
{
    public function asset(string $path): string
    {
        return '/assets/' . ltrim($path, '/');
    }
}
```

After this, `$view` inside your PHP templates will be an instance of your custom class.

```php
<link rel="stylesheet" href="<?php echo $view->asset('css/style.css'); ?>">
```

<a id="runtime-config"></a>
### Runtime config

The `Lima\Core\Config` class provides a small in-memory config store.

```php
use Lima\Core\Config;

Config::set('site.name', 'My Lima App');

$name = Config::get('site.name');
```

This is useful for values built at runtime, feature flags, or application settings that you don't want to pass through every method call. For sensitive values and deployment-specific settings, keep using `.env`.

<a id="using-your-own-services"></a>
### Using your own services

Lima doesn't force a service container or application layer on you. For small projects, creating services directly in a controller can be enough.

```php
class Newsletter extends \Lima\Core\Controller
{
    public function subscribe(): void
    {
        $service = new NewsletterService();
        $service->subscribe($_POST['email'] ?? '');

        $this->view('newsletter/thanks');
    }
}
```

For larger projects, build a small application layer of your own and call it from controllers. This keeps controllers thin while leaving Lima's core untouched.

```php
class Account extends AppController
{
    public function update(): void
    {
        $this->accounts->updateProfile($_POST);

        header('Location: /account');
        exit;
    }
}
```

The important idea is to let Lima handle the request flow, then keep your business logic in classes that make sense for your project.

### What to read next

If you're extending the framework around request handling, read [Routing](/docs/routing) and [Controllers and Views](/docs/controllers-and-views). If you're extending data behaviour, read [Models and Database](/docs/models-and-database).
