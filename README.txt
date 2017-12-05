=== Wordpress Ajaxifier ===
Contributors: eruecco87
Donate link: http://example.com/
Tags: ajax, ajax loader, wordpress ajax loader
Requires at least: 4.9
Tested up to: 4.9
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Wordpress ajax page loader.

== Description ==

Wordpress Ajaxifier will enable all links referencing pages within the site itself to load the page asynchronously without a page refresh.


== Installation ==

1. Upload `wordpress-ajaxifier` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Update the configuration options under "WP Ajaxifier" admin menu.


== Configuration Options ==

= Main Container Selector =
The id of the main container element (if none is provided the plugin will look for an id of "main" by default).

= Navigation Selector =
The id of the main navigation container (if none is provided the plugin will look for an id of "nav" by default).

= Search Form Selector =
The id of the main search form (if none is provided the plugin will look for an id of "search-form" by default).

= Manual Selectors =
All links matching or inside this selectors WILL trigger an ajax load. This is for selectors outside the Main Container or elements added dynamically after page load.

= Excluded Selectors =
All links matching or inside this selectors will NOT trigger an ajax load. These selectors work as normal links, they will trigger a page refresh.

= Loader Image =
The image used for loading icon when a page is being requested (Default, Spinner, Ripple, Gear or Facebook).

= Loader Markup =
Custom markup to insert as a loading icon, this will override the "Loader Image" option.

= Scroll Top =
The content will scroll back to the top once its loaded.

= Transition Effect =
The content will fade in once its loaded.

= Console Logs =
Show console logs in the browser's Dev Tools (Displays information about the javascript used to handle the ajax requests).


== A note on Javascript event handlers ==

Assuming that your Wordpress theme uses jQuery, some event handlers such as 'click', 'change', 'submit', etc might not bind to the DOM once the page is loaded.

To prevent this, the recommended way to attach a handler is to first remove any binding of the function to prevent duplicated event triggering
and then use the ".on()" method with a delegated selector.

`
function clickHandlerFunction(event) {

    event.preventDefault();

    // Handler code here.

}

$(document).off('click', clickHandlerFunction).on('click', '.element-class', clickHandlerFunction);
`


== Changelog ==

= 1.0 =
* Initial Release.