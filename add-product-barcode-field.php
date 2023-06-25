<?php
//Add barcode to the product inventory tab
add_action('woocommerce_product_options_inventory_product_data', 'add_barcode');
function add_barcode()
{
  global $woocommerce, $post;
  woocommerce_wp_text_input(
    array(
      'id'          => '_barcode',
      'label'       => __('Barcode', 'woocommerce'),
      'placeholder' => 'بارکد محصول را وارد کنید',
      'desc_tip'    => 'true',
      'description' => __('می توانید بار کد محصول را اسکن کنید، یا به صورت دستی آن را وارد کنید.', 'woocommerce')
    )
  );
}
//Save Barcode Field
add_action('woocommerce_process_product_meta', 'add_barcode_save');
function add_barcode_save($post_id)
{
  if (isset($_POST['_barcode'])) {
    update_post_meta($post_id, '_barcode', sanitize_text_field($_POST['_barcode']));
  } else {
    delete_metadata('product', $post_id, '_barcode',);
  }
}
//Set POS Custom Code
add_filter('woocommerce_pos_barcode_meta_key', 'pos_barcode_field');
function pos_barcode_field()
{
  return '_barcode';
}

// $product = wc_get_product( $product_id );
// echo $product->get_meta( '_barcode' );