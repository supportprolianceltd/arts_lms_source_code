<?php
if(!$course_details) $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
require_once(__DIR__.'/course_details.php');
require_once(__DIR__.'/views/course_page.php');
?>