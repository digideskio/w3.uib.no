<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<?php if ($logo || $site_name): ?>
    <div class="header__wrapper">
      <header class="header">
<?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="logo__link">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="logo__image" />
        </a>
<?php endif; ?>
<?php if ($site_name): ?>
  <?php if ($title): ?>
          <div class="site-name">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
          </div>
  <?php else: /* Use h1 when the content title is empty */ ?>
          <h1 class="site-name">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
          </h1>
  <?php endif; ?>
<?php endif; ?>
<?php print render($page['header']); ?>
    <div class="mobile-menu noscript" title="<?php print t('Menu'); ?>">
      <span>Click</span>
<?php print render($page['mobile']); ?>
    </div>
      </header>
      <nav class="mobile_dropdown">
        <?php
        $variables['mobile']['#prefix'] = '<nav class="mobile noscript">';
        print render($variables['mobile']);
        ?>
      </nav>
    </div>
<?php endif; ?>
<?php if ($page['subheader']): ?>
    <div class="subheader__wrapper">
<?php print render($page['subheader']); ?>
    </div>
<?php endif; ?>
<?php if (!empty($area_menu)): ?>
    <nav id="main-menu">
<?php print render($area_menu); ?>
    </nav>
<?php endif; ?>
<?php print $messages; ?>
    <main>
      <a id="main-content"></a>
<?php print render($title_prefix); ?>
<?php /*if ($title): ?>
      <h1 class="title" id="page-title"><?php print $title; ?></h1>
<?php endif;*/ ?>
<?php print render($title_suffix); ?>
<?php if ($tabs): ?>
      <div class="tabs"><?php print render($tabs); ?></div>
<?php endif; ?>
<?php print render($page['help']); ?>
<?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
<?php if ($page['content_top'] || $breadcrumb): ?>
      <div class="content-top-wrapper">
        <div class="content-top">
<?php if ($breadcrumb): ?>
          <div class="uib_breadcrumb"><?php print $breadcrumb; ?></div>
<?php endif; ?>
<?php print render($page['content_top']); ?>
        </div>
      </div>
<?php endif; ?>
<?php if ($page['content']): ?>
      <div class="content-main-wrapper">
<?php print render($page['content']); ?>
      </div>
<?php endif; ?>
<?php if ($page['content_bottom']): ?>
      <div class="content-bottom-wrapper">
        <div class="content-bottom">
<?php print render($page['content_bottom']); ?>
        </div>
      </div>
<?php endif; ?>
<?php print $feed_icons; ?>
<?php /*if ($page['sidebar_first']): ?>
      <aside class="column sidebar sidebar-first">
<?php print render($page['sidebar_first']); ?>
      </aside>
<?php endif; ?>
<?php if ($page['sidebar_second']): ?>
      <aside class="column sidebar sidebar-second">
<?php print render($page['sidebar_second']); ?>
      </aside>
<?php endif; */ ?>
    </main>
    <footer>
<?php if ($page['footer_top']): ?>
        <div class="footer-top-wrapper">
          <div class="footer-top">
<?php print render($page['footer_top']); ?>
          </div>
        </div>
<?php endif; ?>
<?php if ($page['footer']): ?>
        <div class="footer-wrapper">
<?php if (isset($area_menu_footer)): ?>
          <nav class="main-menu__expanded">
<?php print render($area_menu_footer); ?>
          </nav>
<?php endif; ?>
          <div class="footer">
<?php print render($page['footer']); ?>
          </div>
        </div>
<?php endif; ?>
<?php if ($page['footer_bottom']): ?>
        <div class="footer-bottom-wrapper">
          <div class="footer-bottom">
<?php print render($page['footer_bottom']); ?>
          </div>
        </div>
<?php endif; ?>
    </footer>
