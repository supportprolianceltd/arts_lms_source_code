<?php
//$top_courses_categories=$top_courses_categories?$top_courses_categories:$this->crud_model->get_top_courses_categories("category_id",false);
$popular_categories_disp='d-none';
$category_courses_td_file=$category_courses_td_file?$category_courses_td_file:'category_courses_td';
if(count((array)$top_courses_categories)){
    $active_btn='active-courses-btn';
    foreach($top_courses_categories as $top_courses_category_details){
        //$top_courses_category_details=$this->crud_model->get_category_details_by_id($top_courses_category['category_id'])->row_array();
        $top_courses_categories_button.="<button class='$active_btn'>{$top_courses_category_details['name']}</button>";
        $active_btn=null;
        $category_top_courses=(array)$this->crud_model->get_category_wise_courses($top_courses_category_details['id'])->result_array();
        $top_courses_category_details_name_slug=slugify($top_courses_category_details['name']);
        $popular_categories_disp=$category_top_courses?null:'d-none';
        $category_top_courses_items=null;
        $top_courses=$category_top_courses;
        $td_top_courses_temp=$td_top_courses;
        $td_top_courses_file_temp=$td_top_courses_file;
        $td_top_courses=null;
        $td_top_courses_file='td_top_courses';
        require(__DIR__.'/course_list_grid.php');
        include(__DIR__."/views/$category_courses_td_file.php");
    }
    $td_top_courses=$td_top_courses_temp;
    $td_top_courses_file=$td_top_courses_file_temp;
}
?>
