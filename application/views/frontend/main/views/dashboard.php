<?php
echo <<<HTML
  <section class="page-section">
    <div class="main-section">
                   
      <div class="section-header">
        <h2>Welcome back {$user_details['first_name']}!</h2>
        <p class="mobil-pP d-none">Student since - 01 January 2025</p>
      </div>
      <div class="Top-Dash-SeCc">
        <div class="Top-Dash-1">
          <div class="Top-Dash-10">
            <img src="$user_profile_photo" />
          </div>
          <div class="Top-Dash-11">
            <a href="$system_base_url/home/profile/user_profile"><i class="ti-pencil-alt"></i>Edit Profile</a>
            <div class="DDaj-Dnt">
              <h4>Student</h4>
              <p>Dashboard - overview</p>
            </div>
          </div>
        </div>
        <div class="Top-Dash-2">
          <div class="Top-Dash-2-Cards">
          
      
            <a href="$system_base_url/home/all_courses" class="TtDash-Card">
              <div class="TtDash-Cards-1">
                <i class="icon-book-open"></i>
              </div>
              <div class="TtDash-Cards-2">
                <div>
                  <h3>$no_top_courses</h3>
                  <p>Your Courses</p>
                </div>
              </div>
            </a>
      
            <a href="$system_base_url/home/completed_courses" class="TtDash-Card">
              <div class="TtDash-Cards-1">
                <i class="icon-check"></i>
              </div>
              <div class="TtDash-Cards-2">
                <div>
                  <h3>$no_completed_courses</h3>
                  <p>Completed Courses</p>
                </div>
              </div>
            </a>

            <a href="$system_base_url/home/ongoing_courses" class="TtDash-Card d-none">
              <div class="TtDash-Cards-1">
                <i class="icon-check"></i>
              </div>
              <div class="TtDash-Cards-2">
                <div>
                  <h3>$no_ongoing_courses</h3>
                  <p>Ongoing Courses</p>
                </div>
              </div>
            </a>
      
            <a href="$system_base_url/home/ongoing_schedules" class="TtDash-Card">
              <div class="TtDash-Cards-1">
                <i class="icon-camrecorder"></i>
              </div>
              <div class="TtDash-Cards-2">
                <div>
                  <h3>$no_ongoing_live_schedules</h3>
                  <p>Ongoing Classes</p>
                </div>
              </div>
            </a>

            <a href="$system_base_url/home/upcoming_schedules" class="TtDash-Card">
              <div class="TtDash-Cards-1">
                <i class="icon-hourglass"></i>
              </div>
              <div class="TtDash-Cards-2">
                <div>
                  <h3>$no_upcoming_live_schedules</h3>
                  <p>Upcoming Schedules</p>
                </div>
              </div>
            </a>
      
            <a href="$system_base_url/home/elapsed_schedules" class="TtDash-Card d-none">
              <div class="TtDash-Cards-1">
                <i class="icon-camrecorder"></i>
              </div>
              <div class="TtDash-Cards-2">
                <div>
                  <h3>$no_elapsed_live_schedules</h3>
                  <p>Elapsed Schedules</p>
                </div>
              </div>
            </a>
      
          </div>
          <div class="Top-Dash-2-Foot d-none">
            <a href="explore-courses.html"><i class="ti-book"></i> <span>Explore courses</span></a>
            <p>Student since - 01 January 2025</p>
          </div>
        </div>
      </div>
      


      <div class="Resnt-Sect">
        <div class="Resnt-Sect-1">
          <div class="CCL-Envn" id='jlist'>
            <div class="CCL-Envn-header">
              <h3>Latest Courses</h3>
            </div>
            <div class="CCL-Secs list">
              $td_top_courses
            </div>

              <div class="page-pegination d-none">
                <button><i class="icon-arrow-left"></i></button>
                <span>Page 1</span>
                <button><i class="icon-arrow-right"></i></button>
            </div>
            <ul class="pagination"></ul>
          </div>
        </div>
        <div class="Resnt-Sect-2">
          <div class="Latest-event-Box">
            <div class="Latest-event-Box-header">
              <h3>Ongoing classes</h3>
              <span>$no_ongoing_live_schedules</span>
            </div>
            <div class="Latest-event-Box-body">
              $schedules_td

              <a href="$system_base_url/home/upcoming_schedules" class="event-Box-Card current-event">
                <h4>Upcoming schedules <span>$no_upcoming_live_schedules</span></h4>
                <p class='d-none'><i class="icon-calender"></i>2/23/2025</p>
              </a>
              

            </div>
          </div>
        </div>
      </div>


    </div><!-- main-section -->
HTML;
?>
