<?php
$top_courses_category_cards=$this->crud_model->get_categories()->result_array();
array_splice($top_courses_category_cards,4);
$category_cards_file='header_category_cards_file';
#require not once because multiple category cards will be loaded
require(__DIR__.'/category_cards.php');
require_once(__DIR__.'/head.php');
require_once(__DIR__.'/views/header.php');
//var_dump($top_courses_category_cards);
$top_courses_category_cards=null;
$categories_lists=null;
$top_courses_category_card_td=null;
$top_courses_sub_category_card_td=null;
?>
