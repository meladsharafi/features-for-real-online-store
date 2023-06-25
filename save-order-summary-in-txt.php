<?php

/**
 * Enqueue a script in the WordPress admin on edit.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function wpdocs_selectively_enqueue_admin_script($hook)
{
  if ('edit.php' != $hook) {
    return;
  }
  wp_enqueue_script('my_custom_script', FROS_DIR . 'order-summary.js', ['jquery'], filemtime(plugin_dir_path(__FILE__)  . 'order-summary.js'), true);
}
add_action('admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script');



// ADDING NEW COLUMNS WITH THEIR TITLES (keeping "Total" and "Actions" columns at the end)
add_filter('manage_edit-shop_order_columns', 'add_custom_column_to_orders', 20);
function add_custom_column_to_orders($columns)
{
  $reordered_columns = array();

  // Inserting columns to a specific location
  foreach ($columns as $key => $column) {
    $reordered_columns[$key] = $column;
    if ($key ==  'order_status') {
      // Inserting after "Status" column
      $reordered_columns['my-column1'] = 'خلاصه سفارش';
    }
  }
  return $reordered_columns;
}


// Adding custom fields meta data for each new column (example)
add_action('manage_shop_order_posts_custom_column', 'custom_orders_column_content', 20, 2);
function custom_orders_column_content($column, $post_id)
{

  $order = new WC_Order($post_id);

  if($order->get_status() != 'processing'){
    return;
  }
  
  // var_dump($order);
  $order_summary = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() . ' - ' .
    $order->get_billing_phone() . PHP_EOL .
    get_order_state_name_by_state_code($order) . ' - ' .
    $order->get_billing_city() . ' - ' .
    $order->get_billing_address_1() . ' - ' .
    $order->get_billing_postcode() . PHP_EOL;

  // Get and Loop Over Order Items
  foreach ($order->get_items() as $item_id => $item) {
    $product_name = $item->get_name();
    $order_summary .= '[' . $product_name . '×' . $item->get_quantity() . ']' . PHP_EOL;
  }

  switch ($column) {
    case 'my-column1':

      echo '
      <a id="orderDownloadButton" class="button orderDownloadButton" fileName="">دانلود فایل txt</a>
      <input id="orderId" class="orderId" type="text" value=' . $order->get_id() . ' hidden>
      <textarea id="orderSummaryContent" class="orderSummaryContent"  rows="4" cols="50"  hidden>' . $order_summary . '</textarea>      
      ';
      break;
  }
}

function get_order_state_name_by_state_code($order)
{
  //convert THR to Tehran
  $country_code = $order->get_shipping_country();
  $state_code   = $order->get_shipping_state();

  if ($country_code == '' || $state_code == '') {
    return '';
  }

  $countries = new WC_Countries(); // Get an instance of the WC_Countries Object
  $country_states = $countries->get_states($country_code); // Get the states array from a country code
  $state_name     = $country_states[$state_code]; // get the state name
  return $state_name;
}
