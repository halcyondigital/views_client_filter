<?php
/**
 * @file
 * Contains \Drupal\views_client_filter\Form\ClientFilterForm.
 */
namespace Drupal\views_client_filter\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\AlertCommand;

class ClientFilterForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'client_filter_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state, $arg = NULL) {
    $vid = 'categories';
    $terms =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid);
    $options['All'] = 'All';
    foreach ($terms as $term) {
      if(in_array($arg, $term->parents)){
       $options[$term->tid] = $term->name;
      }
    }
    $form['parent']= array(
        '#type' => 'hidden',
        '#value' => $arg,
    );
    $form['category'] = array(
      '#type' => 'radios',
      '#required' => FALSE,
      '#options' => $options,
      '#default_value' => 'All',
      '#attributes' => array(
        'autocomplete' => 'off',
      ),
    );
    if(count($options) <= 2) {
      $form['#attributes']['class'][] = 'off';
    }
    /*$form['category']['#ajax'] = array(
        'callback' => '::filterAjaxCallback',
        'event' => 'change',
        'progress' => 'none',
      );*/
    $form['#attributes']['class'][] = 'exposed-parent-' . $arg;
    $form['#attributes']['class'][] = 'form-inline';
    $form['#attributes']['class'][] = 'rental-items-filter';
    $form['#attached']['library'][] = 'views_client_filter/views_client_filter';
    return $form;
  }
   /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));
     foreach ($form_state->getValues() as $key => $value) {
       drupal_set_message($key . ': ' . $value);
     }
    }

    /**
    * Ajax callback.
    */
  public function filterAjaxCallback(array $form, FormStateInterface $form_state) {
     $response = new AjaxResponse();
     //$response->addCommand(new AlertCommand('This is from an ajax callback'));
     $arg = $form_state->getValue('parent');
     $response->addCommand(new InvokeCommand(NULL, 'ajaxFilter', [$arg]));
     return $response;
    }

}