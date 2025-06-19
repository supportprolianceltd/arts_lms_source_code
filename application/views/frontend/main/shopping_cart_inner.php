<?php
$price=0;
$discounted_price=0;
$course_final_price=0;
$top_courses=[];
foreach($cart_items as $item) {
    $temp = $this->crud_model->get_course_by_id($item)->row_array();
    $top_courses[]=$temp;
    if(!$temp['is_free_course']){
        $price+=$temp['price'];
        if($temp['discount_flag']) {
            $discounted_price+=$temp['discounted_price'];
            $course_final_price+=$temp['discounted_price'];
        }
        else $course_final_price+=$temp['price'];
    }
}
$course_price_currency=currency($price);
$course_discounted_price_currency=currency($discounted_price);
$course_final_price_currency=currency($course_final_price);
$course_price=$discounted_price && $price?"<h3>$course_final_price_currency</h3><span>$course_price_currency</span>":"<h3>$course_final_price_currency</h3>";

$td_top_courses_file='td_shopping_cart_items';
require(__DIR__.'/course_list_grid.php');
require_once(__DIR__.'/views/shopping_cart_inner.php');
?>