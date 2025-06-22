<?php
        $top_courses_category_card_td.=<<<HTML
        <div class="Gland-card" data-aos="fade-up" data-aos-duration="500" style='cursor:pointer;' onclick='location="$system_base_url/home/category/$categories_list_name_slug/{$categories_list['id']}"'>
                  <div class="Top-Gland-card">
                    <div class="Top-Gland-card-1">
                      <img src="$categories_list_thumbnail" />
                    </div>
                    <div class="Top-Gland-card-2">
                      <div>
                        <h4>{$categories_list['name']}</h4>
                        <span class='d-nonei'>{$categories_list['no_course']} courses</span>
                      </div>
                    </div>
                  </div>
                  <div class="sub-Gland-card">
                    <p>{$categories_list['about']}</p>
                    <div class="sub-Gland-card-Btns">
                      <!--$categories_list_badge-->
                      <a class='d-nonei' href="#"><i class="icon-book-open"></i>Course</a>
                      <a class='$categories_list_badge_disp' href="#"><i class="icon-badge"></i>Live</a>
                    </div>
        
                  </div>
                </div>
        HTML;
?>
