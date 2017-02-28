<?php
defined('THEME_BOOTSTRAPPED') or exit();

/**
 * Newsletter Subscription Confirmation Template
 *
 * $data[] must include:
 *   - 'name' -- Full or first name
 */

$template_subject = 'Thank-you for subscribing!';

$template_body = function() use (&$data) {
    global $site_name;
?>

<p><strong><?= $data['name'] ?>,</strong></p>
<h2>Thank-You!</h2>
<p>Your subscription to the <?= $site_name ?> newsletter was successful.</p>

<?php };
