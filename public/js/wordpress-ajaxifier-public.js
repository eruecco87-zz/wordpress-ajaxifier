$(document).ready(function() {

  (function($, window, undefined) {

    "use strict";

    var WPAjaxifier = window.WPAjaxifier = window.WPAjaxifier || {},
				document = window.document,
      	History = window.History;

    WPAjaxifier.Utilities = (function() {

      return {

        log: function() {

          if (wordpress_ajaxifier_localized_data['consoleLogs'] === 'on') {

            console.log.apply(console, arguments);

					}

        },

        error: function() {

          if (wordpress_ajaxifier_localized_data['consoleLogs'] === 'on') {

            console.error.apply(console, arguments);

          }

        },

        warn: function() {

          if (wordpress_ajaxifier_localized_data['consoleLogs'] === 'on') {

            console.warn.apply(console, arguments);

          }

        },

				getUrl: function () {

        	return wordpress_ajaxifier_localized_data['url'];

        },

				documentHtmlParser: function(html) {

          var result = String(html).replace(/<\!DOCTYPE[^>]*>/i, '')
            .replace(/<(html|head|body|title|script)([\s\>])/gi,'<div id="document-$1"$2')
            .replace(/<\/(html|head|body|title|script)\>/gi,'</div>');

          return result;

        },

				generateSelectorsArray: function(selectors) {

        	return selectors.split(", ");

				}

      };

		}());

    WPAjaxifier.Main = (function() {

    	// jQuery Elements
    	var $body = $('body'),
					$content = $(`#${wordpress_ajaxifier_localized_data['mainSelector'] ? wordpress_ajaxifier_localized_data['mainSelector'] : 'main'}`),
					$navigation = $(`#${wordpress_ajaxifier_localized_data['navigationSelector'] ? wordpress_ajaxifier_localized_data['navigationSelector'] : 'nav'}`);

    	// Private Methods
      function createInternalPseudoSelector() {

        $.expr[':'].internal = function(obj, index, meta, stack){

          var $this = $(obj),
            url = $this.attr('href')||'',
            isInternalLink;

          isInternalLink = url.substring(0,WPAjaxifier.Utilities.getUrl().length) === WPAjaxifier.Utilities.getUrl() || url.indexOf(':') === -1;

          return isInternalLink;

        };

      }

      function createjQueryPlugin() {

        $.fn.WPAjaxifier = function(){

          var $this = $(this),
							selectorsAttached = [
                'a:internal:not(.no-ajaxifier, [href^="#"], [href*="wp-login"], [href*="wp-admin"])',
								'.manual-ajaxifier'
							];

          function createNewState(event) {

            var $selector	= $(this),
								url = $selector.attr('href'),
								title = $selector.attr('title') || null;

            // Continue as normal for cmd clicks etc
            if ( event.which == 2 || event.metaKey ) return true;

            event.preventDefault();

            // Push a new History State
            History.pushState(null, title, url);

            return false;

          }

          $(document).off('click', createNewState).on('click', selectorsAttached[0], createNewState);
          $(document).on('click', selectorsAttached[1], createNewState);

          // Adds ajaxifier functionality to manual selectors.
          if (wordpress_ajaxifier_localized_data['manualSelectors'] !== '') {

            WPAjaxifier.Utilities
              .generateSelectorsArray(wordpress_ajaxifier_localized_data['manualSelectors'])
              .forEach(function (selector) {

                var $target = $(selector);

                if ($target.is('a')) {

                  $(document).on('click', selector, createNewState);

                } else {

                  $(document).on('click', selector + ' a', createNewState);

                }

                selectorsAttached.push(selector);

              });

          }

          WPAjaxifier.Utilities.log('Wordpress Ajaxifier Attached to selectors', selectorsAttached);

          return $this;

        };

      }

			function attachjQueryPlugin() {

        // Adds .no-ajaxifier to excluded selectors.
        if (wordpress_ajaxifier_localized_data['excludedSelectors'] !== '') {

          var selectorsExcluded = [];

          WPAjaxifier.Utilities
            .generateSelectorsArray(wordpress_ajaxifier_localized_data['excludedSelectors'])
            .forEach(function (selector) {

              var $target = $(selector);

              if ($target.is('a')) {

                $target.addClass('no-ajaxifier');

              } else {

                $target.find('a').addClass('no-ajaxifier');

              }

              selectorsExcluded.push(selector);

            });

          WPAjaxifier.Utilities.log('Wordpress Ajaxifier Excluded selectors', selectorsExcluded);

        }

        $body.WPAjaxifier();

      }

      function displayLoader() {

      	$content.html('<div id="wordpress-ajaxifier-loader-holder"></div>');

      	if (wordpress_ajaxifier_localized_data['loaderMarkup'] === '') {

          switch (wordpress_ajaxifier_localized_data['loaderImage']) {

            case 'spinner':

              $content.find('#wordpress-ajaxifier-loader-holder').html('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');

              break;

            case 'ripple':

              $content.find('#wordpress-ajaxifier-loader-holder').html('<div class="lds-ripple"><div></div><div></div></div>');

              break;

            case 'gear':

              $content.find('#wordpress-ajaxifier-loader-holder').html('<div class="lds-gear"><div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>');

              break;

            case 'facebook':

              $content.find('#wordpress-ajaxifier-loader-holder').html('<div class="lds-facebook"><div></div><div></div><div></div></div>');

              break;

            default:

              $content.find('#wordpress-ajaxifier-loader-holder').html('<div class="lds-ellipsis"><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div>');

              break;

          }

				} else {

          $content.find('#wordpress-ajaxifier-loader-holder').html(wordpress_ajaxifier_localized_data['loaderMarkup']);

        }

      }

      function initializeSearchForm($searchForm) {

        WPAjaxifier.Utilities.log('Wordpress Ajaxifier Search Form', $searchForm);

        $('body').prepend('<a href="#" id="wordpress-ajaxifier-search" class="manual-ajaxifier" style="display:none;"></a>');

        function submitWordpressAjaxifierSearch(event) {

          event.preventDefault();

          var host = $('#search-form').attr('action'),
          		post_type = $('input[name="post_type"]').val(),
          		term = $('input[name="s"]').val();

          var query = host + "?&s=" + term;

          if (post_type) {

            query += "&post_type=" + post_type;

          }

          $('#wordpress-ajaxifier-search').attr('href', query);
          $('#wordpress-ajaxifier-search').trigger('click');

        }

        $(document).off('submit', submitWordpressAjaxifierSearch)
					.on('submit', `#${wordpress_ajaxifier_localized_data['searchFormSelector'] ? wordpress_ajaxifier_localized_data['searchFormSelector'] : 'search-form'}`, submitWordpressAjaxifierSearch);

      }

      function getPageWithAjax(url) {

      	$('#wordpress-ajaxifier-search').remove();

        $.ajax({
          url: url,
          success: function(data, textStatus, jqXHR){

            var $data = $(WPAjaxifier.Utilities.documentHtmlParser(data)),
								$dataBody	= $data.find('#document-body:first ' + '#' + wordpress_ajaxifier_localized_data['mainSelector']),
								bodyClasses = $data.find('#document-body:first').attr('class'),
								contentHtml,
								$scripts,
								$menuList = $data.find('#' + wordpress_ajaxifier_localized_data['navigationSelector']);

            $('body').attr('class', bodyClasses);

            // Get the scripts
            $scripts = $dataBody.find('#document-script');
            if ( $scripts.length ) {

              $scripts.detach();

						}

            // Get the content
            contentHtml = $dataBody.html() || $data.html();

            if (!contentHtml) {

              document.location.href = url;
              return false;

            }

            // Update the content
            $content.stop(true,true);
            $content.html(contentHtml)
              .animate({
								opacity: 1,
								visibility: "visible"
              });

            // Append new menu HTML to provided selector
            $navigation.html($menuList.html());

            // Update the title
            document.title = $data.find('#document-title:first').text();

            try {

              document.getElementsByTagName('title')[0].innerHTML = document.title.replace('<','&lt;')
                .replace('>','&gt;')
                .replace(' & ',' &amp; ');

            } catch (Exception) {}

            // Add the scripts
            $scripts.each(function(script){

              var scriptText = $(this).html();

              if (scriptText !== '') {

                var scriptNode = document.createElement('script');
                scriptNode.appendChild(document.createTextNode(scriptText));
                $content.get(0).appendChild(scriptNode);

              } else {

              	$.getScript( $(this).attr('src') );

              }

            });

            $body.removeClass('loading');

            if (wordpress_ajaxifier_localized_data['scrollTop'] !== '') {

              $('html, body').animate({
                scrollTop: $content.offset().top - 1000
              }, 500);

            }

						// Handle Search Form
            var $searchForm = $content.find(`#${wordpress_ajaxifier_localized_data['searchFormSelector'] ? wordpress_ajaxifier_localized_data['searchFormSelector'] : 'search-form'}`);

            if ($searchForm.length) {

            	initializeSearchForm($searchForm);

						}

            attachjQueryPlugin();

          },
          error: function(jqXHR, textStatus, errorThrown) {

            document.location.href = url;
            return false;

          }

        });

      }

      function attachStateChangeEvent() {

        $(window).bind('statechange',function(){

          var State = History.getState(),
							url	= State.url;

          $body.addClass('loading');

          if (wordpress_ajaxifier_localized_data['effect'] !== '') {

            $content.animate({
							opacity: 0
						}, 4000);

          }

          if (wordpress_ajaxifier_localized_data['scrollTop'] !== '') {

            $('html, body').animate({
              scrollTop: $content.offset().top - 1000
            }, 500);

          }

					displayLoader();
					getPageWithAjax(url);

        });

      }

      return {

        init: function () {

          WPAjaxifier.Utilities.log('Wordpress Ajaxifier Init');

          if ($content.length) {

            WPAjaxifier.Utilities.log('Wordpress Ajaxifier Main', $content);

          } else {

            WPAjaxifier.Utilities.error(`Wordpress Ajaxifier cannot find the main container with the provided id ${wordpress_ajaxifier_localized_data['mainSelector'] ?  wordpress_ajaxifier_localized_data['mainSelector'] : '"main"'}. Add the main container id in the settings to have a working ajax page loader`);

					}

          if ($navigation.length) {

            WPAjaxifier.Utilities.log('Wordpress Ajaxifier Navigation', $navigation);

          } else {

            WPAjaxifier.Utilities.warn(`Wordpress Ajaxifier cannot find the navigation container with the provided id ${wordpress_ajaxifier_localized_data['navigationSelector'] ?  wordpress_ajaxifier_localized_data['navigationSelector'] : '"nav"'}. Add the navigation id in the settings to have a working navigation`);

          }

					createInternalPseudoSelector();
          createjQueryPlugin();
					attachjQueryPlugin();
					attachStateChangeEvent();

          // Handle Search Form
          var $searchForm = $content.find(`#${wordpress_ajaxifier_localized_data['searchFormSelector'] ? wordpress_ajaxifier_localized_data['searchFormSelector'] : 'search-form'}`);

          if ($searchForm.length) {

            initializeSearchForm($searchForm);

          }

        }

      };

    }());

    // Check to see if History.js is enabled for our Browser
    if ( !History.enabled ) {

      WPAjaxifier.Utilities.error('Browser history is not enabled.');
      return false;

    }

    WPAjaxifier.Main.init();

  })(jQuery, window);

});