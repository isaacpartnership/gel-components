### Our little mail tempating system

This mailing system was originally built for Adfecto's automated mail, but it
can be re-used for other projects that use PHP.

Templates can easily be added and then used in the application. Templates are
stored in the `templates/` directory and are named `<slug>.php`, where `slug` is
a name given to the template to identify it by. There is also `base` template
kept in this directory, which the others all use. The `base` template includes
the basic structure of the email; HTML `<head>`, header, content column, and
footer. Only the email subject line and content of the content section is
handled by the custom templates.

A custom template file should do the following:

* Set `$template_subject` to a string containing the subject of the email.

* Set `$template_body` to a lambda function which echoes the content of the main
  email section.

A template file may also, optionally, do the following:

* Set `$template_title` to a string to be used in the email's `<title>` element.
  This should generally be the same as the subject line, and will therefore
  default to the subject line if the template doesn't set it.

* Set `$template_head` to a lambda function which echoes content to be inserted
  before the end of the `<head>` element. This could potentially be used to set
  come extra meta tags in the HTML. If this is supplied, it will default
  to an empty function that will have no effect.

*__Note:__ this bit needs writing*

Normally mail in PHP is sent with `mail()`, but this system has a wrapper
function `send_mail()` which simplifies this a little. It is kept in the
`sender.php` file.

    $data = [
        'name' => 'Barry Darren',
        'basket' => [
            [
                'title' => 'Thing 1',
                'price' => 123.45,
            ],
            [
                'title' => 'Thing 2 with a bit of a longer title to push things to the limit',
                'price' => 54,
            ],
        ],
        'view_orders_url' => 'http://temp.local/account/orders/',
    ];

    list($subject, $body) = interpolate_template('order-complete', $data);
    send_mail($to, $subject, $body);
