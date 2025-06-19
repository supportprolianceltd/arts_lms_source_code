<?php
$top_courses_categories=$this->crud_model->active_course_categories(0,null);
$banner_disp=$system_settings['footer_link']?null:"display:none !important;";
require_once(__DIR__.'/category_courses.php');
require_once(__DIR__.'/views/choose_course.php');
?>
