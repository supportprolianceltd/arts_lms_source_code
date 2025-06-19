<?php
echo <<<HTML

  
<body class="white-header-bg">

  <section class="couseeee-Top-sec uoija-ooa">
    <div class="main-container">
      <div class="GGF-Coursee">
        <h2>{$category['name']}</h2>
        <p class='d-none'>{$category['about']}</p>

      </div>
      <div class="GGF-Coursee-btns d-none">
        $categories_td
      </div>

      
    </div>
  </section>



  <section class="GEN-Main-COurse-Sec oiial-poa">
    <div class="main-container">
      <div class='d-none$top_courses_disp'><br>Empty ...</div>
      <div class="Gen-courses-main all $top_courses_disp">
        <div class="ouua">
          $td_top_courses
         </div><!--ouua-->
      </div>


    </div>
  </section>





  <section class="abt-testi-sec d-none">
    <div class="main-container">
      <div class="abt-sec">

        <div class="abt-Dlt">
          <div>
            <h6>{$category['name']}</h6>
            <h2 class="big-text">A.R.T.S {$category['name']}</h2>
            <p>{$category['about']}</p>
          </div>
        </div>

        <div class="abt-Img" data-aos="fade-up" data-aos-duration="1000" >
          <img src="$category_thumbnail" style='max-height:400px;'/
        </div>

      </div>

      


    </div>
  </section>
  
  </body>
HTML;
?>
