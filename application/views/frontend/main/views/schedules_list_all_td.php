<?php
$schedules_list_td.=<<<HTML
<div class="classs-ses-Card">
    <h2>$schedule_type $status</h2>
    <h3>$schedule_title}</h3>
    <h3 class='$schedule_course_info_disp'>{$schedule_course['title']}</h3>
    <p>
        <span><i class="icon-calender"></i>$schedule_start_time_h</span>
        <span><i class="ti-timer"></i> Duration:&nbsp;<b>$schedule_duration_h</b></span>
    </p>
    
    <div class="classs-ses-Card-btn">
        <a href="$system_base_url/home/schedule_info/$schedule_id"><i class="ti-agenda"></i> View Schedule</a>
        <span>{$schedule['platform']}</span>
    </div>
</div>
HTML;
?>