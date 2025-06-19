<?php
  $user_data = $this->db->get_where('users', array('id' => $param2))->row_array();
  $system_base_url=base_url();
  $enrols = $this->user_model->my_courses($param2)->result_array();
  $completed_course_watch_historys = $this->crud_model->fetch_watch_histories($param2,0,100)->result_array();
$ongoing_course_watch_historys = $this->crud_model->fetch_watch_histories($param2,0,0)->result_array();
//foreach($course_watch_historys as $course_watch_history) $completed_courses[]=$this->crud_model->get_course_by_id($course_watch_history['course_id'])->row_array();
//$no_completed_courses=(int)count((array)$completed_courses);
$no_completed_courses=(int)count((array)$completed_course_watch_historys);
$no_ongoing_courses=(int)count((array)$ongoing_course_watch_historys);
$no_courses=count((array)$enrols);
$percent_completion=$no_courses?($no_completed_courses*100)/$no_courses:0;
  if($user_data) {
    echo <<<HTML
          <h4 class="header-title mb-4">Course performance</h4>
<div class="row">
    <div class="col-12">
        <div class="card widget-inline">
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 col-xl-4">
                        <a href="/admin/courses" class="text-secondary">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="dripicons-archive text-muted" style="font-size: 24px;"></i>
                                    <h4><span>$no_courses</span></h4>
                                    <p class="text-muted font-15 mb-0">Enrolled</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <a href="/admin/courses" class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-archive text-muted" style="font-size: 24px;"></i>
                                    <h4><span>$no_ongoing_courses</span></h4>
                                    <p class="text-muted font-15 mb-0">Ongoing</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <a href="/admin/enrol_history" class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-archive text-muted" style="font-size: 24px;"></i>
                                    <h4><span>$no_completed_courses</span></h4>
                                    <p class="text-muted font-15 mb-0">Completed</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <a href="/admin/users" class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-archive text-muted" style="font-size: 24px;"></i>
                                    <h4><span>$percent_completion%</span></h4>
                                    <p class="text-muted font-15 mb-0">Completion</p>
                                </div>
                            </div>
                        </a>
                    </div>

                </div> <!-- end row -->
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col-->
</div>

      <div class="card d-none">
        <video height='300' width='100%' id="player" playsinline controls style='max-height:300px !important;'>
            <source src="" type="video/mp4">
            <h4>Video url is not supported</h4>
        </video>
      </div>
      <table class='d-none'>
        <tr>
          <td class='text-left'>Created by:</td>
          <td class='text-left'></td>
        </tr>
        
      </table>
HTML;
  }
  else echo "<div class='alert alert-error'><i class='mdi mdi-bell-outline mr-1'></i>User not found</div>";
?>
