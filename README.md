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
