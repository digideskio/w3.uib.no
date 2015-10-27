<?php
/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
function uib_w3_preprocess_html(&$variables) {
  drupal_add_js('//use.typekit.net/yfr2tzw.js', 'external');
  drupal_add_js('try{Typekit.load();}catch(e){}', 'inline');
  if ($node = menu_get_object()) {
    if ($node->type == 'uib_article') {
      $variables['classes_array'][] = 'uib-article__' . $node->field_uib_article_type['und'][0]['value'];
    }
  }
}

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function uib_w3_preprocess_page(&$variables, $hook) {
  global $user;
  $page_menu_item = menu_get_item(current_path());
  if (!is_int(strpos($page_menu_item['path'], 'node/add/'))) {
    if ($variables['language']->language == 'nb') {
      $variables['global_menu'] = menu_navigation_links('menu-global-menu-no');
    }
    else {
      $variables['global_menu'] = menu_navigation_links('menu-global-menu');
    }
  }
  $current_area = uib_area__get_current();
  if ($current_area && !$variables['is_front']) {
    $variables['page']['subheader']['area'] = array(
      '#type' => 'html_tag',
      '#tag' => 'h2',
      '#value' => $current_area->title,
    );
  }

  switch (true) {
    case $variables['node']->type == 'uib_article':
      $variables['page']['content_top']['kicker'] = field_view_field('node', $variables['node'], 'field_uib_kicker', array(
        'label' => 'hidden',
        'weight' => -50,
      ));
      $variables['page']['content_top']['title'] = array(
        '#type' => 'html_tag',
        '#tag' => 'h1',
        '#value' => $variables['node']->title,
        '#weight' => -45,
      );
      $article_info = __uib_w3__article_info($variables['node']);
      $variables['page']['content_top']['article_info'] = $article_info;
      $variables['page']['content_top']['field_uib_lead'] = field_view_field('node', $variables['node'], 'field_uib_lead', array(
        'label' => 'hidden',
        'weight' => -35,
      ));
      $variables['page']['content_top']['field_uib_main_media'] = field_view_field('node', $variables['node'], 'field_uib_main_media', array(
        'type' => 'file_rendered',
        'settings' => array('file_view_mode' => 'content_main'),
        'label' => 'hidden',
        'weight' => -30,
      ));
      $variables['page']['content_bottom']['field_uib_links'] = field_view_field('node', $variables['node'], 'field_uib_links', array(
        'weight' => '25',
      ));
      $variables['page']['content_bottom']['field_uib_relation'] = field_view_field('node', $variables['node'], 'field_uib_relation', array(
        'weight' => '30',
        'type' => 'entityreference_entity_view',
        'settings' => array('view_mode' => 'short_teaser'),
      ));
      $variables['page']['content_bottom']['field_uib_related_persons'] = field_view_field('node', $variables['node'], 'field_uib_related_persons' , array(
        'weight' => '27',
        'type' => 'entityreference_entity_view',
        'settings' => array('view_mode' => 'uib_user_teaser'),
      ));
      $variables['page']['content_bottom']['field_uib_files'] = field_view_field('node', $variables['node'], 'field_uib_files', array(
        'weight' => '26',
      ));
      break;

    case $variables['node']->type == 'area':
      $variables['page']['content_top']['uib_area_banner'] = field_view_field('node', $variables['node'], 'field_uib_area_banner', array(
        'label' => 'hidden',
        'weight' => -40,
      ));
      $variables['page']['content_top']['uib_area_offices'] = __uib_w3__render_block('uib_area', 'area_offices', -35);
      $variables['page']['content_top']['field_uib_primary_media'] = field_view_field('node', $variables['node'], 'field_uib_primary_media', array(
        'type' => 'file_rendered',
        'settings' => array('file_view_mode' => 'area_main'),
        'label' => 'hidden',
        'weight' => -30,
      ));
      $variables['page']['content_top']['field_uib_primary_text'] = field_view_field('node', $variables['node'], 'field_uib_primary_text', array(
        'label' => 'hidden',
        'weight' => -25,
      ));
      $variables['page']['content_top']['field_uib_secondary_text'] = field_view_field('node', $variables['node'], 'field_uib_secondary_text', array(
        'label' => 'hidden',
        'weight' => -20,
      ));
      $variables['page']['content_bottom']['uib_area_calendar'] = __uib_w3__render_block('views', 'calendar-block_1', 0);
      $variables['page']['content_bottom']['uib_area_exhibitions'] = __uib_w3__render_block('views', 'calendar-block_4', 5);
      $variables['page']['content_bottom']['uib_area_newspage_recent_news'] = __uib_w3__render_block('views', 'recent_news-block', 10);
      $variables['page']['content_bottom']['uib_area_testimonial'] = field_view_field('node', $variables['node'], 'field_uib_profiled_testimonial', array(
        'weight' => 30,
        'type' => 'entityreference_entity_view',
        'settings' => array('view_mode' => 'teaser'),
      ));
      $variables['page']['footer_top']['field_uib_link_section'] = field_view_field('node', $variables['node'], 'field_uib_link_section', array(
        'label' => 'hidden',
        'weight' => 10,
      ));
      $variables['page']['content_bottom']['field_uib_feed'] = __uib_w3__render_block('uib_area', 'feed', 15);

      switch ($variables['node']->field_uib_area_type['und'][0]['value']) {
        case 'newspage':
          $variables['page']['content_top']['field_uib_profiled_article'] = field_view_field('node', $variables['node'], 'field_uib_profiled_article', array(
            'settings' => array('view_mode' => 'teaser'),
            'weight' => 4,
            'type' => 'entityreference_entity_view',
            'settings' => array('view_mode' => 'teaser'),
            'label' => 'hidden',
          ));
          break;
        }
      break;

    case $variables['node']->type == 'uib_study':
      $variables['page']['content_top']['field_uib_study_type'] = field_view_field('node', $variables['node'], 'field_uib_study_type', array(
        'label' => 'hidden',
        'weight' => -50,
      ), $variables['node']->language);
      $variables['page']['content_top']['title'] = array(
        '#type' => 'html_tag',
        '#tag' => 'h1',
        '#value' => $variables['node']->field_uib_study_title[$variables['node']->language][0]['safe_value'],
        '#weight' => -45,

      );
      $variables['page']['content_top']['study_facts'] = __uib_w3__render_block('uib_study', 'study_facts_2', 40);
      $variables['page']['content']['study_content'] = __uib_w3__render_block('uib_study', 'study_content', 0);
      $variables['page']['content']['study_contact'] = __uib_w3__render_block('uib_study', 'study_contact', 5);
      global $language;
      $belongs_to = uib_study__area($variables['node'], $language->language);
      $variables['page']['content']['study_belongs_to'] = array(
        '#type' => 'html_tag',
        '#tag' => 'div',
        '#value' => $belongs_to,
        '#weight' => 20,
        '#attributes' => array('class' => array('uib-study-belongs-to')),
      );
      $variables['page']['content_bottom']['study_related'] = __uib_w3__render_block('uib_study', 'study_related', 15);
      if ($variables['node']->field_uib_study_type['und'][0]['value'] == 'course') {
        $variables['page']['content']['study_toggle'] = __uib_w3__render_block('uib_study', 'study_semester_toggle', 10);
      }
      if (in_array($variables['node']->field_uib_study_type['und'][0]['value'], array('program', 'specialization'))) {
        $variables['page']['content']['study_image'] = field_view_field('node', $variables['node'], 'field_uib_study_image', array(
          'type' => 'file_rendered',
          'settings' => array('file_view_mode' => 'content_sidebar'),
          'label' => 'hidden',
          'weight' => 3,
        ));
        $variables['page']['content']['study_testimonial'] = __uib_w3__render_block('uib_study', 'study_testimonial', 10);
        $variables['page']['content_bottom']['study_plan'] = __uib_w3__render_block('uib_study', 'study_plan', 20);
      }

      break;
  }
  $unset_blocks = array(
    'uib_area_paahoyden_logo',
    'uib_area_colophon',
    'uib_area_feed',
    'uib_area_newspage_recent_news',
    'uib_dbh_dbh',
    'uib_study_study_content',
    'uib_area_jobbnorge',
    'uib_area_area_parents',
    'uib_area_colophon_logos',
    'uib_study_study_related',
    'uib_study_study_facts',
    'uib_study_study_facts_2',
    'uib_study_study_contact',
    'uib_study_study_semester_toggle',
    'uib_study_study_testimonial',
    'uib_area_area_banner',
    'uib_area_area_offices',
  );
  foreach ($unset_blocks as $block) {
    unset($variables['page']['header'][$block]);
  }
}

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function uib_w3_preprocess_node(&$variables, $hook) {
  global $language;
  $current_language = $language->language;
  if ($variables['page'])  {
    if ($variables['type'] == 'area') {
      $variables['content']['field_uib_profiled_article'] = field_view_field('node', $variables['node'], 'field_uib_profiled_article', array(
        'settings' => array('view_mode' => 'teaser'),
        'weight' => 4,
        'type' => 'entityreference_entity_view',
        'settings' => array('view_mode' => 'teaser'),
        'label' => 'hidden',
      ));
      if ($variables['field_uib_area_type']['und'][0]['value'] == 'newspage') {
        $variables['content']['field_uib_profiled_message'] = field_view_field('node', $variables['node'], 'field_uib_profiled_message', array(
          'settings' => array('view_mode' => 'teaser'),
          'weight' => 4,
          'type' => 'entityreference_entity_view',
          'settings' => array('view_mode' => 'teaser'),
          'label' => 'hidden',
        ));
        hide($variables['content']['field_uib_profiled_article']);
      }
    }
    $hide_vars = array(
      'field_uib_byline',
      'field_uib_kicker',
      'field_uib_lead',
      'field_uib_main_media',
      'field_uib_primary_media',
      'field_uib_primary_text',
      'field_uib_secondary_text',
      'field_uib_social_media',
      'field_uib_relation',
      'field_uib_link_section',
      'field_uib_profiled_testimonial',
      'field_uib_links',
      'field_uib_related_persons',
      'field_related_persons_label',
      'field_uib_files',
      'field_uib_study_category',
      'field_uib_study_image',
    );
    foreach ($hide_vars as $var) {
      hide($variables['content'][$var]);
    }
  }
  else {
    if ($variables['type'] == 'uib_article' && $variables['view_mode'] == 'short_teaser') {
      $variables['theme_hook_suggestions'][] = 'node__article__short_teaser';
    }
  }
}

/**
 * Function returning render array for article info
 */
function __uib_w3__article_info(&$node) {
  $date_info = '<span class="uib-date-info">' . t('Date') . ': ';
  $date_info .= date('d.m.Y', $node->created);
  $date_info .= ' (' . t('Last updated') . ': ' . date('d.m.Y' , $node->changed) . ')';
  $date_info .= '</span>';

  $article_info = array(
    '#type' => 'markup',
    '#markup' => '<div class="article-info">',
    '#weight' => '-40',
  );
  if (!in_array($node->field_uib_article_type['und'][0]['value'], array('infopage', 'event'))) {
    $author = __uib_w3__author($node);
    if ($author) {
      $article_info['#markup'] .= '<span class="uib-news-byline">' . t('By') . ' <span class="uib-author">';
      $article_info['#markup'] .= $author;
      $article_info['#markup'] .= '</span></span>';
    }
  }
  $article_info['#markup'] .= $date_info;
  $article_info['#markup'] .= '</div>';
  return $article_info;
}

/**
 * Function returning markup for article author
 */
function __uib_w3__author(&$node) {
  $authors = FALSE;
  if (!empty($node->field_uib_byline)) {
    $byline = field_view_field('node', $node, 'field_uib_byline', array(
      'type' => 'entityreference_label',
      'label' => 'hidden',
      'settings' => array('link' => TRUE),
    ));
    $tmp = array();
    foreach ($node->field_uib_byline['und'] as $key => $b) {
      $tmp[] = $byline[$key]['#markup'];
    }
    if ($tmp) {
      $last_author = array_pop($tmp);
      if ($tmp) {
        $authors = implode(', ', $tmp) . ' ' . t('and') . ' ' . $last_author;
      }
      else {
        $authors = $last_author;
      }
    }
  }
  return $authors;
}

/**
 * Function for creating a renderable block
 */
function __uib_w3__render_block($module, $block_id, $weight) {
  $block = block_load($module, $block_id);
  $block_content = _block_render_blocks(array($block));
  $render = _block_get_renderable_array($block_content);
  $render['#weight'] = $weight;
  return $render;
}
