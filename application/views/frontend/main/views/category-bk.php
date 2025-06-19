<?php
echo <<<HTML
  <section class="couseeee-Top-sec">
    <div class="main-container">
      <div class="GGF-Coursee">
        <h2>{$category['name']}</h2>
        <p>{$category['description']}</p>

      </div>
      <div class="GGF-Coursee-btns d-none">
        <button class="active-GGF-btn">All</button>
        <button>Courses</button>
        <button>Qualifications</button>
      </div>

    </div>
  </section>


<div class='$popular_categories_disp'>
  $category_top_courses_td
</div>

  <section class="abt-testi-sec">
    <div class="main-container">
    <div class='d-none$popular_categories_disp'><br>No courses...</div>
      <div class="abt-sec $popular_categories_disp">

        <div class="abt-Dlt">
          <div>
            <h6>{$category['name']} Courses</h6>
            <h2 class="big-text">A.R.T.S Quality {$category['name']} Training</h2>
            <p>{$category['description']}</p>
          </div>
        </div>

        <div class="abt-Img" data-aos="fade-up" data-aos-duration="1000" >
          <img src="$category_thumbnail" />
        </div>

      </div>

      


    </div>
  </section>
HTML;
?>