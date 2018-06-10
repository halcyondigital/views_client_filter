<?php

namespace Drupal\views_client_filter\Plugin\views\area;

use Drupal\views\ViewExecutable;
use Drupal\views\Plugin\views\area\AreaPluginBase;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a views area plugin.
 *
 * @ingroup views_area_handlers
 *
 * @ViewsArea("client_filter")
 */
class ClientFilter extends AreaPluginBase {

  /**
   * {@inheritdoc}
   */
  public function render($empty = FALSE) {
    $arg = $this->view->args[0] ?? NULL;
    if(!empty($arg)) {
      $content = \Drupal::formBuilder()->getForm(\Drupal\views_client_filter\Form\ClientFilterForm::class, $arg);
      return $content;
    }
    /*if (!$empty || !empty($this->options['empty'])) {
      return array(
        '#markup' => 'eh',
      );
    }*/

    return array();
  }
}