# Getting Started

### Installing Lima

Lima is available as a composer package and can be installed via the regular require command:

```bash
composer require spacecow/lima-mvc
```

From there you'll need to follow the setup below:

### Enabling & Using Lima

To enable Lima within your project, you'll need create a new instance of the Lima App and run it. Within your project's public folder create a file called index.php with the following code:

```php
<?php

use Lima\Core\App;

require_once __DIR__ . '/../vendor/autoload.php';

App::Run(realpath(__DIR__ . '/../'));
```

The above code assumes your public folder is in the root of your project. If not, you'll need to adjust the path so that it points to your project root. The path variable is the first parameter of the Run method. Setting the root is key so that Lima's internal includes and file routing will function correctly.

In addition to the index.php file, you'll also need to ensure the web server routes all requests to Lima. Create a .htaccess file in your public folder with the following:

```
# Prevent Directoy listing and browsing
Options +FollowSymLinks -MultiViews
Options -Indexes

# Prevent Direct Access to files
<FilesMatch "(?i)((\.tpl|\.ini|\.log|(?<!robots)\.txt))">
    Require all denied
</FilesMatch>

# Enable rewrites
RewriteEngine on
RewriteBase /

# Redirect trailing slashes (preserving request method)
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_URI} (.+)/$
RewriteRule ^ %1 [L,R=308]

# Rewrite everything except for assets to index.php
RewriteCond %{ENV:REDIRECT_STATUS} ^$
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-l
RewriteCond %{REQUEST_URI} !.*\.(ico|gif|jpg|jpeg|png|js|css|svg)
RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
```

Now all requests will be directed to Lima except for any static assets that match the given file extensions. Of course, please adjust this as you need. The index.php rewrite is the most important rule, without this, Lima cannot function.

### Recommended Folder Structure

While Lima doesn't require any specific structure _(that's the beauty of it)_, it is recommend to follow a folder structure similar to the following:

```
project-root
├── app
│   ├── Controller
│   ├── Model
├── public
│   ├── .htaccess
│   ├── assets
│   └── index.php
├── vendor
├── views
└── composer.json
```

This will work out of the box and is very typical of an MVC system and should be familiar to anyone who has worked with Laravel or CodeIgniter.

Should you wish to use a complete custom structure, you will need to set the appropriate variables within your .env file. See the [Environment Variables](configuration.md?id=environment-variables) page for more information.
