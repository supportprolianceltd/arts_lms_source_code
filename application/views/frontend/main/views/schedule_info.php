<?php
echo <<<HTML
<section class="page-section">
    <div class="main-section">

        <div class="Glandd-Sect">
          <div class="Glandd-Sect1">
            <div class="Glandd-Sect1-Box">
              <div class="section-header ujh-header">
                <h2>{$schedule['title']}</h2>
              </div>

            <div class="Glandd-Sect1-Part $schedule_course_info_disp">
              <h3>About {$schedule_course['title']}</h3>
              <ul>
                {$schedule_course['description']}
              </ul>
            </div>

          </div>


          </div>
          <div class="Glandd-Sect2">

            <div class="schedule-Box">
              <div class="schedule-Box-Top">
                <h2>Scheduled $schedule_type</h2>
                <span><i class="ti-timer d-none"></i> Duration: <b>$schedule_duration_h</b></span>
              </div>

              <div class="schedule-Box-Card $schedule_record_disp">
                <video height='300' width='100%' id="player" playsinline controls style='max-height:300px !important;'>
                    <source src="{$schedule['platform_record_link']}" type="video/mp4">
                    <h4>Video url is not supported</h4>
                </video>
              </div>

              <div class="schedule-Box-Card active">
                <h5>Note <span class='$schedule_remaining_time_disp'>Time left: $schedule_remaining_time_h</span></h5>
                <p>{$schedule['note']}</p>

                <div class="KKh-Driv">
                  <div class="KKh-Driv1">
                    <h4><span><i class="icon-calender"></i>Date:&nbsp;&nbsp;</span>$schedule_start_time_h</h4>
                    <h4><span><i class="icon-clock"></i> Duration:&nbsp;</span> $schedule_duration_h</h4>
                  </div>
                  <div class="KKh-Driv2 $schedule_join_disp">
                    <a href="{$schedule['platform']}" target='_blank'><i class="icon-camrecorder"></i>Join</a>
                  </div>
                  <div class="KKh-Driv2 d-none">
                    <a href="{$schedule['platform_record_link']}" target='_blank'><i class="fa fa-play-circle"></i>Watch Prerecorded video</a>
                  </div>
                  <div class="KKh-Driv2">
                    <span>{$schedule['platform']}</span>
                    $status
                  </div>
                </div>
              </div>

            </div>

            
          </div>
        </div>

 
      

    </div><!-- main-section -->
HTML;
?>