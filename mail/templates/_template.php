<?php
defined('THEME_BOOTSTRAPPED') or exit();

$template_subject = 'Account registration';

$template_head = function() use (&$data) { };

$template_body = function() use (&$data) { ?>

<p><strong><?= $data['field_pairs']['name_first'] ?>,</strong></p>
<h2>Thank-You!</h2>
<p>Your registration request has been recieved. We'll email you with
instructions to log in as soon as your request has been approved.</p>

<?php };
