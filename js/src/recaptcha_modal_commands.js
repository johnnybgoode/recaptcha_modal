(function (Drupal) {
  Drupal.AjaxCommands.prototype.recaptchaModal = function (ajax, response, status) {
    Drupal.behaviors.recaptchaModal.renderRecaptcha(response.form_id);
  }

  Drupal.AjaxCommands.prototype.modalDisplay = function (ajax, response, status) {
    var modalElement = document.querySelector(response.selector);
    if (!modalElement) {
      return;
    }
    modalElement.classList.remove('js-hide');
    modalElement.classList.add('js-modal');
    document.querySelector('body').classList.add('overlay-stage');
  }

  Drupal.AjaxCommands.prototype.modalHide = function (ajax, response, status) {
    var modalElement = document.querySelector(response.selector);
    if (modalElement) {
      modalElement.classList.add('js-hide');
      modalElement.classList.remove('js-modal');
    }
    document.querySelector('body').classList.remove('overlay-stage');
  }
})(Drupal);
