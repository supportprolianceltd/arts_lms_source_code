<?php
$schedules_list_td.=<<<HTML
<a href="$system_base_url/home/schedule_info/$schedule_id" class="event-Box-Card">
    <h4>$schedule_type <span>$schedule_duration_h</span></h4>
    <p><i class="icon-calender"></i>$schedule_start_time_h</p>
</a>
HTML;
?>