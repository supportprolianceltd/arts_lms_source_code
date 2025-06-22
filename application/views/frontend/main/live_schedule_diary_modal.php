<?php
  $system_base_url=base_url();
  $live_schedules_diary = $this->crud_model->fetch_live_schedule_join(null,'start_time',1,0,$user_id);
  $schedule_groups=[];
  $time_now=date('d-m-Y');
  $_time_stamp=strtotime($time_now);
  $_now=0;
  foreach($live_schedules_diary as $s) {
    $_i++;
    //echo "<br>$_i={$s['start_time']}<br>";
    $s_start_time_stamp=strtotime($s['start_time']);
    $s_start_time_base_date=date('d-m-Y',$s_start_time_stamp);
    $s_start_time_base_date_stamp=strtotime($s_start_time_base_date);
    if(!$_now && $_time_stamp<=$s_start_time_base_date_stamp) {
      $_now=$_i;
       //echo "<br>$_time_stamp<=$s_start_time_base_date_stamp _now=$_now<br>";
      if($_time_stamp<$s_start_time_base_date_stamp) {
        //$_now--;
        //echo "<br>$_time_stamp<$s_start_time_base_date_stamp _now--=$_now<br>";
        $schedule_groups[$time_now][]=null;
      }
    }
    $schedule_groups[$s_start_time_base_date][]=$s;
  }
  if(!$_now) {
    $_now=$_i+1;
    $schedule_groups[$time_now][]=null;
    //echo "$_now $_i";
  }

  if($schedule_groups){
    foreach($schedule_groups as $key => $schedule_group){

        $td_schedule=null;
        foreach($schedule_group as $schedule) {
          $time=time();
          $_user_id=$schedule['user_id'];
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

          $status_class=$remaining_time_stamp>0?($start_time_stamp<=$time?'ongoing':'upcoming'):'elapsed';
          $remaining_time_disp=$remaining_time_stamp>0 && $remaining_time_stamp<86400?null:'d-none';

          $edit_btn_disp=$end_time_stamp<$time || ($_user_id!=$this->session->userdata('user_id') && $this->session->userdata('admin_login') != true) ||true?'d-none':null;

          if($schedule){
            $td_schedule.=<<<HTML
              <div class='col-sm-4 p-1 $status_class schedule-hover rounded'>
                <a class='text-decoration-none' target='_blank' href='$system_base_url/home/schedule_info/{$schedule['id']}'>
                  <div>
                    <p class='m-1'><span class='lead'>{$schedule['title']} </span><span class='badge badge-info'> $type</span> <span class='badge status_class'>$status_class</span> </p>
                    <p class='m-1'>Time: $start_time_h <span class='$remaining_time_disp'>in $remaining_time_h</span></p>
                    <p class='m-1'>Platform: {$schedule['platform']}</p>
                  </div>
                </a>
                <div class='text-right p-1 edit_link $edit_btn_disp'><a href="javascript:showAjaxModal('$system_base_url/modal/popup/live_schedule_user_modal/{$schedule['id']}','Event users');$('#large-modal').modal('hide');" class='mr-2'>Users</a> <a href="javascript:showAjaxModal('$system_base_url/modal/popup/live_schedule_edit_modal/{$schedule['id']}','Edit event');$('#large-modal').modal('hide');">Edit</a></div>
            </div>
HTML;
          }
          else $td_schedule="<div class='alert alert-error'><i class='fa fa-bell-o mr-1'></i>No event for today</div>";
        }
        $now_h=date('j F,Y',strtotime($key));
    $row_schedule.=<<<HTML
    <div>
      <h4>$now_h</h4>
      <hr>
      <div class="row" style='overflow-y:scroll;'>
        $td_schedule
      </div>
      </div>
HTML;
}
$td_diary.=<<<HTML
    <style>
      .p-1{
        padding:0.375rem;
      }
      .m-1{
        margin:0.375rem;
      }
      .mr-2{
        margin-right:0.75rem;
      }
      .mr-1{
        margin-right:0.375rem;
      }
      .rounded{
        border-radius:0.25rem;
      }
      .ongoing .status_class{
        background:#0acf97 !important;
      }
      .upcoming .status_class{
        background:#ffbc00 !important;
      }
      .elapsed .status_class{
        background:#fa5c7c !important;
      }
      .elapsed{
        opacity:0.3 !important;
      }
      .elapsed .edit_link{
        display:none;
      }
      .schedule-hover{
        background:#f4f4f4 !important;
        color:#1E2022 !important;
        font-weight:normal;
        cursor:pointer;
      }
      .schedule-hover:hover{
        background:#727cf5 !important;
        color:#fff !important;
      }
      .schedule-hover:hover a{
        color:#fff !important;
      }
      .opacity-50.schedule-hover:hover{
        background:inherit !important;
        color:inherit !important;
        border-color:#727cf5 !important;
      }
    </style>

<div class="row ">
    <div class="col-xl-12">
        <div class="card page" id='dlist'>
            <div class="card-body list">
              $row_schedule
            </div>
            <hr>
            <ul class="pagination ml-2"></ul>
        </div>
    </div>
</div>
<script>
  window.addEventListener('load',function(){
    var dList = new List('dlist', {
        page: 1,
        pagination: true
      });

      _now=parseInt('$_now');
      if(_now) dList.show(_now,1);
  });
</script>
HTML;
}
  else echo "<div class='alert alert-error'><i class='fa fa-bell-o mr-1'></i>No event in diary</div>";
?>
