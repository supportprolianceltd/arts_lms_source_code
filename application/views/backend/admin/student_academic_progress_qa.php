<div class="table-responsive">
  <table class="studentAcademicProgress dt-responsive table table-striped table-centered mb-4">
    <thead>
      <tr>
        <th><?php echo get_phrase('Student'); ?></th>
        <th><?php echo get_phrase('Course'); ?></th>
        <th><?php echo get_phrase('Instructor'); ?></th>
        <th><?php echo get_phrase('Date') ?></th>
        <th><?php echo get_phrase('Progress'); ?></th>
        <th><?php echo get_phrase('marks'); ?></th>
        <th class="text-center"><?php echo get_phrase('Actions'); ?></th>
      </tr> 
    </thead>
    <?php $enrolments = $this->db->where('course_id', $course_details['id'])->limit((int)$limit,(int)$offset)->get('enrol')->result_array(); ?>
    <?php $lessons = $this->crud_model->get_lessons('course', $course_details['id']); ?>
    <?php $total_lesson = $lessons->num_rows(); ?>

    <tbody>
      <?php
      foreach($enrolments as $enrolment):
        $instructor = $this->user_model->get_all_user($course_details['creator'])->row_array();
        $student = $this->user_model->get_all_user($enrolment['user_id'])->row_array();
        $watch_history = $this->db->where('course_id', $course_details['id'])->where('student_id', $enrolment['user_id'])->get('watch_histories')->row_array();
        $completed_lesson_arr = isset($watch_history['completed_lesson']) ? json_decode($watch_history['completed_lesson'], true) : [];
        $completed_lesson = is_array($completed_lesson_arr) ? $completed_lesson_arr:[];

        $date_updated = isset($watch_history['date_updated']) ? date('d M Y, H:i a', $watch_history['date_updated']) : get_phrase('Not started yet');
        $completed_date = isset($watch_history['completed_date']) && $watch_history['course_progress']>=100 ? date('d M Y', $watch_history['completed_date']) : get_phrase('Not completed yet');
        $course_progress = isset($watch_history['course_progress']) ? $watch_history['course_progress'] : 0;

        $quizes = $this->db->order_by('order', 'asc')->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type' => 'quiz'])->result_array();
        foreach($quizes as $key => $quiz){
          $quiz_results = $this->db->order_by('quiz_result_id', 'asc')->where('quiz_id', $quiz['id'])->where('user_id', $student['id'])->get('quiz_results');
          foreach($quiz_results->result_array() as $rKey => $quiz_result) $total_obtained_marks+=$quiz_result['total_obtained_marks'];
          $total_marks+=json_decode($quiz['attachment'])->total_marks;
        }
        $score=$total_obtained_marks===null?null:"$total_obtained_marks/$total_marks";
        ?>
        <tr>
          <td>
            <p class="my-0"><?php echo $student['first_name'].' '.$student['last_name']; ?></p>
            <span class="badge badge-light"><?php echo $student['email']; ?></span>
          </td>
          <td>
            <p class="my-0"><?php echo $course_details['title'];?></p>
          </td>
          <td>
            <p class="my-0"><?php echo $instructor['first_name'].' '.$instructor['last_name']; ?></p>
            <span class="badge badge-light"><?php echo $instructor['email']; ?></span>
          </td>
          <td>
            <p class="my-0"><b><?php echo get_phrase('Enrolled from'); ?>-</b> <?php echo date('d M Y', $enrolment['date_added']); ?></p>

            <p class="my-0"><b><?php echo get_phrase('last seen on'); ?>-</b> <?php echo $date_updated; ?></p>

            <p class="my-0"><b><?php echo get_phrase('Completed on'); ?>-</b> <?php echo $completed_date; ?></p>
          </td>
          <td>
            <div class="progress">

              <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $course_progress; ?>%;" aria-valuenow="<?php echo $course_progress; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $course_progress; ?>%</div>
            </div>
            <p class="my-0 mt-1">- <?php echo get_phrase('Completed lesson').' '.count((array)$completed_lesson).' '.get_phrase('out of').' '.$total_lesson; ?></p>

            <?php
              $total_watched_duration = 0; //seconds
              $watched_durations = $this->db->get_where('watched_duration', ['watched_student_id' => $enrolment['user_id'], 'watched_course_id' => $course_details['id']]);
              foreach($watched_durations->result_array() as $watched_duration){
                $total_watched_duration += count((array)json_decode($watched_duration['watched_counter'], true))*5;
              }
            ?>

            <p class="my-0">- <?php echo get_phrase('Watched duration').'- <b>'.seconds_to_time_format($total_watched_duration); ?></b></p>

            
            
          </td>
          <td>
            <p class="my-0"><?php echo $score;?></p>
          </td>
          <td class="text-center">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <a href="javascript:;" onclick="showLargeModal('<?php echo site_url('admin/student_academic_quiz_result/'.$course_details['id'].'/'.$enrolment['user_id']); ?>', '<?php echo get_phrase('Quiz results'); ?>')" class="btn btn-light cursor-pointer" data-toggle="tooltip" title="<?php echo get_phrase('Quiz results'); ?>"><i class="far fa-address-card"></i></a>

              <?php if(addon_status('certificate')): ?>
                <a href="<?php echo site_url('admin/student_certificate/'.$enrolment['user_id'].'/'.$course_details['id']); ?>" target="_blank" class="btn btn-light cursor-pointer" data-toggle="tooltip" title="<?php echo get_phrase('Certificate'); ?>">
                  <i class="fas fa-graduation-cap"></i>
                </a>
              <?php endif; ?>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $('[data-toggle=tooltip]').tooltip();
</script>