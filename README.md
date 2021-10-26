# ReCAPTCHA Modal

This module allows developers to embed a ReCAPTCHA v2 challenge into any form as an interstitial modal that appears when the form is submitted. This enables any/all forms to contain a required ReCAPTCHA challenge without the challenge being visible in the form itself and potentially disturbing the site design or layout.

## Prerequesites
1. A Google reCAPTCHA API key (v2 checkbox) is required in order to use this module. Visit https://www.google.com/recaptcha/admin/create to create an API key.

## Installation Instructions
1. Require the `key` module (`composer require drupal/key`)
2. Place the module into your Drupal code base and enable
3. Navigate to Admin > Configuration > System > Keys and create a Key to store your reCAPTCHA secret key.
4. Navigate to Admin > Configuration > Services > ReCAPTCHA and enter your reCAPTCHA site key.
5. On the ReCAPTCHA configuration page, select the ReCAPTCHA secret key created in step 3.
6. Build the Javascript artifacts `npm install && gulp build`

## Testing Instructions
1. Enable the 'Recaptcha Modal Test' module
2. Navigate to '/tests/recaptcha_modal'
3. Fill out the form and verify that the reCAPTCHA challenge is presented before the success message is displayed.

## Developer Instructions
1. Implement `hook_recaptcha_modal_enabled_forms_alter` to enable the challenge on specific forms.
2. Edit the enabled forms and add the render key `#recaptcha_modal` to the submit button which should trigger the modal. This is usually the main submit button but may be one or more other buttons on a complex form.
3. See the included `recaptcha_modal_test` module as an example.
