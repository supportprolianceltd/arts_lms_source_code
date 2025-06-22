<?php $system_base_url=base_url();?>
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('live_schedule');?>
                    <a href="javascript:void();" onclick="showAjaxModal('<?php echo site_url('modal/popup/live_schedule_add_modal');?>','Add schedule');" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_schedule'); ?></a>
            </h4>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                    <li class="nav-item">
                        <a href="#ongoing" data-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                            <i class="mdi mdi mdi-play mr-1"></i>
                            <span><?php echo site_phrase('ongoing'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#upcoming" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            <i class="mdi mdi-clock-outline mr-1"></i>
                            <span><?php echo site_phrase('upcoming'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#elapsed" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            <i class="mdi mdi-bell-outline mr-1"></i>
                            <span><?php echo get_phrase('elapsed'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#all" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            <i class="mdi mdi-router-wireless-settings mr-1"></i>
                            <span><?php echo site_phrase('all'); ?></span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div class="tab-pane show active" id="ongoing">
                        <div class="table-responsive-sm mt-4">
                            <table class="table table-striped table-centered mb-0" id='ongoing_live_schedule_table'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <!--<th><?php echo get_phrase('Creator'); ?></th>-->
                                        <th><?php echo get_phrase('Course'); ?></th>
                                        <th><?php echo get_phrase('Status'); ?></th>
                                        <th><?php echo get_phrase('Start'); ?></th>
                                        <th><?php echo get_phrase('Duration'); ?></th>
                                        <th><?php echo get_phrase('Platform'); ?></th>
                                        <th><?php echo get_phrase('Action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
                                    foreach ($ongoing_live_schedules as $ongoing_live_schedule){
                                        ++$ongoing_live_schedule_i;
                                        $ongoing_live_schedule_id=$ongoing_live_schedule['id'];
                                        $ongoing_live_schedule_user_id=$ongoing_live_schedule['user_id'];
                                        $ongoing_live_schedule_course_id=$ongoing_live_schedule['course_id'];
                                        $ongoing_live_schedule_start_time=$ongoing_live_schedule['start_time'];
                                        $ongoing_live_schedule_duration=$ongoing_live_schedule['duration'];
                                        $ongoing_live_schedule_platform=$ongoing_live_schedule['platform'];
                                        $ongoing_live_schedule_platform_link=$ongoing_live_schedule['platform_link'];
                                        $ongoing_live_schedule_note=$ongoing_live_schedule['note'];
                                        $ongoing_live_schedule_active=$ongoing_live_schedule['active'];
                                        $ongoing_live_schedule_course=$this->crud_model->get_course_by_id($ongoing_live_schedule_course_id)->row_array();
                                        $time=time();
                                        $ongoing_live_schedule_start_time_stamp=strtotime($ongoing_live_schedule_start_time);
                                        $ongoing_live_schedule_start_date=date('Y-m-d',$ongoing_live_schedule_start_time_stamp);
                                        $ongoing_live_schedule_duration_stamp=strtotime($ongoing_live_schedule_start_date.' '.$ongoing_live_schedule_duration)-strtotime($ongoing_live_schedule_start_date);
                                        $ongoing_live_schedule_end_time_stamp=$ongoing_live_schedule_start_time_stamp+$ongoing_live_schedule_duration_stamp;
                                        $status=$ongoing_live_schedule_active?($ongoing_live_schedule_start_time_stamp>$time?"<span class='badge badge-info'>upcoming</span>":($ongoing_live_schedule_end_time_stamp<$time?"<span class='badge badge-warning'>elapsed</span>":"<span class='badge badge-success'>ongoing</span>")):"<span class='badge badge-danger'>cancelled</span>";
                                        $ongoing_live_schedule_edit_btn_disp=$ongoing_live_schedule_end_time_stamp<$time?'d-none':null;

                                        $ongoing_live_schedule_join_disp=$ongoing_live_schedule_start_time_stamp<=$time && $ongoing_live_schedule_end_time_stamp>$time?null:'d-none';
                                        $ongoing_live_schedule_record_disp=$ongoing_live_schedule_end_time_stamp<$time?null:'d-none';
                                  
                                        $ongoing_live_schedule_remaining_time_stamp=$ongoing_live_schedule_end_time_stamp-$time;
                                        $ongoing_live_schedule_start_time_h=date('g:ia, j,F,Y \G\M\T',strtotime($ongoing_live_schedule_start_time));
                                        $ongoing_live_schedule_duration_h=ltrim(substr($ongoing_live_schedule_duration,0,5),'0').' hrs';
                                        $ongoing_live_schedule_remaining_time_h=$ongoing_live_schedule_remaining_time_stamp>86400?$ongoing_live_schedule_start_time_h:(int)($ongoing_live_schedule_remaining_time_stamp/3600).'h '.(int)(($ongoing_live_schedule_remaining_time_stamp%3600)/60).'mins';

                                        echo <<<HTML
                                        <tr>
                                            <td>
                                                $ongoing_live_schedule_i
                                            </td>
                                            <td>
                                                <a href='$system_base_url/admin/course_form/course_edit/$live_schedule_course_id'>{$ongoing_live_schedule_course['title']}</a>
                                            </td>
                                            <td>
                                                $status
                                            </td>
                                            <td>
                                                $ongoing_live_schedule_start_time_H
                                            </td>
                                            <td>
                                                $ongoing_live_schedule_duration_h
                                            </td>
                                            <td>
                                                $ongoing_live_schedule_platform
                                            </td>
                                            <td>
                                                <div class="dropright dropright">
                                                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_info_modal/$ongoing_live_schedule_id','Schedule info');">Info</a></li>
                                                        <li class='$ongoing_live_schedule_edit_btn_disp'><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_edit_modal/$ongoing_live_schedule_id','Edit schedule');">Edit</a></li>
                                                        <li class='$ongoing_live_schedule_record_disp'><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_edit_record_modal/$ongoing_live_schedule_id','Pre-recorded video url');">Pre-recorded</a></li>
                                                        <li class='$ongoing_live_schedule_edit_btn_disp'><a class="dropdown-item" href="#" onclick="confirm_modal('$system_base_url/admin/live_schedule/cancel/$ongoing_live_schedule_id');">Cancel</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="confirm_modal('$system_base_url/admin/live_schedule/delete/$ongoing_live_schedule_id');">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
HTML;
                                    }
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="upcoming">
                        <div class="table-responsive-sm mt-4">
                            <table class="table table-striped table-centered mb-0" id='upcoming_live_schedule_table'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <!--<th><?php echo get_phrase('Creator'); ?></th>-->
                                        <th><?php echo get_phrase('Course'); ?></th>
                                        <th><?php echo get_phrase('Status'); ?></th>
                                        <th><?php echo get_phrase('Start'); ?></th>
                                        <th><?php echo get_phrase('Duration'); ?></th>
                                        <th><?php echo get_phrase('Platform'); ?></th>
                                        <th><?php echo get_phrase('Action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
                                    foreach ($upcoming_live_schedules as $upcoming_live_schedule){
                                        ++$upcoming_live_schedule_i;
                                        $upcoming_live_schedule_id=$upcoming_live_schedule['id'];
                                        $upcoming_live_schedule_user_id=$upcoming_live_schedule['user_id'];
                                        $upcoming_live_schedule_course_id=$upcoming_live_schedule['course_id'];
                                        $upcoming_live_schedule_start_time=$upcoming_live_schedule['start_time'];
                                        $upcoming_live_schedule_duration=$upcoming_live_schedule['duration'];
                                        $upcoming_live_schedule_platform=$upcoming_live_schedule['platform'];
                                        $upcoming_live_schedule_platform_link=$upcoming_live_schedule['platform_link'];
                                        $upcoming_live_schedule_note=$upcoming_live_schedule['note'];
                                        $upcoming_live_schedule_active=$upcoming_live_schedule['active'];
                                        $upcoming_live_schedule_course=$this->crud_model->get_course_by_id($upcoming_live_schedule_course_id)->row_array();
                                        $time=time();
                                        $upcoming_live_schedule_start_time_stamp=strtotime($upcoming_live_schedule_start_time);
                                        $upcoming_live_schedule_start_date=date('Y-m-d',$upcoming_live_schedule_start_time_stamp);
                                        $upcoming_live_schedule_duration_stamp=strtotime($upcoming_live_schedule_start_date.' '.$upcoming_live_schedule_duration)-strtotime($upcoming_live_schedule_start_date);
                                        $upcoming_live_schedule_end_time_stamp=$upcoming_live_schedule_start_time_stamp+$upcoming_live_schedule_duration_stamp;
                                        $status=$upcoming_live_schedule_active?($upcoming_live_schedule_start_time_stamp>$time?"<span class='badge badge-info'>upcoming</span>":($upcoming_live_schedule_end_time_stamp<$time?"<span class='badge badge-warning'>elapsed</span>":"<span class='badge badge-success'>ongoing</span>")):"<span class='badge badge-danger'>cancelled</span>";
                                        $upcoming_live_schedule_edit_btn_disp=$upcoming_live_schedule_end_time_stamp<$time?'d-none':null;

                                        $upcoming_live_schedule_join_disp=$upcoming_live_schedule_start_time_stamp<=$time && $upcoming_live_schedule_end_time_stamp>$time?null:'d-none';
                                        $upcoming_live_schedule_record_disp=$upcoming_live_schedule_end_time_stamp<$time?null:'d-none';
                                  
                                        $upcoming_live_schedule_remaining_time_stamp=$upcoming_live_schedule_end_time_stamp-$time;
                                        $upcoming_live_schedule_start_time_h=date('g:ia, j,F,Y \G\M\T',strtotime($upcoming_live_schedule_start_time));
                                        $upcoming_live_schedule_duration_h=ltrim(substr($upcoming_live_schedule_duration,0,5),'0').' hrs';
                                        $upcoming_live_schedule_remaining_time_h=$upcoming_live_schedule_remaining_time_stamp>86400?$upcoming_live_schedule_start_time_h:(int)($upcoming_live_schedule_remaining_time_stamp/3600).'h '.(int)(($upcoming_live_schedule_remaining_time_stamp%3600)/60).'mins';

                                        echo <<<HTML
                                        <tr>
                                            <td>
                                                $upcoming_live_schedule_i
                                            </td>
                                            <td>
                                                <a href='$system_base_url/admin/course_form/course_edit/$live_schedule_course_id'>{$upcoming_live_schedule_course['title']}</a>
                                            </td>
                                            <td>
                                                $status
                                            </td>
                                            <td>
                                                $upcoming_live_schedule_start_time_h
                                            </td>
                                            <td>
                                                $upcoming_live_schedule_duration_h
                                            </td>
                                            <td>
                                                $upcoming_live_schedule_platform
                                            </td>
                                            <td>
                                                <div class="dropright dropright">
                                                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_info_modal/$upcoming_live_schedule_id','Schedule info');">Info</a></li>
                                                        <li class='$upcoming_live_schedule_edit_btn_disp'><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_edit_modal/$upcoming_live_schedule_id','Edit schedule');">Edit</a></li>
                                                        <li class='$upcoming_live_schedule_record_disp'><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_edit_record_modal/$upcoming_live_schedule_id','Pre-recorded video url');">Pre-recorded</a></li>
                                                        <li class='$upcoming_live_schedule_edit_btn_disp'><a class="dropdown-item" href="#" onclick="confirm_modal('$system_base_url/admin/live_schedule/cancel/$upcoming_live_schedule_id');">Cancel</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="confirm_modal('$system_base_url/admin/live_schedule/delete/$upcoming_live_schedule_id');">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
HTML;
                                    }
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="elapsed">
                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-centered mb-0" id='elapsed_live_schedule_table'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <!--<th><?php echo get_phrase('Creator'); ?></th>-->
                                        <th><?php echo get_phrase('Course'); ?></th>
                                        <th><?php echo get_phrase('Status'); ?></th>
                                        <th><?php echo get_phrase('Start'); ?></th>
                                        <th><?php echo get_phrase('Duration'); ?></th>
                                        <th><?php echo get_phrase('Platform'); ?></th>
                                        <th><?php echo get_phrase('Action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
                                    foreach ($elapsed_live_schedules as $elapsed_live_schedule){
                                        ++$elapsed_live_schedule_i;
                                        $elapsed_live_schedule_id=$elapsed_live_schedule['id'];
                                        $elapsed_live_schedule_user_id=$elapsed_live_schedule['user_id'];
                                        $elapsed_live_schedule_course_id=$elapsed_live_schedule['course_id'];
                                        $elapsed_live_schedule_start_time=$elapsed_live_schedule['start_time'];
                                        $elapsed_live_schedule_duration=$elapsed_live_schedule['duration'];
                                        $elapsed_live_schedule_platform=$elapsed_live_schedule['platform'];
                                        $elapsed_live_schedule_platform_link=$elapsed_live_schedule['platform_link'];
                                        $elapsed_live_schedule_note=$elapsed_live_schedule['note'];
                                        $elapsed_live_schedule_active=$elapsed_live_schedule['active'];
                                        $elapsed_live_schedule_course=$this->crud_model->get_course_by_id($elapsed_live_schedule_course_id)->row_array();
                                        $time=time();
                                        $elapsed_live_schedule_start_time_stamp=strtotime($elapsed_live_schedule_start_time);
                                        $elapsed_live_schedule_start_date=date('Y-m-d',$elapsed_live_schedule_start_time_stamp);
                                        $elapsed_live_schedule_duration_stamp=strtotime($elapsed_live_schedule_start_date.' '.$elapsed_live_schedule_duration)-strtotime($elapsed_live_schedule_start_date);
                                        $elapsed_live_schedule_end_time_stamp=$elapsed_live_schedule_start_time_stamp+$elapsed_live_schedule_duration_stamp;
                                        $status=$elapsed_live_schedule_active?($elapsed_live_schedule_start_time_stamp>$time?"<span class='badge badge-info'>upcoming</span>":($elapsed_live_schedule_end_time_stamp<$time?"<span class='badge badge-warning'>elapsed</span>":"<span class='badge badge-success'>ongoing</span>")):"<span class='badge badge-danger'>cancelled</span>";
                                        $elapsed_live_schedule_edit_btn_disp=$elapsed_live_schedule_end_time_stamp<$time?'d-none':null;

                                        $elapsed_live_schedule_join_disp=$elapsed_live_schedule_start_time_stamp<=$time && $elapsed_live_schedule_end_time_stamp>$time?null:'d-none';
                                        $elapsed_live_schedule_record_disp=$elapsed_live_schedule_end_time_stamp<$time?null:'d-none';
                                  
                                        $elapsed_live_schedule_remaining_time_stamp=$elapsed_live_schedule_end_time_stamp-$time;
                                        $elapsed_live_schedule_start_time_h=date('g:ia, j,F,Y \G\M\T',strtotime($elapsed_live_schedule_start_time));
                                        $elapsed_live_schedule_duration_h=ltrim(substr($elapsed_live_schedule_duration,0,5),'0').' hrs';
                                        $elapsed_live_schedule_remaining_time_h=$elapsed_live_schedule_remaining_time_stamp>86400?$elapsed_live_schedule_start_time_h:(int)($elapsed_live_schedule_remaining_time_stamp/3600).'h '.(int)(($elapsed_live_schedule_remaining_time_stamp%3600)/60).'mins';

                                        echo <<<HTML
                                        <tr>
                                            <td>
                                                $elapsed_live_schedule_i
                                            </td>
                                            <td>
                                                <a href='$system_base_url/admin/course_form/course_edit/$live_schedule_course_id'>{$elapsed_live_schedule_course['title']}</a>
                                            </td>
                                            <td>
                                                $status
                                            </td>
                                            <td>
                                                $elapsed_live_schedule_start_time_h
                                            </td>
                                            <td>
                                                $elapsed_live_schedule_duration_h
                                            </td>
                                            <td>
                                                $elapsed_live_schedule_platform
                                            </td>
                                            <td>
                                                <div class="dropright dropright">
                                                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_info_modal/$elapsed_live_schedule_id','Schedule info');">Info</a></li>
                                                        <li class='$elapsed_live_schedule_edit_btn_disp'><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_edit_modal/$elapsed_live_schedule_id','Edit schedule');">Edit</a></li>
                                                        <li class='$elapsed_live_schedule_record_disp'><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_edit_record_modal/$elapsed_live_schedule_id','Pre-recorded video url');">Pre-recorded</a></li>
                                                        <li class='$elapsed_live_schedule_edit_btn_disp'><a class="dropdown-item" href="#" onclick="confirm_modal('$system_base_url/admin/live_schedule/cancel/$elapsed_live_schedule_id');">Cancel</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="confirm_modal('$system_base_url/admin/live_schedule/delete/$elapsed_live_schedule_id');">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
HTML;
                                    }
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="all">
                        <div class="table-responsive-sm mt-4">
                            <table class="table table-striped table-centered mb-0" id='live_schedule_table'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <!--<th><?php echo get_phrase('Creator'); ?></th>-->
                                        <th><?php echo get_phrase('Course'); ?></th>
                                        <th><?php echo get_phrase('Status'); ?></th>
                                        <th><?php echo get_phrase('Start'); ?></th>
                                        <th><?php echo get_phrase('Duration'); ?></th>
                                        <th><?php echo get_phrase('Platform'); ?></th>
                                        <th><?php echo get_phrase('Action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
                                    foreach ($live_schedules as $live_schedule){
                                        ++$live_schedule_i;
                                        $live_schedule_id=$live_schedule['id'];
                                        $live_schedule_user_id=$live_schedule['user_id'];
                                        $live_schedule_course_id=$live_schedule['course_id'];
                                        $live_schedule_start_time=$live_schedule['start_time'];
                                        $live_schedule_duration=$live_schedule['duration'];
                                        $live_schedule_platform=$live_schedule['platform'];
                                        $live_schedule_platform_link=$live_schedule['platform_link'];
                                        $live_schedule_note=$live_schedule['note'];
                                        $live_schedule_active=$live_schedule['active'];
                                        $live_schedule_course=$this->crud_model->get_course_by_id($live_schedule_course_id)->row_array();
                                        $time=time();
                                        $live_schedule_start_time_stamp=strtotime($live_schedule_start_time);
                                        $live_schedule_start_date=date('Y-m-d',$live_schedule_start_time_stamp);
                                        $live_schedule_duration_stamp=strtotime($live_schedule_start_date.' '.$live_schedule_duration)-strtotime($live_schedule_start_date);
                                        $live_schedule_end_time_stamp=$live_schedule_start_time_stamp+$live_schedule_duration_stamp;
                                        $status=$live_schedule_active?($live_schedule_start_time_stamp>$time?"<span class='badge badge-info'>upcoming</span>":($live_schedule_end_time_stamp<$time?"<span class='badge badge-warning'>elapsed</span>":"<span class='badge badge-success'>ongoing</span>")):"<span class='badge badge-danger'>cancelled</span>";
                                        $live_schedule_edit_btn_disp=$live_schedule_end_time_stamp<$time?'d-none':null;
                                        
                                        $live_schedule_join_disp=$live_schedule_start_time_stamp<=$time && $live_schedule_end_time_stamp>$time?null:'d-none';
                                        $live_schedule_record_disp=$live_schedule_end_time_stamp<$time?null:'d-none';
                                  
                                        $live_schedule_remaining_time_stamp=$live_schedule_end_time_stamp-$time;
                                        $live_schedule_start_time_h=date('g:ia, j,F,Y \G\M\T',strtotime($live_schedule_start_time));
                                        $live_schedule_duration_h=ltrim(substr($live_schedule_duration,0,5),'0').' hrs';
                                        $live_schedule_remaining_time_h=$live_schedule_remaining_time_stamp>86400?$live_schedule_start_time_h:(int)($live_schedule_remaining_time_stamp/3600).'h '.(int)(($live_schedule_remaining_time_stamp%3600)/60).'mins';

                                        echo <<<HTML
                                        <tr>
                                            <td>
                                                $live_schedule_i
                                            </td>
                                            <td>
                                                <a href='$system_base_url/admin/course_form/course_edit/$live_schedule_course_id'>{$live_schedule_course['title']}</a>
                                            </td>
                                            <td>
                                                $status
                                            </td>
                                            <td>
                                                $live_schedule_start_time_h
                                            </td>
                                            <td>
                                                $live_schedule_duration_h
                                            </td>
                                            <td>
                                                $live_schedule_platform
                                            </td>
                                            <td>
                                                <div class="dropright dropright">
                                                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_info_modal/$live_schedule_id','Schedule info');">Info</a></li>
                                                        <li class='$live_schedule_edit_btn_disp'><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_edit_modal/$live_schedule_id','Edit schedule');">Edit</a></li>
                                                        <li class='$live_schedule_record_disp'><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_edit_record_modal/$live_schedule_id','Pre-recorded video url');">Pre-recorded</a></li>
                                                        <li class='$live_schedule_edit_btn_disp'><a class="dropdown-item" href="#" onclick="confirm_modal('$system_base_url/admin/live_schedule/cancel/$live_schedule_id');">Cancel</a></li>
                                                        <li><a class="dropdown-item" href="#" onclick="confirm_modal('$system_base_url/admin/live_schedule/delete/$live_schedule_id');">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
HTML;
                                    }
?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>

            </div> <!-- end card-body-->
        </div>
    </div>
</div>




<script type="text/javascript">
  $(document).ready(function () {
    initDataTable(['#live_schedule_table', '#ongoing_live_schedule_table', '#upcoming_live_schedule_table', '#elapsed_live_schedule_table']);
  });
</script>

