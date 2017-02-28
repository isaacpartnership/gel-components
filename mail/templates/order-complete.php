<?php
defined('THEME_BOOTSTRAPPED') or exit();

/**
 * Completed Order Template
 *
 * $data[] must include:
 *   - 'name' -- Full or first name
 *   - 'basket' -- List of items purchased and for what price
 *     - 'title' -- Name of item
 *     - 'price' -- Price in GBP as float number
 *   - 'view_orders_url' -- URL of past orders page
 */

$template_subject = 'Order summary';

$template_body = function() use (&$data) {

    setlocale(LC_MONETARY, 'en_GB');
    $format_price = function($price) {
        return money_format('%.2n', $price);
    };

    $basket_markup = '';
    if (isset($data['basket'])) {
        $total = 0;
        $basket_markup .= '<table><col style="width:80%"></col>';
        $basket_markup .= '<col style="width:20%"></col><thead><tr>';
        $basket_markup .= '<th>Item</th><th class="table__cell--price">Cost';
        $basket_markup .= '</th></tr><tr><thead><tbody>';
        foreach ($data['basket'] as &$item) {
            $total += $item['price'];
            $price_str = $format_price($item['price']);
            $basket_markup .= "<tr><td>{$item['title']}</td><td class=";
            $basket_markup .= "\"table__cell--price\">{$price_str}</td></tr>";
        }
        $total_str = $format_price($total);
        $basket_markup .= "<tr class=\"table__row--total\"><th>Total</th>";
        $basket_markup .= "<td class=\"table__cell--price\">{$total_str}</td></tr>";
        $basket_markup .= '</tbody></table>';
    }
?>

<p><strong><?= $data['name'] ?>,</strong></p>
<h2>Thank-you!</h2>
<p>Your booking was successful. Below is a summary of your order.</p>
<?= $basket_markup ?>
<p><a class="form__button" href="<?= $data['view_orders_url'] ?>">View all orders</a></p>

<?php };
