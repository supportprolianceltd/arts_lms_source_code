<?php
$search_string=$this->input->get('search_string');
$top_courses=$this->crud_model->get_courses_by_search_string($search_string)->result_array();
require(__DIR__.'/course_list_grid.php');
require_once(__DIR__.'/views/courses_page.php');
?>