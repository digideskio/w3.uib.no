<?php
/**
 * @file
 * uib_setup.default_picture_mapping.inc
 */

/**
 * Implements hook_default_picture_mapping().
 */
function uib_setup_default_picture_mapping() {
  $export = array();

  $picture_mapping = new PictureMapping();
  $picture_mapping->disabled = FALSE; /* Edit this to true to make a default picture_mapping disabled initially */
  $picture_mapping->api_version = 2;
  $picture_mapping->label = 'w3 banner full width';
  $picture_mapping->machine_name = 'w3_banner_full_width';
  $picture_mapping->breakpoint_group = 'uib_w3';
  $picture_mapping->mapping = array(
    'breakpoints.theme.uib_w3.full_width' => array(
      '1x' => array(
        'mapping_type' => 'image_style',
        'image_style' => 'full_width_image_full_width_1x',
      ),
    ),
    'breakpoints.theme.uib_w3.wide' => array(
      '1x' => array(
        'mapping_type' => 'image_style',
        'image_style' => 'full_width_image_wide_1x',
      ),
    ),
    'breakpoints.theme.uib_w3.narrow' => array(
      '1x' => array(
        'mapping_type' => 'image_style',
        'image_style' => 'full_width_image_narrow_1x',
      ),
    ),
    'breakpoints.theme.uib_w3.mobile' => array(
      '1x' => array(
        'mapping_type' => 'image_style',
        'image_style' => 'full_width_image_mobile_1x',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
    ),
  );
  $export['w3_banner_full_width'] = $picture_mapping;

  $picture_mapping = new PictureMapping();
  $picture_mapping->disabled = FALSE; /* Edit this to true to make a default picture_mapping disabled initially */
  $picture_mapping->api_version = 2;
  $picture_mapping->label = 'w3 content main';
  $picture_mapping->machine_name = 'w3_content_main';
  $picture_mapping->breakpoint_group = 'uib_w3';
  $picture_mapping->mapping = array(
    'breakpoints.theme.uib_w3.full_width' => array(
      '1x' => array(
        'mapping_type' => '_none',
      ),
    ),
    'breakpoints.theme.uib_w3.wide' => array(
      '1x' => array(
        'mapping_type' => 'image_style',
        'image_style' => 'content_main_wide_1x',
      ),
    ),
    'breakpoints.theme.uib_w3.narrow' => array(
      '1x' => array(
        'mapping_type' => 'image_style',
        'image_style' => 'content_main_narrow_1x',
      ),
    ),
    'breakpoints.theme.uib_w3.mobile' => array(
      '1x' => array(
        'mapping_type' => 'image_style',
        'image_style' => 'content_main_mobile_1x',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
    ),
  );
  $export['w3_content_main'] = $picture_mapping;

  return $export;
}
