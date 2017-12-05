<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://oscarviquez.com/wordpress-ajaxifier
 * @since      1.0.0
 *
 * @package    Wordpress_Ajaxifier
 * @subpackage Wordpress_Ajaxifier/admin/partials
 */
?>

<div class="wrap">

  <h1>Wordpress Ajaxifier</h1>

  <?php settings_errors(); ?>

  <form action="options.php" method="post">

    <?php
      settings_fields( 'wordpress-ajaxifier-settings' );
      do_settings_sections( 'wordpress-ajaxifier-settings' );
    ?>

    <table class="form-table">

      <tbody>

        <tr>
          <th scope="row"><?php echo __('Main Container Selector', 'wordpress-ajaxifier') ?></th>
          <td>
            <input type="text" class="regular-text" placeholder="<?php echo __('main', 'wordpress-ajaxifier') ?>" name="wordpress_ajaxifier_main_selector" value="<?php echo esc_attr( get_option('wordpress_ajaxifier_main_selector') ); ?>" />
            <p class="description" id="wordpress-ajaxifier-main-selector-description"><?php echo __('The id of the main container element.', 'wordpress-ajaxifier') ?></p>
            <p class="description" id="wordpress-ajaxifier-excluded-selectors-description-note"><strong><?php echo __('Note:', 'wordpress-ajaxifier') ?></strong> <?php echo __('this is where the page content will be loaded into.', 'wordpress-ajaxifier') ?></p>
          </td>
        </tr>

        <tr>
          <th scope="row"><?php echo __('Navigation Selector', 'wordpress-ajaxifier') ?></th>
          <td>
            <input type="text" class="regular-text" placeholder="<?php echo __('nav', 'wordpress-ajaxifier') ?>" name="wordpress_ajaxifier_navigation_selector" value="<?php echo esc_attr( get_option('wordpress_ajaxifier_navigation_selector') ); ?>" />
            <p class="description" id="wordpress-ajaxifier-navigation-selector-description"><?php echo __('The id of the main navigation container.', 'wordpress-ajaxifier') ?></p>
          </td>
        </tr>

        <tr>
          <th scope="row"><?php echo __('Search Form Selector', 'wordpress-ajaxifier') ?></th>
          <td>
            <input type="text" class="regular-text" placeholder="<?php echo __('search-form', 'wordpress-ajaxifier') ?>" name="wordpress_ajaxifier_search_form_selector" value="<?php echo esc_attr( get_option('wordpress_ajaxifier_search_form_selector') ); ?>" />
            <p class="description" id="wordpress-ajaxifier-search-form-selector-description"><?php echo __('The id of the main search form.', 'wordpress-ajaxifier') ?></p>
          </td>
        </tr>

        <tr>
          <th scope="row"><?php echo __('Manual Selectors', 'wordpress-ajaxifier') ?></th>
          <td>
            <textarea class="large-text code" rows="5" placeholder="<?php echo __('.manual-ajaxifier', 'wordpress-ajaxifier') ?>" name="wordpress_ajaxifier_manual_selectors"><?php echo esc_attr( get_option('wordpress_ajaxifier_manual_selectors') ); ?></textarea>
            <p class="description" id="wordpress-ajaxifier-manual-selectors-description"><?php echo __('All links matching or inside this selectors WILL trigger an ajax load. You can also add the class ".manual-ajaxifier" dynamically in your link tags.', 'wordpress-ajaxifier') ?></p>
            <p class="description" id="wordpress-ajaxifier-manual-selectors-description-note"><strong><?php echo __('Note:', 'wordpress-ajaxifier') ?></strong> <?php echo __('Multiple selectors need to be comma separated. eg: "#disable-ajax, section.no-ajax-trigger"', 'wordpress-ajaxifier') ?></p>
          </td>
        </tr>

        <tr>
          <th scope="row"><?php echo __('Excluded Selectors', 'wordpress-ajaxifier') ?></th>
          <td>
            <textarea class="large-text code" rows="5" placeholder="<?php echo __('.no-ajaxifier', 'wordpress-ajaxifier') ?>" name="wordpress_ajaxifier_excluded_selectors"><?php echo esc_attr( get_option('wordpress_ajaxifier_excluded_selectors') ); ?></textarea>
            <p class="description" id="wordpress-ajaxifier-excluded-selectors-description"><?php echo __('All links matching or inside this selectors will NOT trigger an ajax load. You can also add the class ".no-ajaxifier" directly in your link tags.', 'wordpress-ajaxifier') ?></p>
            <p class="description" id="wordpress-ajaxifier-excluded-selectors-description-note"><strong><?php echo __('Note:', 'wordpress-ajaxifier') ?></strong> <?php echo __('Multiple selectors need to be comma separated. eg: "#disable-ajax, section.no-ajax-trigger"', 'wordpress-ajaxifier') ?></p>
          </td>
        </tr>

        <tr>
          <th scope="row"><?php echo __('Loader Image', 'wordpress-ajaxifier') ?></th>
          <td>

            <select name="wordpress_ajaxifier_loader_image">
              <option value="">Default</option>
              <option value="spinner" <?php echo esc_attr( get_option('wordpress_ajaxifier_loader_image') ) == 'spinner' ? 'selected="selected"' : ''; ?>>Spinner</option>
              <option value="ripple" <?php echo esc_attr( get_option('wordpress_ajaxifier_loader_image') ) == 'ripple' ? 'selected="selected"' : ''; ?>>Ripple</option>
              <option value="gear" <?php echo esc_attr( get_option('wordpress_ajaxifier_loader_image') ) == 'gear' ? 'selected="selected"' : ''; ?>>Gear</option>
              <option value="facebook" <?php echo esc_attr( get_option('wordpress_ajaxifier_loader_image') ) == 'facebook' ? 'selected="selected"' : ''; ?>>Facebook</option>
            </select>
            <p class="description" id="wordpress-ajaxifier-loader-image-description"><?php echo __('CSS and Markup taken from ', 'wordpress-ajaxifier') ?><a href="https://loading.io/" target="_blank">Loading.io</a></p>

          </td>
        </tr>

        <tr>
          <th scope="row"><?php echo __('Loader Markup', 'wordpress-ajaxifier') ?></th>
          <td>
            <textarea class="large-text code" rows="5" placeholder="<?php echo __('<div></div>', 'wordpress-ajaxifier') ?>" name="wordpress_ajaxifier_loader_markup"><?php echo esc_attr( get_option('wordpress_ajaxifier_loader_markup') ); ?></textarea>
            <p class="description" id="wordpress-ajaxifier-loader-markup-description"><?php echo __('HTML Markup for the ajax loader.', 'wordpress-ajaxifier') ?></p>
            <p class="description" id="wordpress-ajaxifier-loader-markup-description-note"><strong><?php echo __('Note:', 'wordpress-ajaxifier') ?></strong> <?php echo __('This will override the above image selector.', 'wordpress-ajaxifier') ?></p>
          </td>
        </tr>

        <tr>
          <th scope="row"><label for="wordpress_ajaxifier_scroll_top"><?php echo __('Scroll to Top', 'wordpress-ajaxifier') ?></label></th>
          <td>
            <input type="checkbox" id="wordpress_ajaxifier_scroll_top" name="wordpress_ajaxifier_scroll_top" <?php echo esc_attr( get_option('wordpress_ajaxifier_scroll_top') ) == 'on' ? 'checked="checked"' : ''; ?> />
            <span class="description" id="wordpress-ajaxifier-scroll-top-description"><?php echo __('The content will scroll back to the top once its loaded.', 'wordpress-ajaxifier') ?></span>
          </td>
        </tr>

        <tr>
          <th scope="row"><label for="wordpress_ajaxifier_effect"><?php echo __('Transition Effect', 'wordpress-ajaxifier') ?></label></th>
          <td>
              <input type="checkbox" id="wordpress_ajaxifier_effect" name="wordpress_ajaxifier_effect" <?php echo esc_attr( get_option('wordpress_ajaxifier_effect') ) == 'on' ? 'checked="checked"' : ''; ?> />
              <span class="description" id="wordpress-ajaxifier-effect-description"><?php echo __('The content will fade in once its loaded.', 'wordpress-ajaxifier') ?></span>
          </td>
        </tr>

        <tr>
          <th scope="row"><label for="wordpress_ajaxifier_console_logs"><?php echo __('Console Logs', 'wordpress-ajaxifier') ?></label></th>
          <td>
            <input type="checkbox" id="wordpress_ajaxifier_console_logs" name="wordpress_ajaxifier_console_logs" <?php echo esc_attr( get_option('wordpress_ajaxifier_console_logs') ) == 'on' ? 'checked="checked"' : ''; ?> />
            <span class="description" id="wordpress-ajaxifier-console-logs-description"><?php echo __('Show console logs in the browser\'s Dev Tools.', 'wordpress-ajaxifier') ?></span>
          </td>
        </tr>

      </tbody>

    </table>

    <?php submit_button(); ?>

  </form>

</div>

