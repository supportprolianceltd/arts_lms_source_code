<?php
$category_cards_file=$category_cards_file?$category_cards_file:'category_cards_file';
//$top_courses_category_cards=$top_courses_category_cards?$top_courses_category_cards:$this->crud_model->get_top_courses_categories("category_id",false);
$popular_category_cards_disp='d-none';
if(count((array)$top_courses_category_cards)){
    $active_btn='active-courses-btn';
    foreach($top_courses_category_cards as $top_courses_category_card){
        $category_top_courses_category_card_details=$this->crud_model->get_category_details_by_id($top_courses_category_card['category_id'])->row_array();
        $category_top_courses_card=(array)$this->crud_model->get_category_wise_courses($category_top_courses_category_card_details['id'])->result_array();
        $no_category_top_courses_card=count((array)$category_top_courses_card);
        $category_top_courses_category_card_details_booking_text=$category_top_courses_category_card_details['booking']?'Booking':'Course';
        $category_top_courses_category_card_details_badge=$category_top_courses_category_card_details['booking']?"<a href='#'><i class='icon-badge'></i>Book</a>":"<a href='#'><i class='icon-book-open'></i>Course</a>";
        $category_top_courses_category_card_details_badge_disp=$category_top_courses_category_card_details['booking']?null:'d-none';
        $category_top_courses_category_card_details_name_slug=slugify($category_top_courses_category_card_details['name']);
        $category_top_courses_category_card_details_thumbnail=$category_top_courses_category_card_details['thumbnail']?"$system_base_url/uploads/thumbnails/category_thumbnails/{$category_top_courses_category_card_details['thumbnail']}":"$system_assets_base_url/img/category_icon.png";

        //If category array is supplied, normally expects course list in foreach
        $top_courses_card=(array)$this->crud_model->get_category_wise_courses($top_courses_category_card['id'])->result_array();
        $no_top_courses_card=count((array)$top_courses_card);
        $top_courses_category_card_booking_text=$top_courses_category_card['booking']?'Booking':'Course';
        $top_courses_category_card_badge=$top_courses_category_card['booking']?"<a href='#'><i class='icon-badge'></i>Book</a>":"<a href='#'><i class='icon-book-open'></i>Course</a>";
        $top_courses_category_card_badge_disp=$top_courses_category_card['booking']?null:'d-none';
        $top_courses_category_card_name_slug=slugify($top_courses_category_card['name']);
        $top_courses_category_card_thumbnail=$top_courses_category_card['thumbnail']?"$system_base_url/uploads/thumbnails/category_thumbnails/{$top_courses_category_card['thumbnail']}":"$system_assets_base_url/img/category_icon.png";
        include(__DIR__."/views/$category_cards_file.php");
        $active_btn=null;
    }
    $popular_category_cards_disp=null;
}
?>
