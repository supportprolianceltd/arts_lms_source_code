<?php
echo <<<HTML
  <section class="page-section">
    <div class="main-section">
      <div class="section-header">
        <h2>Performance statistics</h2>
      </div>

      <div class="performance-Box">
        <div class="Sec-Table" id='jlist'>
        <table class="table">
          <thead>
            <tr>
              <th>S/N</th>
                <th><span><i class="icon-book-open"></i> Courses</span></th>
                <th><span><i class="icon-graduation"></i> Learning Method</span></th>
                <th><span><i class="icon-trophy"></i> Course Completion</span></th>
                <th><span><i class="icon-chart"></i> Assessment Score</span></th>
                <th class='d-none'><span><i class="icon-bubble"></i> Remark</span></th>
                <th><span><i class="icon-eye"></i> Action</span></th>
            </tr>
        </thead>
        
          

          <tbody class='list'>
            $td_top_courses
          </tbody>

        </table>
        <ul class="pagination"></ul>
      </div>
      
      </div>

      <div class="page-pegination d-none">
        <button><i class="icon-arrow-left"></i></button> 
        <span>Page 1</span> 
        <button><i class="icon-arrow-right"></i></button> 
    </div>
 
      

    </div><!-- main-section -->
HTML;
?>
