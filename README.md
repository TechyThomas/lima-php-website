# Lima Website

This repository contains the code behind the Lima website.

The site is powered by [Lima MVC](https://github.com/TechyThomas/lima-mvc), a small PHP MVC framework. It uses Lima for routing, controllers, views, and the documentation pages that live under `/docs`.

The public website assets are served from `public_html`, while source content, views, and build files live in the project folders around it.

## Build assets

Frontend assets are built with Sass and Webpack:

```bash
npm install
npm run build
```

Composer dependencies are managed separately:

```bash
composer install
```
