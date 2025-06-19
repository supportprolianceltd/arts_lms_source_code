<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('profile'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<?php
  $system_base_url=base_url();
  $user_data = $this->db->get_where('users', array('id' => $user_id))->row_array();
  $enrols = $this->user_model->my_courses($user_id)->result_array();
  $user_data_date_added=date('j F,Y @h:i:s a',$user_data['date_added']);
  $instructor_disp=$user_data['is_instructor']?null:'d-none';
  $user_data_expected_completion_date=$user_data['expected_completion_date']=='0000-00-00 00:00:00'||!$user_data['expected_completion_date']?null:date('j F,Y @h:i:s a',strtotime($user_data['expected_completion_date']));
  $iqa_disp=has_permission('iqa')?null:'d-none';
  $eqa_disp=has_permission('eqa')?null:'d-none';
  $audit_disp=has_permission('audit')?null:'d-none';
  $qa_disp=has_permission('eqa')||has_permission('iqa')||has_permission('course')?null:'d-none';
  $role_badge=(int)$user_data['role_id']==1?"admin":($user_data['is_instructor']?'instructor':'student');


  $completed_course_watch_historys = $this->crud_model->fetch_watch_histories($user_id,0,100)->result_array();
  $ongoing_course_watch_historys = $this->crud_model->fetch_watch_histories($user_id,0,0)->result_array();
  

  foreach($enrols as $enrol) {
    $tempc=$this->crud_model->get_course_by_id($enrol['course_id'])->row_array();
    if($tempc) {
        $course_watch_history=$this->crud_model->get_watch_histories($user_id, $tempc['id'])->row_array();
        $tempc['course_progress']=(int)$course_watch_history['course_progress'];
        $tempc['completed_date']=$course_watch_history['completed_date']?date('j F,Y @h:i:s a',$course_watch_history['completed_date']):null;
        $tempc['start_date']=date('j F,Y @h:i:s a',$enrol['date_added']);
        $courses[]=$tempc;
    }
  }

  foreach($completed_course_watch_historys as $completed_course_watch_history) {
    $tempc=$this->crud_model->get_course_by_id($completed_course_watch_history['course_id'])->row_array();
    if($tempc){
        $tempc['course_progress']=(int)$completed_course_watch_history['course_progress'];
        $tempc['completed_date']=$completed_course_watch_history['completed_date']?date('j F,Y @h:i:s a',$completed_course_watch_history['completed_date']):null;
        $enrolc=$this->db->get_where('enrol', array('user_id' => $user_id,'course_id' => $tempc['course_id']))->row_array();
        $tempc['start_date']=date('j F,Y @h:i:s a',$enrolc['date_added']);
        $completed_courses[]=$tempc;
    }
  }
  foreach($ongoing_course_watch_historys as $ongoing_course_watch_history) {
    $tempc=$this->crud_model->get_course_by_id($ongoing_course_watch_history['course_id'])->row_array();
    if($tempc){
        $tempc['course_progress']=(int)$ongoing_course_watch_history['course_progress'];
        $enrolc=$this->db->get_where('enrol', array('user_id' => $user_id,'course_id' => $tempc['course_id']))->row_array();
        $tempc['start_date']=date('j F,Y @h:i:s a',$enrolc['date_added']);
        $ongoing_courses[]=$tempc;
    }
  }
  //$no_completed_courses=(int)count((array)$completed_courses);
  $no_completed_courses=(int)count((array)$completed_course_watch_historys);
  $no_ongoing_courses=(int)count((array)$ongoing_course_watch_historys);
  $no_courses=count((array)$enrols);
  $percent_completion=$no_courses?($no_completed_courses*100)/$no_courses:0;

  $user_profile_photo=$this->user_model->get_user_image_url($user_id);

  foreach($courses as $course) {
    $completed_date_disp=$course['completed_date']?null:'d-none';
    $td_course.=<<<HTML
  <div class='p-1'>{$course['title']} <span class='ml-1 badge badge-info'>{$course['course_progress']} %</span> <p class='text-left'><small>Enrolled on: {$course['start_date']}</small> <br> <small class='$completed_date_disp'>Completed on: {$course['completed_date']}</small> </p> </div> <hr>
HTML;
  }
  foreach($completed_courses as $completed_course) $td_c_course.=<<<HTML
    <div class='p-1'>{$completed_course['title']} <span class='ml-1 badge badge-info'>{$completed_course['course_progress']} %</span> <p class='text-left'><small>Enrolled on: {$completed_course['start_date']}</small> <small><br> Completed on: {$completed_course['completed_date']}</small></p> </div> <hr>
HTML;
foreach($ongoing_courses as $ongoing_course) $td_o_course.=<<<HTML
    <div class='p-1'>{$ongoing_course['title']} <span class='ml-1 badge badge-info'>{$ongoing_course['course_progress']} %</span> <p><small>Enrolled on: {$ongoing_course['start_date']}</small></p> </div> <hr>
HTML;

//$average_rate=$this->crud_model->fetch_review_qa(array('to_user'=>$user_id,'code_1'=>1))[0]['average_rate'];
$reviews=(array)$this->crud_model->fetch_review_qa(array('to_user'=>$user_id,'code_1'=>1,'order_by'=>'id'));
$average_rate=(int)$reviews[0]['average_rate'];
//if($reviews && !$reviews[0]['id']) array_shift($reviews);
$num_reviews=count($reviews);
//var_dump($reviews);
foreach($reviews as $review) {
    $review_dp=$this->user_model->get_user_image_url($review['user_id']);
    $review_user=$this->db->get_where('users', array('id' => $review['user_id']))->row_array();
    $review_del_disp=$review_user['id']==$this->session->userdata('user_id')?null:'d-none';
    $review_td.=<<<HTML
    <tr id='review_{$review['id']}'>
        <td style='width:50px;'>
        <div class='text-left'>
            <img src="$review_dp" alt="" height="50" width="50" class="img-fluid rounded-circle img-thumbnail">
        </div>
</td>
<td>
        <div class=''>
            <p>
                {$review['description']}
                <br><small>by {$review_user['first_name']} {$review_user['last_name']}</small>
            </p>
            <p class='text-right'><span _average_rate='{$review['code']}' class='rating'></span> <button type="button" class="close alignToTitle ml-3 $review_del_disp" aria-label="Close" onclick="ajax_confirm_modal('{$system_base_url}admin/review_qa/delete_api/{$review['id']}', 'review_{$review['id']}')"><small><span aria-hidden="true"> <i class='fa fa-trash'></i> </span></small></button></p>
        </div>
</td>
    </tr>
HTML;
}

  if($user_data) {
    echo <<<HTML
          <h4 class="header-title mb-4">Course performance</h4>
<div class="row">
    <div class="col-12">
        <div class="card widget-inline">
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="dripicons-archive text-muted" style="font-size: 24px;"></i>
                                    <h4><span>$no_courses</span></h4>
                                    <p class="text-muted font-15 mb-0">Enrolled</p>
                                </div>
                            </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-archive text-muted" style="font-size: 24px;"></i>
                                    <h4><span>$no_ongoing_courses</span></h4>
                                    <p class="text-muted font-15 mb-0">Ongoing</p>
                                </div>
                            </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-archive text-muted" style="font-size: 24px;"></i>
                                    <h4><span>$no_completed_courses</span></h4>
                                    <p class="text-muted font-15 mb-0">Completed</p>
                                </div>
                            </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-archive text-muted" style="font-size: 24px;"></i>
                                    <h4><span>$percent_completion%</span></h4>
                                    <p class="text-muted font-15 mb-0">Completion</p>
                                </div>
                            </div>
                    </div>

                </div> <!-- end row -->
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col-->
</div>

<div class="card">
    <div class='card-body'>
        <div class="text-center mb-2">
            <img class="mr-2 rounded-circle" src="$user_profile_photo" alt="" width="80" height="80">
            <h3>{$user_data['first_name']} {$user_data['last_name']}</h3>
        </div>
        <div class='text-center'>
            <form method=post action='{$system_base_url}admin/activity_log' class='d-inline-block $iqa_disp' target='_blank'><button class='btn btn-info' name='user_id' value='$user_id' type='submit'>Activities</button></form>
                    <form method=post action='{$system_base_url}admin/key_activity_log' class='d-inline-block $audit_disp' target='_blank'><button class='btn btn-info' name='to_user' value='$user_id' type='submit'>Key activities</button></form>
                    <a target='_blank' href='{$system_base_url}admin/courses_qa?selected_instructor_id=$user_id' class='btn btn-info $instructor_disp $qa_disp'>Courses</a>
                    <button class='btn btn-info $instructor_disp $iqa_disp' type='button' onclick="showAjaxModal('{$system_base_url}modal/popup/review_qa_edit_modal/$user_id','Review');">Review</button>

        </div>

        <div class='mt-4 mb-4 $instructor_disp'>
            <h4><span _average_rate='$average_rate' class='rating'></span> Reviews($num_reviews)</h4>
            <div class='row mt-4'>
                <div class='table-responsive'>
                    <table class='table table-striped' id='basic-datatable'>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            $review_td
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="card">
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-striped'>
                <tr>
                    <td class='text-left'>Role:</td>
                    <td class='text-left'><span class='badge badge-info'>$role_badge</span></td>
                </tr>
                <tr>
                <td class='text-left'>First name:</td>
                <td class='text-left'>{$user_data['first_name']}</td>
                </tr>
                <tr>
                <td class='text-left'>Last name:</td>
                <td class='text-left'>{$user_data['last_name']}</td>
                </tr>
                <tr>
                <td class='text-left'>Email:</td>
                <td class='text-left'>{$user_data['email']}</td>
                </tr>
                <tr>
                <td class='text-left'>Phone:</td>
                <td class='text-left'>{$user_data['phone']}</td>
                </tr>
                <tr>
                <td class='text-left'>Registered:</td>
                <td class='text-left'>$user_data_date_added</td>
                </tr>
                <tr>
                <td class='text-left'>City:</td>
                <td class='text-left'>{$user_data['city']}</td>
                </tr>
                <tr>
                <td class='text-left'>Postcode:</td>
                <td class='text-left'>{$user_data['post_code']}</td>
                </tr>
                <tr>
                <td class='text-left'>Country:</td>
                <td class='text-left'>{$user_data['country']}</td>
                </tr>
                <tr>
                <td class='text-left'>Address:</td>
                <td class='text-left'>{$user_data['address']}</td>
                </tr>
                <tr>
                <td class='text-left'>Off the job training:</td>
                <td class='text-left'>{$user_data['off_the_job_training']}</td>
                </tr>
                <tr>
                <td class='text-left'>Accessor:</td>
                <td class='text-left'>{$user_data['accessor']}</td>
                </tr>
                <tr>
                <td class='text-left'>UI no:</td>
                <td class='text-left'>{$user_data['ui_no']}</td>
                </tr>
                <tr>
                <td class='text-left'>Cohort:</td>
                <td class='text-left'>{$user_data['cohort']}</td>
                </tr>
                <tr>
                <td class='text-left'>Employer:</td>
                <td class='text-left'>{$user_data['employer']}</td>
                </tr>
                <tr>
                <td class='text-left'>Partner:</td>
                <td class='text-left'>{$user_data['partner']}</td>
                </tr>
                <td class='text-left'>Expected completion date:</td>
                <td class='text-left'>$user_data_expected_completion_date</td>
                </tr>
            </table>
        </div>

        <h4>Enrolled</h4>
        <div class='table-responsive'>
            <table class='table table-striped'>
                <tr>
                    <td><h4>All courses</h4> $td_course</td>
                    <td><h4>Completed courses</h4> $td_c_course</td>
                    <td><h4>Ongoing courses</h4> $td_o_course</td>
                </tr>
            </table>
        </div>

    </div>
  </div>
HTML;
  }
  else echo "<div class='alert alert-error'><i class='mdi mdi-bell-outline mr-1'></i>User not found</div>";
?>
