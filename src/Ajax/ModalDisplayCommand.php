<?php

namespace Drupal\recaptcha_modal\Ajax;

use Drupal\Core\Ajax\CommandInterface;

/**
 * Provides the ModalDisplay AJAX command.
 */
class ModalDisplayCommand implements CommandInterface {

  /**
   * A CSS selector string.
   *
   * A selector for the modal content to display.
   *
   * @var string
   */
  protected $selector;

  /**
   * Construct a new ModalDisplayCommand.
   *
   * @param string $selector
   *   A CSS selector for the modal content.
   */
  public function __construct($selector) {
    $this->selector = $selector;
  }

  /**
   * Render custom ajax command.
   *
   * @return ajax
   *   Command function.
   */
  public function render() {
    return [
      'command' => 'modalDisplay',
      'selector' => $this->selector,
    ];
  }

}
