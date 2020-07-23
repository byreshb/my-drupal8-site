<?php

namespace Drupal\representative\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\representative\Controller\RepresentativeController;

/**
 * This class builds the Search form using Drupal's Form API.
 *
 * Class RepresentativeListForm
 * @package Drupal\representative\Form
 */
class RepresentativeListForm extends FormBase
{
  /**
   * Defining postal code parameter as a constant as it used in other classes (Example: @var RepresentativeController)
   */
  const POSTAL_CODE_PARAM = "postal_code";

  /**
   * Form Identifier which will get converted to html's class and id attribute
   */
  public function getFormId()
  {
    return 'representative_form';
  }

  /**
   * method to construct Search Form with input / output attributes
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form[self::POSTAL_CODE_PARAM] = [
      '#type' => 'textfield'
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Search')
    ];

    return $form;
  }

  /**
   * Action to perform when form is submitted
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    // By default, drupal uses Post/Redirect/Get Pattern (https://en.wikipedia.org/wiki/Post/Redirect/Get).
    // The search form only retrieves data. It doesn't insert / update so disabling the redirect won't corrupt the data.
    $form_state->disableRedirect();
  }
}
