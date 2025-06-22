<?php
$enrols = $this->user_model->my_courses()->result_array();
foreach($enrols as $enrol) $course_ids[]=$enrol['course_id'];
$schedule_time=date('Y-m-d H:i:s');

$live_schedules = $this->crud_model->fetch_live_schedule_join(1,'start_time',0,0,$user_id,true);
$upcoming_live_schedules = $this->crud_model->fetch_live_schedule_join(1,'start_time',0,0,$user_id,true,$schedule_time);
$ongoing_live_schedules = $this->crud_model->fetch_live_schedule_join(1,'start_time',0,0,$user_id,true,$schedule_time,0,$schedule_time);
$elapsed_live_schedules = $this->crud_model->fetch_live_schedule_join(1,'start_time',0,0,$user_id,true,0,$schedule_time);

/*
$live_schedules = $this->crud_model->fetch_live_schedule(null,0,$course_ids);
$upcoming_live_schedules = $this->crud_model->fetch_live_schedule(true,0,$course_ids,$schedule_time);
$ongoing_live_schedules = $this->crud_model->fetch_live_schedule(true,0,$course_ids,$schedule_time,0,$schedule_time);
$elapsed_live_schedules = $this->crud_model->fetch_live_schedule(null,0,$course_ids,0,0,$schedule_time);
*/

$today_date = strtotime(date('d M Y'));
$today_time = strtotime(date('h:i:s a'));

$assignments=$this->crud_model->fetch_assignments($course_ids);
$active_assignments=$this->crud_model->fetch_assignments($course_ids,$today_date,$today_time,1);
$elapsed_assignments=$this->crud_model->fetch_assignments($course_ids,$today_date,$today_time,-1);
$pending_assignments=array();

foreach($active_assignments as $active_assignment) {
    $submission=$this->crud_model->get_assignment_submision($user_id,$active_assignment['assignment_id']);
    if(!$submission) $pending_assignments[]=$active_assignment;
}

$no_assignments=count($assignments);
$no_active_assignments=count($active_assignments);
$no_elapsed_assignments=count($elapsed_assignments);
$no_pending_assignments=count($pending_assignments);

$no_live_schedules=count($live_schedules);
$no_ongoing_live_schedules=count($ongoing_live_schedules);
$no_upcoming_live_schedules=count($upcoming_live_schedules);
$no_elapsed_live_schedules=count($elapsed_live_schedules);
$no_active_live_schedules=$no_ongoing_live_schedules+$no_upcoming_live_schedules;

$live_schedules_note=$no_live_schedules?"<span class='badge badge-warning'>$no_live_schedules</span>":null;
$live_schedules_note=$no_live_schedules?"<span class='badge badge-warning'>$no_live_schedules</span>":null;
$live_schedules_note=$no_live_schedules?"<span class='badge badge-warning'>$no_live_schedules</span>":null;
$live_schedules_note=$no_live_schedules?"<span class='badge badge-warning'>$no_live_schedules</span>":null;

$completed_course_watch_historys = $this->crud_model->fetch_watch_histories($this->session->userdata('user_id'),0,100)->result_array();
$ongoing_course_watch_historys = $this->crud_model->fetch_watch_histories($this->session->userdata('user_id'),0,0)->result_array();
//foreach($course_watch_historys as $course_watch_history) $completed_courses[]=$this->crud_model->get_course_by_id($course_watch_history['course_id'])->row_array();
//$no_completed_courses=(int)count((array)$completed_courses);
$no_completed_courses=(int)count((array)$completed_course_watch_historys);
$no_ongoing_courses=(int)count((array)$ongoing_course_watch_historys);
$no_courses=count((array)$enrols);

$schedules=$live_schedules;

$msg_threads = $this->db->get('message_thread')->result_array();
foreach ($msg_threads as $ms_row) $no_of_unreaded_message+= $this->crud_model->count_unread_message_of_thread($ms_row['message_thread_code']);

require_once(__DIR__.'/head.php');
require_once(__DIR__.'/live_schedule_diary_modal.php');
require_once(__DIR__.'/views/logged_in_header.php');
?>
