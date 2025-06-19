<?php
$td_top_courses.=<<<HTML

<div class="CCL-Box">
                <div class="CCL-Box-Top">
                  <div class="CCL-Box-Top-1">
                    <p>{$top_course['title']}</p>
                  </div>
                  <div class="CCL-Box-Top-2">
                    <h6>Progress - $top_course_progress%</h6>
                    <div class="CCL-Box-Top-2-Btns">
                      <a href="$top_course_details_lesson_url" class="start-learning-btn"><i class="fa fa-play-circle"></i> Continue Lesson</a>
                    </div>
                  </div>
                </div>
                <div class="CCL-Box-Sub">
                  <div class="CCL-Box-Sub-1">
                    <a href="#"><i class="icon-doc"></i>$top_course_num_lessons lessons</a> 
                    <a href="#"><i class="icon-screen-desktop"></i>$top_course_num_sections sections</a> 
                    <a href="#" class='d-none'><i class="icon-camrecorder"></i> Video</a> 
                    <a href="#" class='d-none'><i class="icon-screen-desktop"></i> Presentation</a> 
                    <a href="#" class='d-none'><i class="icon-doc"></i> Course Material</a> 
                    <a href="#" class='d-none'><i class="icon-pencil"></i> Assessment</a> 
                </div>
                  <div class="CCL-Box-Sub-2">
                    <span class="ongoing-span-badge">Active</span>
                    <p class='d-none'><i class="icon-calender"></i>2/23/2025</p>
                  </div>
                </div>
              </div>
HTML;
?>