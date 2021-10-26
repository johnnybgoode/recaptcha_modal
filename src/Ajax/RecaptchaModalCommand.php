<?php

namespace Drupal\recaptcha_modal\Ajax;

use Drupal\Core\Ajax\CommandInterface;

/**
 * Provides the RecaptchaModal AJAX command.
 */
class RecaptchaModalCommand implements CommandInterface {

  /**
   * The ID of the form.
   *
   * @var string
   */
  protected $formId;

  /**
   * Construct a new RecaptchaModalCommand.
   *
   * @param string $form_id
   *   The form id.
   */
  public function __construct($form_id) {
    $this->formId = $form_id;
  }

  /**
   * Render custom ajax command.
   *
   * @return ajax
   *   Command function.
   */
  public function render() {
    return [
      'command' => 'recaptchaModal',
      'form_id' => $this->formId,
    ];
  }

}
