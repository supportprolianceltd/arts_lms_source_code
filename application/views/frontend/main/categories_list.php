<?php
$categories_td_file=$categories_td_file?$categories_td_file:'categories_td_file';
$categories_list_disp='d-none';
foreach($categories_lists as $categories_list) {
    $categories_list_disp=null;
    $categories_list_name_slug=slugify($categories_list['name']);
    $categories_list_thumbnail=$categories_list['parent']?($categories_list['sub_category_thumbnail']?"$system_base_url/uploads/thumbnails/category_thumbnails/{$categories_list['sub_category_thumbnail']}":"$system_assets_base_url/img/category_icon.png"):($categories_list['thumbnail']?"$system_base_url/uploads/thumbnails/category_thumbnails/{$categories_list['thumbnail']}":"$system_assets_base_url/img/category_icon.png");
    $categories_list_booking_text=$categories_list['booking']?'Booking':'Course';
    $categories_list_badge=$categories_list['booking']?"<a href='#'><i class='icon-badge'></i>Book</a>":"<a href='#'><i class='icon-book-open'></i>Course</a>";
    $categories_list_badge_disp=$categories_list['booking']?null:'d-none';
    include(__DIR__."/views/$categories_td_file.php");
}
?>
