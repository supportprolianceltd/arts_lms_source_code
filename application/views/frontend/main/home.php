<?php
$banner_disp=$system_settings['footer_link']?null:"display:none !important;";
//$top_courses=$this->crud_model->get_courses_by_search_string()->result_array();
//$top_courses_categories=$this->crud_model->get_top_courses_categories("category_id",false);
//$top_courses_category_cards=$this->crud_model->get_top_courses_categories("category_id",false);

$top_courses_category_cards=$top_courses_categories=$this->crud_model->active_course_categories(0,null);
array_splice($top_courses_category_cards,3);
$category_cards_file='category_cards_file';
//require_once(__DIR__.'/course_list_grid.php');
#require not once because multiple category cards will be loaded
require(__DIR__.'/category_cards.php');
require_once(__DIR__.'/category_courses.php');
require_once(__DIR__.'/views/home.php');
?>
