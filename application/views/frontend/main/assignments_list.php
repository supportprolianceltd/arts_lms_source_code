<?php
$assignments_list_file=$assignments_list_file?$assignments_list_file:'assignments_list_td';
    foreach((array)$assignments_list as $assignment){
      ++$assignment_i;
      $assignment_id=$assignment['assignment_id'];
      $assignment_user_id=$assignment['user_id'];
      $assignment_course_id=$assignment['course_id'];
      $assignment_deadline_time=$assignment['deadline_time'];
      $assignment_deadline_date=$assignment['deadline_date'];

      $assignment_title=$assignment['title'];
      $assignment_question=$assignment['question'];
      $assignment_question_file=$assignment['question_file'];
      $assignment_note=$assignment['note'];
      $assignment_status=$assignment['status'];
      $assignment_total_marks=(int)$assignment['total_marks'];
      $assignment_added_date=$assignment['added_date'];
      $assignment_updated_date=$assignment['updated_date'];
      $assignment_course=$this->crud_model->get_course_by_id($assignment_course_id)->row_array();
      $time=time();

      $assignment_submission=$this->crud_model->get_assignment_submision($user_id,$assignment_id);
      $assignment_submission_marks=(int)$assignment_submission['marks'];

      $assignment_deadline_h=date('d M Y', $assignment_deadline_date)." -".date('h:i A', $assignment_deadline_time);
      $assignment_added_date_h=date('d M Y',$assignment_added_date);

      $assignment_course_title_slug=slugify($assignment_course['title']);

      $assignment_open=($assignment_deadline_time >= $today_time && $assignment_deadline_date >= $today_date);
      $status=$assignment_open?"<span class='ongoing-span-badge'>Open</span>":($assignment_submission?"<span class='pending-span-badge'>submitted</span>":"<span class='completed-span-badge'>closed</span>");
      $assignment_question_file_disp=$assignment_question_file?null:'d-none';

      include(__DIR__.'/views/'.$assignments_list_file.'.php');
    }
?>