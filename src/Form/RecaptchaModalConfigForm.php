<?php

namespace Drupal\recaptcha_modal\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Provides the reCAPTCHA admin settings form.
 */
class RecaptchaModalConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'recaptcha_modal.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'recaptcha_modal_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('recaptcha_modal.settings');
    $form['recaptcha_site_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Recaptcha Site Key'),
      '#description' => $this->t('The reCAPTCHA site key for :site_name. See @link for more information.', [
        ':site_name' => $this->config('system.site')->get('name'),
        '@link' => Link::fromTextAndUrl('https://www.google.com/recaptcha', Url::fromUri('https://www.google.com/recaptcha'))->toString(),
      ]),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('recaptcha_site_key'),
    ];

    $form['recaptcha_secret_key'] = [
      '#type' => 'key_select',
      '#title' => $this->t('Recaptcha Secret Key'),
      '#default_value' => $config->get('recaptcha_secret_key'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('recaptcha_modal.settings')
      ->set('recaptcha_site_key', $form_state->getValue('recaptcha_site_key'))
      ->save();

    $this->config('recaptcha_modal.settings')
      ->set('recaptcha_secret_key', $form_state->getValue('recaptcha_secret_key'))
      ->save();
  }

}
