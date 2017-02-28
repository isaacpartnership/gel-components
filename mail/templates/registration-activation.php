<?php
defined('THEME_BOOTSTRAPPED') or exit();

/**
 * Registration Activation Template
 *
 * $data[] must include:
 *   - 'name' -- Full or first name
 *   - 'activation_url' -- URL of activation page (with token?)
 */

$template_subject = 'Confirm your email address';

$template_body = function() use (&$data) { ?>

<p><strong><?= $data['name'] ?>,</strong></p>
<h2>Nearly there</h2>
<p>Your account registration is almost complete. Follow the link below to confirm your email address and activate your account.</p>
<p><a class="form__button" href="<?= $data['activation_url'] ?>">Activate account</a></p>

<?php };
