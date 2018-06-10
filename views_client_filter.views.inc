<?php
/**
 * Implements hook_views_data().
 */
function views_client_filter_views_data() {
  $data['views']['client_filter'] = array(
    'title' => t('Client-side filter'),
    'help' => t('Builds a set of radio buttons from the taxonomy tree for clien-side JS filtering.'),
    'area' => array(
      'id' => 'client_filter',
    ),
  );
  return $data;
}