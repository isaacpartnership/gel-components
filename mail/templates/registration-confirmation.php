<?php
defined('THEME_BOOTSTRAPPED') or exit();

/**
 * Registration Confirmation Template
 *
 * $data[] must include:
 *   - 'name' -- Full or first name
 *   - 'login_url' -- URL of login page (with email pre-fill parameter?)
 */

$template_subject = 'Thank-you for registering!';

$template_body = function() use (&$data) { ?>

<p><strong><?= $data['name'] ?>,</strong></p>
<h2>Welcome!</h2>
<p>Your registration has been successful. Click below to log in if you haven't already.</p>
<p><a class="form__button" href="<?= $date['login_url'] ?>">Log in</a></p>

<?php };
