<?php
$td_top_courses.=<<<HTML
<div class="item">

<a href="$top_course_url" class="courses-card">
<div class="top-CC-Card">
    <img src="$top_course_img_url" />
</div>
<div class="sub-CC-Card">
    <h2>{$top_course['title']}</h2>
    <p>{$top_course['short_description']}</p>

    <h4>
    <span class='rating' _average_rate='$top_course_average_ceil_rating'></span>
    
    <b>($top_course_number_of_ratings)</b>
    </h4>

  

    
     <h3><b class="HH3-Ammint">$top_course_final_price_currency</b> <span class="accredited-badge">{$top_course['level']}</span></h3>
     
      <h5>By <span>{$top_course_instructor_details['first_name']}</span></h5>
      
      
</div>
</a>

</div><!--item-->
HTML;
?>
