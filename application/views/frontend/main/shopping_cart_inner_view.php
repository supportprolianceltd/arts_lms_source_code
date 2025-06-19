<?php
$cart_items = (array)$this->session->userdata('cart_items');
$num_cart_items=count($cart_items);
require_once(__DIR__.'/shopping_cart_inner.php');
require_once(__DIR__.'/views/shopping_cart_inner_view.php');
?>