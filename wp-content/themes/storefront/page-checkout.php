<?php
/* Template Name: Checkout̉ */
?>

<?php
if(is_user_logged_in()) {
   echo '[woocommerce_checkout]';
} else {
    echo 'you can login';
}
?>
