<?php
$category_top_courses_items.=<<<HTML
<div class="item">

<a href="$category_top_course_url" class="courses-card">
<div class="top-CC-Card">
    <img src="$category_top_course_img_url" />
</div>
<div class="sub-CC-Card">
    <h2>{$category_top_course['title']}</h2>
    <p>{$category_top_course['short_description']}</p>

    <h4>$category_top_course_average_ceil_rating
    <span class='rating' _average_rate='$category_top_course_average_ceil_rating'></span>

    <b>($category_top_course_number_of_ratings Reviews)</b>
    </h4>

    <h3><b class="HH3-Ammint">$category_top_course_final_price_currency</b> <span class="accredited-badge">{$top_course['level']}</span></h3>
     
      <h5>By <span>{$top_course_instructor_details['first_name']}</span></h5>
</div>
</a>

</div><!--item-->
HTML;
?>

