=== URL Path Auto ===
Contributors: hallowichig0
Tags: admin, administration, comment, comments, content, contents, excerpt, excerpts, feed, feeds, html, multisite, page, pages, plugin, plugins, post, posts, template, templates, text, title, wp_make_link_relative, widget, widgets, wpmu, writing
Requires at least: 3.8
Tested up to: 5.5
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

URL Path Auto applies wp_make_link_relative function to links to convert them to relative URLs.

== Description ==

URL Path Auto applies the `wp_make_link_relative` function to links (posts, categories, pages, etc.) to convert them to relative URLs. Useful for developers when debugging local WordPress instance on a mobile device (iPad, iPhone, etc.).

**Notice**: This plugin SHOULD be used for local development only. I haven't tested on a production environment; it **may** work with some issues, like unwanted URLs in RSS feed or sharing URLs are replaced with relative URLs, etc.

For example:

`http://localhost:8080/wp/`

Will be converted to:

`/wp/`

And..

`http://localhost:8080/wp/2012/09/01/hello-world/`

Will be converted to:

`/wp/2012/09/01/hello-world/`

And..

`http://localhost:8080/wp/wp-content/themes/twentyeleven/style.css`

Will be converted to:

`/wp/wp-content/themes/twentyeleven/style.css`

Then after activating this plugin, you can simply access your local instance using `http://10.0.1.5:8888/wp/` on your iPad or other mobile devices without having styles and navigation issue.

== Installation ==

WordPress (Also works on multisite enabled instance):

1. Copy the `url-path-auto` folder into your `wp-content/plugins` folder
2. Activate the url-path-auto plugin via the plugins admin page

== Frequently Asked Questions ==

= What if I deactivate this plugin? =

The URLs will be changed back to absolute URLs again, there's no database writes with this plugin.

= Why this plugin is not recommend for production environment? =

URLs in RSS feed are also replaced to relative URLs with this plugin, this could causes some issues for RSS readers that they will be confused for URLs without host. Shared URLs (ie Jetpack Sharing module) are also replaced to related URLs, Twitter, Facebook or other social sites won't treat them as valid URLs.

== Changelog ==
= 1.0.0 =
* Initial Release.

= 1.0.1 =
* Added license.
* Change composer licence to GPLv2.
