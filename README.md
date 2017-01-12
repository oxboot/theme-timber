# [Oxboot](http://oxboot.com/)

Oxboot is a WordPress starter theme with a modern development workflow.

## Features

* Sass for stylesheets
* ES6 for JavaScript
* [Laravel Elixir](https://github.com/laravel/elixir) for compiling assets, concatenating and minifying files
* [Bootstrap 4](http://getbootstrap.com/) for a front-end framework (can be removed or replaced)
* [Twig](http://twig.sensiolabs.org/) as a templating engine

## Requirements

Make sure all dependencies have been installed before moving on:

* [PHP](http://php.net/manual/en/install.php) >= 5.6.4
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 6.9.x

## Theme installation

Install Oxboot using Composer from your WordPress themes directory (replace `your-theme-name` below with the name of your theme):

```shell
# @ app/themes/ or wp-content/themes/
$ composer create-project oxboot/oxboot your-theme-name dev-master
```

Navigate to the theme directory then run `npm install`:

```shell
# @ example.com/site/web/app/themes/your-theme-name
$ npm install
```

You now have all the necessary dependencies to run the build process.

### Build commands

* `gulp` — Compile assets and stop
* `gulp vendor` — Copy vendor assets into public directory and stop
* `gulp watch` — Compile and watch the files changes
* `gulp --production` — Compile assets for production

## Contributing

Contributions are welcome from everyone.
