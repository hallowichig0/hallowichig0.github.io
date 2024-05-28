# [Sage](https://roots.io/sage/)

Sage is a WordPress starter theme with a modern development workflow.

## Features

* Sass for stylesheets
* Modern JavaScript
* [Bud](https://bud.js.org/) for compiling assets and concatenating and minifying files
* [Browsersync](http://www.browsersync.io/) for synchronized browser testing
* [Blade](https://laravel.com/docs/5.8/blade) as a templating engine
* [Bootstrap 5](https://getbootstrap.com/)

See a working example at [roots-example-project.com](https://roots-example-project.com/).

## Requirements

Make sure all dependencies have been installed before moving on:

* [WordPress](https://wordpress.org/) >= 5.x
* [PHP](https://secure.php.net/manual/en/install.php) >= 8.0 (with [`php-mbstring`](https://secure.php.net/manual/en/book.mbstring.php) enabled)
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 16.0.0
* [Yarn](https://yarnpkg.com/en/docs/install)

## Theme installation
```
NOTE: before running the installation, please make sure to follow the requirements above.
```

1. Clone the theme repository inside the wp-content/theme directory
2. Delete the `.git` folder inside the `sage-theme` theme folder.
3. Use `composer install` inside the `sage-theme` theme folder.
4. Use `yarn` to install the node modules.
5. Install Kirki plugin
6. Install ACF Pro plugin

During theme installation you will have options to update `style.css` theme headers, select a CSS framework, and configure Browsersync.

## Theme structure

```sh
themes/your-theme-name/   # → Root of your Sage based theme
├── app/                  # → Theme PHP
│   ├── Providers/        # → Service providers
│   ├── View/             # → View models
│   ├── filters.php       # → Theme filters
│   └── setup.php         # → Theme setup
├── composer.json         # → Autoloading for `app/` files
├── public/               # → Built theme assets (never edit)
├── functions.php         # → Theme bootloader
├── index.php             # → Theme template wrapper
├── node_modules/         # → Node.js packages (never edit)
├── package.json          # → Node.js dependencies and scripts
├── resources/            # → Theme assets and templates
│   ├── fonts/            # → Theme fonts
│   ├── images/           # → Theme images
│   ├── scripts/          # → Theme javascript
│   ├── styles/           # → Theme stylesheets
│   └── views/            # → Theme templates
│       ├── components/   # → Component templates
│       ├── forms/        # → Form templates
│       ├── layouts/      # → Base templates
│       ├── partials/     # → Partial templates
        └── sections/     # → Section templates
├── screenshot.png        # → Theme screenshot for WP admin
├── style.css             # → Theme meta information
├── vendor/               # → Composer packages (never edit)
└── bud.config.js         # → Bud configuration
```

## Theme setup

Edit `app/setup.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, and sidebars.

## Theme development

* Run `yarn` from the theme directory to install dependencies
* Update `.proxy` & `.serve` with your local dev URL in `bud.config.js`

### Build commands

* `yarn dev` — Compile assets when file changes are made, start Browsersync session
* `yarn dev --help` — To see the list of option (Ex. --flush for clearing cache)
* `yarn build` — Compile assets for production
* `yarn build --help` — To see the list of option (Ex. --flush for clearing cache)

## Documentation

* [Sage documentation](https://roots.io/sage/docs/)
