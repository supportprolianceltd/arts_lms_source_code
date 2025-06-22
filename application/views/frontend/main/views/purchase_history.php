<?php
echo <<<HTML
  <section class="page-section">
    <div class="main-section">
      <div class="section-header">
        <h2>Payment History</h2>
      </div>

      <div class="performance-Box">
        <div class="Sec-Table" id='jlist'>
        <table class="table">
          <thead>
            <tr>
              <th>S/N</th>
                <th><span> Courses</span></th>
                <th><span> Date</span></th>
                <th><span> Payment method</span></th>
                <th><span> Status</span></th>
                <th class='d-none'><span> Action</span></th>
            </tr>
        </thead>
        
          

          <tbody class='list'>
            $purchase_history_td
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
