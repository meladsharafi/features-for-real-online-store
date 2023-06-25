<?php

/*
Plugin Name: امکانات خاص برای فروش آنلاین واقعی!!
Version: 1.0.0
Plugin URI: https://melad.ir
Description: ذخیره خلاصه سفارش در فایل متنی برای چاپ برچسب پستی | افزودن فیلد بارکد برای محصولات | ایجاد فاکتور فروش ساده برای فیش پرینتر
Author URI: https://melad.ir
Author: میلاد شرفی
Contributors: 
WC tested up to: 7.3.0
*/

if (!defined('ABSPATH')) {
  exit;
}
define('FROS_DIR', plugin_dir_url(__FILE__));
include_once 'save-order-summary-in-txt.php';
include_once 'add-product-barcode-field.php';
include_once 'brand-supplier.php';
