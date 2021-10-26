<?php

namespace Drupal\recaptcha_modal_test\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\MessageCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides the reCAPTCHA Modal test form.
 */
class RecaptchaModalTestForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'recaptcha_modal_test_form';
  }


  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['messages'] = [
      '#type' => 'container',
      '#attributes' => [
        'id' => 'recaptcha-modal-test-messages',
      ],
    ];

    $form['wrapper'] = ['#type' => 'container'];

    $form['wrapper']['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#required' => TRUE,
      '#weight' => -20,
    ];

    $form['wrapper']['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#required' => TRUE,
      '#weight' => -10,
    ];

    $form['wrapper']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#ajax' => [
        'callback' => [$this, 'ajaxCallback'],
        'wrapper' => 'recaptcha-modal-test-form',
      ],
      '#recaptcha_modal' => 1,
    ];

    $form['#cache']['max-age'] = 0;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Required method intentionally left blank.
  }

  /**
   * Ajax Callback
   */
  public function ajaxCallback(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    $response = new AjaxResponse();
    $response->addCommand(new MessageCommand($this->t('Hello @fname @lname', [
      '@fname' => $values['first_name'],
      '@lname' => $values['last_name']
    ]), '#recaptcha-modal-test-messages', ['type' => 'status']));

    return $response;
  }

}
