<?php
echo <<<HTML

<body class="white-header-bg">
  <section class="couseeee-Top-sec seacrhj-oola">
    <div class="main-container">
      <div class="GGF-Coursee">
        <h6>
          <span>Courses</span>
          <i class="ti-angle-right"></i>
          <a href="$systtem_base_url/home">Search</a>
        </h6>
        <h2>$search_string</h2>
        <p>$feedback_text</p>

      </div>

    </div>
  </section>



  <section class="GEN-Main-COurse-Sec">
    <div class="main-container">
      <div class="courses-main healthcare" id='jlist'>
        <div class="CCC-Ownlo-Grid list">
          $td_top_courses
        </div>

        <ul class="pagination"></ul>
      </div>
    </div>
  </section>





  <section class="geti-sec">
    <div class="main-container">
      <div class="geti-main">
        <div class="geti-Box">
        <h2 class="large-text">Improving lives through learning</h2>
        <a href="$system_base_url/home/book_class">Book a class now</a>
      </div>
      </div>
    </div>
  </section>

    </body>
HTML;
?>
