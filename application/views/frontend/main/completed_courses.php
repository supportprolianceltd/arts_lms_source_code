<?php
$norm_loop=true;
$top_courses=array();
$td_top_courses_file='td_top_courses_dash';
$course_watch_historys = $this->crud_model->fetch_watch_histories($this->session->userdata('user_id'),0,true)->result_array();
foreach($course_watch_historys as $course_watch_history) $top_courses[]=$this->crud_model->get_course_by_id($course_watch_history['course_id'])->row_array();
$title='Completed';
require_once(__DIR__.'/course_list_grid.php');
require_once(__DIR__.'/views/all_courses.php');
?>
