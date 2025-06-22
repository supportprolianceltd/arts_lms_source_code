<?php
echo <<<HTML
  <section class="page-section">
    <div class="main-section" id='jlist'>
      <div class="section-header">
        <h2>Your Courses</h2>
      </div>

      <div class="oova-clous-sec list">
        $td_top_courses
      </div>

   

      <div class="page-pegination d-none">
        <button><i class="icon-arrow-left"></i></button> 
        <span>Page 1</span> 
        <button><i class="icon-arrow-right"></i></button> 
    </div>
    <ul class="pagination"></ul>
      

    </div><!-- main-section -->
HTML;
?>
