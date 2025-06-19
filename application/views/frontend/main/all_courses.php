<?php
$norm_loop=true;
$top_courses=array();
$td_top_courses_file='td_top_courses_dash';
$enrols = $this->user_model->my_courses()->result_array();
foreach($enrols as $enrol) $top_courses[]=$this->crud_model->get_course_by_id($enrol['course_id'])->row_array();
$title='All';
require_once(__DIR__.'/course_list_grid.php');
require_once(__DIR__.'/views/all_courses.php');
?>
