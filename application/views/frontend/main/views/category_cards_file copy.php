<?php
        $top_courses_category_card_td.=<<<HTML
        <div class="Gland-card" data-aos="fade-up" data-aos-duration="500" style='cursor:pointer;' onclick='location="$system_base_url/home/category/$category_top_courses_category_card_details_name_slug/{$category_top_courses_category_card_details['id']}"'>
                  <div class="Top-Gland-card">
                    <div class="Top-Gland-card-1">
                      <img src="$category_top_courses_category_card_details_thumbnail" />
                    </div>
                    <div class="Top-Gland-card-2">
                      <div>
                        <h4>{$category_top_courses_category_card_details['name']}</h4>
                        <span class='d-nonei'>$no_category_top_courses_card courses</span>
                      </div>
                    </div>
                  </div>
                  <div class="sub-Gland-card">
                    <p>{$category_top_courses_category_card_details['about']}</p>
                    <div class="sub-Gland-card-Btns">
                      <!--$category_top_courses_category_card_details_badge-->
                      <a href="#" class='d-nonei'><i class="icon-book-open"></i>Course</a>
                      <a href="#" class='$category_top_courses_category_card_details_badge_disp'><i class="icon-badge"></i>Live</a>
                    </div>
        
                  </div>
                </div>
        HTML;
?>
