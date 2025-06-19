<?php
        $top_courses_category_card_td.=<<<HTML
        <div class="Gland-card" data-aos="fade-up" data-aos-duration="500" style='cursor:pointer;' onclick='location="$system_base_url/home/category/$top_courses_category_card_name_slug/{$top_courses_category_card['id']}"'>
                  <div class="Top-Gland-card">
                    <div class="Top-Gland-card-1">
                      <img src="$top_courses_category_card_thumbnail" />
                    </div>
                    <div class="Top-Gland-card-2">
                      <div>
                        <h4>{$top_courses_category_card['name']}</h4>
                        <span class='d-nonei'>$no_top_courses_card courses</span>
                      </div>
                    </div>
                  </div>
                  <div class="sub-Gland-card">
                    <p>{$top_courses_category_card['about']}</p>
                    <div class="sub-Gland-card-Btns">
                      <!--$top_courses_category_card_badge-->
                      <a href="#" class='d-nonei'><i class="icon-book-open"></i>Course</a>
                      <a href="#" class='$top_courses_category_card_badge_disp'><i class="icon-badge"></i>Live</a>
                    </div>
        
                  </div>
                </div>
        HTML;
?>
