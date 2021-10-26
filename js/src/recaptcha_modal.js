(function(Drupal, drupalSettings) {
  Drupal.behaviors.recaptchaModal = {
    attach: context => {
      if (typeof drupalSettings['recaptcha_modal'] === 'undefined') {
        return;
      }
      if (typeof grecaptcha === 'undefined') {
        return;
      }

      for (let formID in drupalSettings['recaptcha_modal']['forms']) {
        if (!drupalSettings['recaptcha_modal']['forms'].hasOwnProperty(formID)) {
          continue;
        }
        Drupal.behaviors.recaptchaModal.renderRecaptcha(formID);
      }
    },
    renderRecaptcha: formID => {
      if (typeof grecaptcha.render !== 'function') {
        return;
      }
      const form = document.getElementById(formID);
      if (!form) {
        return;
      }
      const recaptchaContainer = form.querySelector('.recaptcha-modal-container');
      if (recaptchaContainer.innerHTML !== '') {
        return;
      }
      grecaptcha.render(recaptchaContainer, {
        sitekey: drupalSettings['recaptcha_modal']['recaptcha_site_key'],
        callback: (formID => {
          return token => {
            const form = document.getElementById(formID);
            const tokenInput = form.querySelector('.recaptcha-modal-token');
            tokenInput.value = token;
            let changeEvent = null;
            if (typeof document.createEvent === 'function') {
              changeEvent = document.createEvent('Event');
              changeEvent.initEvent('change', true, true);
            } else {
              changeEvent = new Event('change', {
                bubbles: true,
                cancelable: true,
              });
            }
            tokenInput.dispatchEvent(changeEvent);
          };
        })(formID),
        'expired-callback': (formID => {
          return token => {
            const form = document.getElementById(formID);
            form.querySelector('.recaptcha-modal-token').value = '';
          };
        })(formID),
      });
    },
  };
})(Drupal, drupalSettings);
