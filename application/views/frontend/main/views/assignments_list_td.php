<?php
$assignments_list_td.=<<<HTML
        <div class="CCL-Box">
          <div class="CCL-Box-Top">
            <div class="CCL-Box-Top-1">
              <p>$assignment_title</p>
            </div>
            <div class="CCL-Box-Top-2">
              <h6 class='$assignment_question_file_disp'><a href='$system_base_url/uploads/assignment_files/assignments/$assignment_question_file'><i class="icon-doc"></i></a></h6>
              <div class="CCL-Box-Top-2-Btns">
                <a href="$system_base_url/home/lesson/$assignment_course_title_slug/{$assignment_course['id']}" class="start-learning-btn"><i class='fa fa-play-circle'></i>&nbsp;View in course</a>
              </div>
            </div>
          </div>
          <div class="CCL-Box-Sub">
            <div class="CCL-Box-Sub-10">
              <h2><span>Score:</span>$assignment_submission_marks/$assignment_total_marks</h2>
              <h3><span>Deadline:</span>$assignment_deadline_h</h3>
              <h3><span>Course:</span>{$assignment_course['title']}</h3>
          </div>
            <div class="CCL-Box-Sub-2">
              $status
              <p><i class="icon-calender"></i>$assignment_added_date_h</p>
            </div>
          </div>
        </div>
HTML;
?>