<?php
    $status_wise_courses = $this->crud_model->get_status_wise_courses();
    $number_of_courses = $status_wise_courses['pending']->num_rows() + $status_wise_courses['active']->num_rows();
    $number_of_lessons = $this->crud_model->get_lessons()->num_rows();
    $number_of_enrolment = $this->crud_model->enrol_history()->num_rows();
    $number_of_students = $this->user_model->get_user()->num_rows();
?>

<?php if (has_permission('course') ) : ?>
<div class="hhh-Yuia">

        <div class="ttt-cartss">


                        <a href="<?php echo site_url('admin/courses'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0">
                                <div class="card-body">
                                    <div class="oik-Top">
                                    <i class="dripicons-archive text-muted"></i>
                                    <span class="text-muted font-15 mb-0">Courses</span>
                                    </div>
                                    <div class="oik-Foot">
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('number_of_courses'); ?></p>
                                    <h3>
                                        <?php echo $number_of_courses; ?>
                                        
                                        <span>A.R.T.S</span>
                                    
                                    </h3>
                                    
                                    </div>
                                    
                                </div>
                            </div>
                        </a>

                        <a href="<?php echo site_url('admin/courses'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0">
                                <div class="card-body">
                                    <div class="oik-Top">
                                    <i class="dripicons-document text-muted"></i> 
                                    <span>Lessons</span>
                                    </div>
                                     <div class="oik-Foot">
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('number_of_lessons'); ?></p>
                                    <h3>
                                        <?php echo $number_of_lessons; ?>
                                     <span>A.R.T.S</span>
                                    </h3>
                                    </div>
                                    
                                </div>
                            </div>
                        </a>
            
                        <a href="<?php echo site_url('admin/enrol_history'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0">
                                <div class="card-body">
                                     <div class="oik-Top">
                                    <i class="dripicons-network-3 text-muted" ></i>
                                    <span>Enrollments</span>
                                    </div>
                                    <div class="oik-Foot">
                                      <p class="text-muted font-15 mb-0"><?php echo get_phrase('number_of_enrollments'); ?></p>
                                    <h3>
                                        <?php echo $number_of_enrolment; ?>
                                     <span>A.R.T.S</span>
                                    </h3>
                                    </div>
                                  
                                </div>
                            </div>
                        </a>

                        <a href="<?php echo site_url('admin/users'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0">
                                <div class="card-body">
                                     <div class="oik-Top">
                                    <i class="dripicons-user-group text-muted" ></i>
                                    <span>Students</span>
                                    </div>
                                    <div class="oik-Foot">
                                     <p class="text-muted font-15 mb-0"><?php echo get_phrase('number_of_student'); ?></p>
                                    <h3>
                                    <?php echo $number_of_students; ?>
                                     <span>A.R.T.S</span>
                                    </h3>
                                    </div>
                                   
                                </div>
                            </div>
                        </a>
           

        </div> <!-- end card-box-->

</div>
<?php endif;?>

<div class="row d-none">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('dashboard'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<?php if (has_permission('revenue')) : ?>
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-4"><?php echo get_phrase('admin_revenue_this_year'); ?></h4>

                <div class="mt-3 chartjs-chart" style="height: 320px;">
                    <canvas id="task-area-chart"></canvas>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
    <?php endif;?>

    <?php if (has_permission('course') ) : ?>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4"><?php echo get_phrase('course_overview'); ?></h4>
                <div class="my-4 chartjs-chart" style="height: 160px;">
                    <canvas id="project-status-chart"></canvas>
                </div>
                <div class="row text-center mt-2 py-2">
                    <div class="col-6">
                        <i class="mdi mdi-trending-up text-success mt-3 h3"></i>
                        <h3 class="font-weight-normal">
                            <span><?php echo $status_wise_courses['active']->num_rows(); ?></span>
                        </h3>
                        <p class="text-muted mb-0"><?php echo get_phrase('active_courses'); ?></p>
                    </div>
                    <div class="col-6">
                        <i class="mdi mdi-trending-down text-warning mt-3 h3"></i>
                        <h3 class="font-weight-normal">
                            <span><?php echo $status_wise_courses['pending']->num_rows(); ?></span>
                        </h3>
                        <p class="text-muted mb-0"> <?php echo get_phrase('pending_courses'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>

    <?php if (has_permission('revenue')) : ?>
    <div class="col-xl-8 d-none">
        <div class="card" id = 'unpaid-instructor-revenue'>
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('requested_withdrawal'); ?>
                    <a href="<?php echo site_url('admin/instructor_payout'); ?>" class="alignToTitle" id ="go-to-instructor-revenue"> <i class="mdi mdi-logout"></i> </a>
                </h4>
                <div class="table-responsive">
                    <table class="table table-centered table-hover mb-0">
                        <tbody>

                            <?php
                                $pending_payouts = $this->crud_model->get_pending_payouts()->result_array();
                                foreach ($pending_payouts as $key => $pending_payout):
                                $instructor_details = $this->user_model->get_all_user($pending_payout['user_id'])->row_array();
                            ?>
                            <tr>
                                <td>
                                    <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body" style="cursor: auto;"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></a></h5>
                                    <small><?php echo get_phrase('email'); ?>: <span class="text-muted font-13"><?php echo $instructor_details['email']; ?></span></small>
                                </td>
                                <td>
                                    <h5 class="font-14 my-1"><a href="javascript:void(0);" class="text-body" style="cursor: auto;"><?php echo currency($pending_payout['amount']); ?></a></h5>
                                    <small><span class="text-muted font-13"><?php echo get_phrase('requested_withdrawal_amount'); ?></span></small>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif;?>

<?php if (has_permission('instructor') ) : ?>
    <div class="row">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-body" data-collapsed="0">
          <h4 class="mb-3 header-title"><?php echo get_phrase('instructor'); ?></h4>
          <div class="table-responsive mt-4">
          <table class="table table-striped table-centered w-100" id="server_side_users_data">
            <thead>
              <tr>
                <th>#</th>
                <th><?php echo get_phrase('photo'); ?></th>
                <th><?php echo get_phrase('name'); ?></th>
                <th><?php echo get_phrase('email'); ?></th>
                <th><?php echo get_phrase('Phone'); ?></th>
                <th><?php echo get_phrase('enrolled_courses'); ?></th>
                <th><?php echo get_phrase('actions'); ?></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
          </div>
      </div>
    </div>
  </div><!-- end col-->
</div>

<script>
  $(document).ready(function () {
     var table = $('#server_side_users_data').DataTable({
      responsive: true,
      "processing": true,
      "serverSide": true,
      "ajax":{
        "url": "<?php echo base_url('admin/server_side_instructors_data') ?>",
        "dataType": "json",
        "type": "POST",
        "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
      },
      "columns": [
        { "data": "key" },
        { "data": "photo" },
        { "data": "name" },
        { "data": "email" },
        { "data": "phone" },
        { "data": "enrolled_courses" },
        { "data": "action" }
      ]   
    });
   });

  function refreshServersideTable(tableId){
    $('#'+tableId).DataTable().ajax.reload();
  }
</script>
<?php endif;?>

<?php if(!has_permission('course') && (has_permission('iqa') || has_permission('eqa') )){
    //$courses_qa_title_disp='d-none';
    include 'courses_qa.php';
}?>

<script type="text/javascript">
    $('#unpaid-instructor-revenue').mouseenter(function() {
        $('#go-to-instructor-revenue').show();
    });
    $('#unpaid-instructor-revenue').mouseleave(function() {
        $('#go-to-instructor-revenue').hide();
    });
</script>
