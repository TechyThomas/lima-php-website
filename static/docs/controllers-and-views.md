# Controllers and Views

### Contents

- [Controllers](#controllers)
- [Passing URL parameters](#passing-url-parameters)
- [PHP views](#php-views)
- [Template folders](#template-folders)
- [Twig support](#twig-support)
- [Extending controllers](#extending-controllers)

<a id="controllers"></a>
### Controllers

Controllers are the entry point for your application logic. A controller receives the request from the router, prepares any data needed by the page, and returns a view.

```php
use Lima\Core\Controller;

class Home extends Controller
{
    public function index(): void
    {
        $this->view('home', [
            'pageTitle' => 'Welcome to Lima',
        ]);
    }
}
```

The first argument passed to `view()` is the template name. The second argument is an array of data that should be available inside the view.

<a id="passing-url-parameters"></a>
### Passing URL parameters

Any remaining URL parts are passed into the controller method as parameters.

```text
/posts/show/12
```

```php
class Posts extends \Lima\Core\Controller
{
    public function show($id): void
    {
        $this->view('posts/show', [
            'postId' => $id,
        ]);
    }
}
```

This keeps simple pages simple, while still giving advanced developers enough room to build their own request and service layers around Lima's controller flow.

<a id="php-views"></a>
### PHP views

By default, Lima looks for templates in the `views` directory at the root of your project. You can change this with `LIMA_TEMPLATE_DIR` in your `.env` file.

```php
<h1><?php echo $pageTitle; ?></h1>
```

When rendering a PHP view, Lima extracts the data array into local variables. It also provides a `$view` object, which can be used to render shared templates.

```php
<?php $view->get_header(); ?>

<main>
    <h1><?php echo $pageTitle; ?></h1>
</main>

<?php $view->get_footer(); ?>
```

<a id="template-folders"></a>
### Template folders

Nested templates can be rendered using a path style name.

```php
$this->view('posts/show', [
    'post' => $post,
]);
```

This will load:

```text
views/posts/show.php
```

The helper methods `get_header()` and `get_footer()` load `_templates/header.php` and `_templates/footer.php`.

<a id="twig-support"></a>
### Twig support

Lima can render Twig templates when Twig is installed in the project.

```bash
composer require twig/twig
```

If the Twig classes are available, Lima will use Twig's filesystem loader and render the requested template from your template directory.

```php
class Home extends \Lima\Core\Controller
{
    public function index(): void
    {
        $this->view('home', [
            'name' => 'Lima',
        ]);
    }
}
```

```twig
<h1>Hello {{ name }}</h1>
```

Lima keeps the same controller API whether you're using PHP templates or Twig, so teams can choose the template layer that fits the project.

<a id="extending-controllers"></a>
### Extending controllers

For larger projects, it is common to create your own base controller.

```php
use Lima\Core\Controller;

class AppController extends Controller
{
    protected function requireLogin(): void
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
    }
}
```

Your application controllers can then extend `AppController` instead of the Lima controller directly.

```php
class Account extends AppController
{
    public function index(): void
    {
        $this->requireLogin();
        $this->view('account/index');
    }
}
```

This is a good place for authentication checks, shared layout data, or helpers that should be available across a group of controllers.

### What to read next

Read [Routing](/docs/routing) for more on how controllers are found, or [Models and Database](/docs/models-and-database) when you're ready to load data for your views.
