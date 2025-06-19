<?php
$td_top_courses.=<<<HTML
<tr>
              <td>$top_course_i</td>
              <td>{$top_course['title']}</td>
              <td>Prerecorded Video</td>
              <td><span>$top_course_progress_text</span></td>
              <td>$top_course_progress / 100%</td>
              <td class='d-none'>
                <b class="poor-remark">Very poor</b>
                <p>Retake the course again to do better.</p>
              </td>
              <td>
                <div class="Gloow-Btns">
                <a href="$top_course_details_lesson_url" class="start-learning-btn">Continue Lesson</a>
                <a href="#" class="completed-learning-btn d-none">View Result</a>
              </div>
              </td>
            </tr>
HTML;
?>