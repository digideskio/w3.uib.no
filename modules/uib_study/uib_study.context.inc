<?php
/**
 * @file
 * uib_study.context.inc
 */

/**
 * Implements hook_context_default_contexts().
 */
function uib_study_context_default_contexts() {
  $export = array();

  $context = new stdClass();
  $context->disabled = FALSE; /* Edit this to true to make a default context disabled initially */
  $context->api_version = 3;
  $context->name = 'study_blocks';
  $context->description = '';
  $context->tag = 'block';
  $context->conditions = array(
    'node' => array(
      'values' => array(
        'uib_study' => 'uib_study',
      ),
      'options' => array(
        'node_form' => '0',
      ),
    ),
  );
  $context->reactions = array(
    'block' => array(
      'blocks' => array(
        'uib_study-study_facts' => array(
          'module' => 'uib_study',
          'delta' => 'study_facts',
          'region' => 'content',
          'weight' => '18',
        ),
        'uib_study-study_contact' => array(
          'module' => 'uib_study',
          'delta' => 'study_contact',
          'region' => 'content',
          'weight' => '19',
        ),
        'uib_study-study_testimonial' => array(
          'module' => 'uib_study',
          'delta' => 'study_testimonial',
          'region' => 'content',
          'weight' => '20',
        ),
        'uib_study-study_related' => array(
          'module' => 'uib_study',
          'delta' => 'study_related',
          'region' => 'content',
          'weight' => '21',
        ),
        'uib_study-study_content' => array(
          'module' => 'uib_study',
          'delta' => 'study_content',
          'region' => 'content',
          'weight' => '22',
        ),
      ),
    ),
  );
  $context->condition_mode = 0;

  // Translatables
  // Included for use with string extractors like potx.
  t('block');
  $export['study_blocks'] = $context;

  return $export;
}