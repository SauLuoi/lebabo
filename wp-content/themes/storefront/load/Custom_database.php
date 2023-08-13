<?php
//function registerCustomer(){
//    global $wpdb;
//    $charsetCollate = $wpdb->get_charset_collate();
//    $registerCustomerTable = $wpdb->prefix . 'register_customer'; // tạo tên bảng trong databse
//    $createContactTable = "CREATE TABLE IF NOT EXISTS `{$registerCustomerTable}` (
//            `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
//            `firstName` varchar(255) NOT NULL,
//            `lastName` varchar(255) NOT NULL,
//            `email` varchar(255) NOT NULL,
//            `phone` varchar(20) NULL,
//            `password` varchar(20) NULL,
//            PRIMARY KEY (`id`)
//        ) {$charsetCollate};";
//    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//    dbDelta( $createContactTable );
//}
//
//add_action('init', 'registerCustomer');
//?>
