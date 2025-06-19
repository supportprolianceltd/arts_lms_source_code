<?php
$booking_text=$booking==1?'Book live classes':'Categories';
$categories_td_file='all_category_cards_file';
$categories_lists=$this->crud_model->active_course_categories($parent,$booking);
require(__DIR__.'/categories_list.php');
require_once(__DIR__.'/views/all_category.php');
?>
