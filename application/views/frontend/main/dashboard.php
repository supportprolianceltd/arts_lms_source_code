<?php
$norm_loop=true;
$top_courses=array();
$completed_courses=array();
$schedules_list=$ongoing_live_schedules;
$td_top_courses_file='td_top_courses_dash';

foreach($enrols as $enrol) $top_courses[]=$this->crud_model->get_course_by_id($enrol['course_id'])->row_array();
//if(!$course_details) $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
require_once(__DIR__.'/schedules_list.php');
require_once(__DIR__.'/course_list_grid.php');
require_once(__DIR__.'/views/dashboard.php');
?>
