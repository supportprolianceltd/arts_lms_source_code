<?php
        $category_top_courses_td.=<<<HTML

      <div class="courses-sec $popular_categories_disp">
        <div class="courses-header ooia-paol">
          <h3>{$top_courses_category_details['name']}  </h3>
          
          <a href="$system_base_url/home/category/$top_courses_category_details_name_slug/{$top_courses_category_details['id']}" class="oiakka-Ahf">View all</a>

          <div class="courses-main {$top_courses_category_details['name']}">
            <div class="owl-carousel owl-theme courses-owl">
              $td_top_courses
            </div><!--owl-->
          </div>

        </div>
      </div>
HTML;
?>


<style>
    .ooia-paol{
        display:flex;
        align-items:center;
        justify-content:space-between;
        flex-wrap:wrap;
        gap:20px;
    }

        .ooia-paol a.oiakka-Ahf{
             color:#3F8AEF;
        font-size:12px;
        text-decoration: underline;
        }
        .ooia-paol a.oiakka-Ahf:hover{
            text-decoration: none;
        }
</style>
