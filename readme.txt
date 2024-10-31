=== Search & Index Page Content ===
Contributors: adaldesign
Donate link: http://adaldesign.com/2014/01/search-index-page-content/
Tags: cms, content, link, navigation, page, Post, scroll, search, sidebar, text
Requires at least: 3.6
Tested up to: 4.0
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides a sidebar widget that indexes and links to the headers in the content of any page/post and allows users to perform on-page search.

== Description ==

If you are looking for a simple way to **index the content of a long WordPress page or post**, this plugin is your ticket. 

Just like the "Content" quick-links on the right of every WordPress.org Codex page, this widget will automatically create a list of links to each header in the content of the pages you wish to index. You don't need to create any anchor links for this to work.

By default, it also includes an on-page search form so that users can easily find anything on the page that is indexed.

The plugin is extremely light, unobtrusive and easy to use. It will only show up on sidebars of pages in which you use the [SIPC_Content] shortcode. This plugin will load jquery on pages that use the shortcode if you theme doesn't already.

[See a live demo here](http://test.adalclients.wpengine.com/sipc-demo/ "Click here for a live demo.")

= Suggested Uses =

* Create simple FAQ pages without complex use of Custom Post Types.
* Make your long posts easier to reference.
* Leave a review to tell me how YOU used this plugin.

= Languages =

Available in Spanish and Serbian.


== Installation ==

1. Upload the **search-index-page-content** folder to the **/wp-content/plugins/** directory, or simply find and install it in WordPress under Plugins > Add New
2. Activate the **Search & Index Page Content** plugin on the **Plugins** page in WordPress
3. Slide the new **Search & Index Page Content** widget into a sidebar and pick your options.
4. Edit the pages and posts you wish the widget to appear on by surrounding all their content with the **[SIPC_Content]** shortcode as such, and don't forget to use the closing tag **[/SIPC_Content]**

== Frequently Asked Questions ==

= I placed the widget in a sidebar but it won't show up! =

The widget is built to only show up on pages and posts for which the content has been surrounded by the [SIPC_Content] opening and closing shortcode tags as seen here: 

**[SIPC_Content]**
All page / post content goes here.
Headers will be indexed and content will be searchable.
**[/SIPC_Content]**

The reason being that you most likely only have a few pages or posts that are long enough to deserve an index. Wouldn't it be annoying if this widget showed up on every page and post, even short ones with no headers?

= How does this plugin work? I used to manually create anchor links... =

The plugin basically uses jquery (javascript) to search the content surrounded by the shortcode for headers and creates the links automatically each time the page is loaded. This all happens after the page is loaded, on the client side. The benefits are obvious: you no longer need to worry about updating anchor links manually, users get to reference long pages easily and the server doesn't do any extra work.

== Screenshots ==

1. By default, the widget shows a contextual search form and index of headers on the page.
2. View of the widget options.

== Changelog ==

= 1.4 =
* Now includes translation in Spanish provided by Andrew Kurtis at http://WebHostingHub.com/

= 1.3 =
* Now includes translation in Serbian provided by Ogi Djuraskovic at http://FirstSiteGuide.com/

= 1.2 =
* Added Localization and .pot file to enable translations

= 1.1 =
* Bug fix of scrollTo

= 1.0 =
* Initial realease of the plugin
* Currently uses widget only, shortcode will be included in next version.
