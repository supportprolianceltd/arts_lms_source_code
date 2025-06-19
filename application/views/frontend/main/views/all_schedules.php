<?php
echo <<<HTML
  <section class="page-section">
    <div class="main-section">
      <div class="section-header">
        <h2>$title Classes</h2>
      </div>

      <div class="oova-clous-sec" id='jlist'>

        <div class="classs-ses-Grid list">
          $schedules_list_td

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
