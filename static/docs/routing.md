# Routing

### Contents

- [How routing works](#how-routing-works)
- [The routes file](#the-routes-file)
- [Namespaced routes](#namespaced-routes)
- [Fixed controllers and methods](#fixed-controllers-and-methods)
  <!-- - [Custom 404 pages](#custom-404-pages) -->
- [Current route details](#current-route-details)

<a id="how-routing-works"></a>

### How routing works

Lima keeps routing deliberately simple. Requests are sent to your public `index.php` file, Lima reads the `url` query parameter, and the router maps that URL to a controller method.

For example, a request to:

```text
/blog/view/15
```

will look for a `Blog` controller, call the `view` method, and pass `15` as the first method parameter.

```php
class Blog extends \Lima\Core\Controller
{
    public function view($id): void
    {
        $this->view('blog/view', [
            'id' => $id,
        ]);
    }
}
```

Lima also converts hyphenated controller names to class style names. A URL like `/user-profile` maps to a `UserProfile` controller, while hyphenated method names are converted to underscores. A URL like `/account/reset-password` maps to `reset_password`.

<a id="the-routes-file"></a>

### The routes file

Routes are registered in `system/routes.php`. This file should define a `$routes` array.

```php
<?php

$routes = [
    '*' => ['namespace' => 'App\Controllers'],
];
```

The wildcard route is the most common starting point. It tells Lima which namespace to use when matching normal controller requests.

<a id="namespaced-routes"></a>

### Namespaced routes

You can also register a named route prefix. This is useful when your application has a section of controllers that should live under a different namespace.

```php
$routes = [
    'admin' => ['namespace' => 'App\Controllers\Admin'],
    '*' => ['namespace' => 'App\Controllers'],
];
```

With this route in place, `/admin/users/edit/4` will resolve inside the admin namespace and pass `4` through as a parameter.

<a id="fixed-controllers-and-methods"></a>

### Fixed controllers and methods

A route can define a controller and method directly. This is useful for landing pages, dashboards, or sections where you want the URL to stay friendly without mirroring the class name.

```php
$routes = [
    'dashboard' => [
        'namespace' => 'App\Controllers',
        'controller' => 'Account',
        'method' => 'dashboard',
    ],
];
```

Now `/dashboard` will call `Account::dashboard()`.

<!-- <a id="custom-404-pages"></a>
### Custom 404 pages

You can define a custom 404 route using the `404` key.

```php
$routes = [
    '404' => [
        'namespace' => 'App\Controllers',
        'controller' => 'Errors',
        'method' => 'notFound',
    ],
    '*' => ['namespace' => 'App\Controllers'],
];
```

If Lima cannot find a controller or method, it will set the response code to `404` and call the route above. If no custom 404 route is available, Lima will output a simple `404 Not Found` response. -->

<a id="current-route-details"></a>

### Current route details

The router stores the current controller and method after a request has been matched.

```php
use Lima\Routing\Router;

$router = Router::Instance();

$controller = $router->getCurrentController();
$method = $router->getCurrentMethod();
```

This is mostly useful in shared layout code, navigation, or debugging tools where you need to know what part of the application is currently being handled.

### What to read next

Once you have routing in place, read [Controllers and Views](/docs/controllers-and-views) to see how requests render templates, or [Configuration](/docs/configuration) if your folders don't match the default structure.
