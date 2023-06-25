<?php
add_action('pwb-brand_add_form_fields', 'sss');
function sss($fields)
{
  echo 'befor brand...';
}

//======================================== Add Custom Taxonomy insta
add_action('init', 'mel_brand_supplier');
function mel_brand_supplier()
{
  $labels = array(
    'name'              => _x('تامین کننده', 'taxonomy general name'),
    'singular_name'     => _x('mel_brand_supplier', 'taxonomy singular name'),
    'search_items'      => __('جستجوی تامین کنندگان'),
    'all_items'         => __('All Suppliers'),
    'parent_item'       => __('Parent Supplier'),
    'parent_item_colon' => __('Parent Supplier:'),
    'edit_item'         => __('Edit Supplier'),
    'update_item'       => __('Update Supplier'),
    'add_new_item'      => __('افزودن / تامین کننده جدید'),
    'new_item_name'     => __('New Supplier Name'),
    'menu_name'         => __('تامین کنندگان'),
  );
  $args   = array(
    'hierarchical'      => true, // make it hierarchical (like categories)
    'labels'            => $labels,
    'show_ui'           => true,
    'query_var'         => true,
    'public'            => true,
    'show_admin_column' => true,
    'show_in_rest'      => true,
    'rewrite'           => ['slug' => 'mel_brand_supplier','hierarchical' => true,],
  );
  register_taxonomy('mel_brand_supplier', ['product'], $args);
}
