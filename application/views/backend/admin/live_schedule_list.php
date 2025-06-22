<?php
$schedule_file=$schedule_file?$schedule_file:'live_schedule_td';
foreach ($schedules as $schedule){
    ++$schedule_i;
    $schedule_id=$schedule['id'];
    $schedule_user_id=$schedule['user_id'];
    $schedule_course_id=$schedule['course_id'];
    $schedule_start_time=$schedule['start_time'];
    $schedule_duration=$schedule['duration'];
    $schedule_platform=$schedule['platform'];
    $schedule_platform_link=$schedule['platform_link'];
    $schedule_note=$schedule['note'];
    $schedule_title=$schedule['title'];
    $schedule_active=$schedule['active'];
    $schedule_course=$this->crud_model->get_course_by_id($schedule_course_id)->row_array();
    $time=time();
    $schedule_start_time_stamp=strtotime($schedule_start_time);
    $schedule_start_date=date('Y-m-d',$schedule_start_time_stamp);
    $schedule_duration_stamp=strtotime($schedule_start_date.' '.$schedule_duration)-strtotime($schedule_start_date);
    $schedule_end_time_stamp=$schedule_start_time_stamp+$schedule_duration_stamp;
    $status=$schedule_active?($schedule_start_time_stamp>$time?"<span class='badge badge-info'>upcoming</span>":($schedule_end_time_stamp<$time?"<span class='badge badge-warning'>elapsed</span>":"<span class='badge badge-success'>ongoing</span>")):"<span class='badge badge-danger'>cancelled</span>";
    $schedule_edit_btn_disp=$schedule_end_time_stamp<$time?'d-none':null;
    //$schedule_edit_btn_disp=$schedule_end_time_stamp<$time || (($schedule_user_id!=$this->session->userdata('user_id') && $this->session->userdata('admin_login')) != true)?'d-none':null;
    
    $schedule_join_disp=$schedule_start_time_stamp<=$time && $schedule_end_time_stamp>$time?null:'d-none';
    $schedule_record_disp=$schedule_end_time_stamp<$time && $schedule_course_id?null:'d-none';

    $schedule_remaining_time_stamp=$schedule_end_time_stamp-$time;
    $schedule_start_time_h=date('g:ia, j,F,Y \G\M\T',strtotime($schedule_start_time));
    $schedule_duration_h=ltrim(substr($schedule_duration,0,5),'0').' hrs';
    $schedule_remaining_time_h=$schedule_remaining_time_stamp>86400?$schedule_start_time_h:(int)($schedule_remaining_time_stamp/3600).'h '.(int)(($schedule_remaining_time_stamp%3600)/60).'mins';

    $schedule_type=$schedule_course_id?'Course':'Event';
    $schedule_course_info_disp=$schedule_course_id?null:'d-none';

    include(__DIR__.'/'.$schedule_file.'.php');
}
?>