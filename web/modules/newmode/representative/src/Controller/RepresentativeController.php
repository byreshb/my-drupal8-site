<?php

namespace Drupal\representative\Controller;

use Drupal;
use Drupal\representative\Api\RepresentativeClient;
use Drupal\representative\Form\RepresentativeListForm;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller responsible for processing the representative list form.
 * Acts as c controller in MVC pattern
 *
 * Class RepresentativeController
 * @package Drupal\representative\Controller
 */
class RepresentativeController
{

  /**
   * Controller method responsible for processing the form
   *
   * Form's GET action renders the form
   * Form's POST action retrieve the data from API and renders the form
   *
   * @return array
   */
  public function content()
  {
    $noResultMessage = null;

    // When user submits the forms (POST)
    if (Drupal::request()->getMethod() == Request::METHOD_POST) {
      $postalCode = Drupal::request()->request->get(RepresentativeListForm::POSTAL_CODE_PARAM);
      $repItems = RepresentativeClient::getList($postalCode);
      $noResultMessage = "Sorry, we couldn't find any results.";
    }
    // When use accesses the form (GET)
    else {
      $repItems = [];
    }

    // Drupal's form API builder
    $form = Drupal::formBuilder()->getForm(RepresentativeListForm::class);

    // key-value pair for rendering the twig file (Template View EIP pattern)
    return [
      '#theme' => 'representative_list',
      '#items' => $repItems,
      '#title' => 'List of Political Representatives',
      '#my_form' => $form,
      '#no_result_message' => $noResultMessage
    ];
  }
}
