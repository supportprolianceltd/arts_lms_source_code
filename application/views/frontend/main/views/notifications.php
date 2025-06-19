<?php
echo <<<HTML
  <section class="page-section">
    <div class="main-section">
      <div class="section-header">
        <h2>Notifications</h2>
      </div>

      <div class="performance-Box" id='jlist'>
        <div class="Noticte-MM-Sec list">
          $notifications_td
        </div>
          <ul class="pagination"></ul>
      </div>

      <div class="page-pegination d-none">
        <button><i class="icon-arrow-left"></i></button> 
        <span>Page 1</span> 
        <button><i class="icon-arrow-right"></i></button> 
    </div>

      

    </div><!-- main-section -->
HTML;
?>
