<?php
  $schedule=$this->crud_model->get_live_schedule($param2);
  $system_base_url=base_url();
  if($schedule) {
    $time=time();
    $user=$this->user_model->get_all_user($schedule['user_id'])->row_array();
    $course=$this->crud_model->get_course_by_id($schedule['course_id'])->row_array();
    $start_time_stamp=strtotime($schedule['start_time']);
    $start_date=date('Y-m-d',$schedule['start_time_stamp']);
    $duration_stamp=strtotime($start_date.' '.$schedule['duration'])-strtotime($start_date);
    $end_time_stamp=$start_time_stamp+$duration_stamp;
    $active=$schedule['active'];
    $status=$active?($start_time_stamp>$time?"<span class='badge badge-info'>upcoming</span>":($end_time_stamp<$time?"<span class='badge badge-warning'>elapsed</span>":"<span class='badge badge-success'>ongoing</span>")):"<span class='badge badge-danger'>cancelled</span>";

    $join_disp=$start_time_stamp<=$time && $end_time_stamp>$time?null:'d-none';
    $record_disp=$schedule['platform_record_link'] && $end_time_stamp<$time?$null:'d-none';
    $course_disp=$schedule['course_id']?null:'d-none';
    $type=$schedule['course_id']?'Course':'Event';

    $remaining_time_stamp=$end_time_stamp-$time;
    $start_time_h=date('g:ia, j,F,Y \G\M\T',strtotime($schedule['start_time']));
    $duration_h=ltrim(substr($schedule['duration'],0,5),'0').' hrs';
    $remaining_time_h=$remaining_time_stamp>86400?$start_time_h:(int)($remaining_time_stamp/3600).'h '.(int)(($remaining_time_stamp%3600)/60).'mins';

    echo <<<HTML
      <div class="card $record_disp">
        <video height='300' width='100%' id="player" playsinline controls style='max-height:300px !important;'>
            <source src="{$schedule['platform_record_link']}" type="video/mp4">
            <h4>Video url is not supported</h4>
        </video>
      </div>
      <table class=''>

        <tr>
          <td class='text-left'>Title:</td>
          <td class='text-left'>{$schedule['title']}</td>
        </tr>
        <tr>
          <td class='text-left'>Type:</td>
          <td class='text-left'><span class='badge badge-info'>$type</span></td>
        </tr>
        <tr>
          <td class='text-left'>Created by:</td>
          <td class='text-left'>{$user['first_name']}</td>
        </tr>
        <tr class='$course_disp'>
          <td class='text-left'>Course:</td>
          <td class='text-left'><a href='$system_base_url/user/course_form/course_edit/{$schedule['course_id']}'>{$course['title']}</a></td>
        </tr>
        <tr>
          <td class='text-left'>Start:</td>
          <td class='text-left'>$start_time_h</td>
        </tr>
        <tr>
          <td class='text-left'>Duration:</td>
          <td class='text-left'>$duration_h</td>
        </tr>
        <tr>
          <td class='text-left'>Platform:</td>
          <td class='text-left'>{$schedule['platform']}</td>
        </tr>
        <tr>
          <td class='text-left'>Platform link:</td>
          <td class='text-left'><a href='{$schedule['platform_link']}'>{$schedule['platform_link']}</a></td>
        </tr>
        <tr>
          <td class='text-left'>Pre-recorded video link:</td>
          <td class='text-left'><a href='{$schedule['platform_record_link']}'>{$schedule['platform_record_link']}</a></td>
        </tr>
        <tr>
          <td class='text-left'>Note:</td>
          <td class='text-left'>{$schedule['note']}</td>
        </tr>
        <tr>
          <td class='text-left'>Status:</td>
          <td class='text-left'>$status</td>
        </tr>
      </table>
HTML;
  }
  else echo "<div class='alert alert-error'><i class='mdi mdi-bell-outline mr-1'></i>Schedule not found</div>";
?>
