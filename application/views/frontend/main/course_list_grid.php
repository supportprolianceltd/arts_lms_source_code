<?php
    $td_top_courses_file=$td_top_courses_file?$td_top_courses_file:'td_top_courses';
    $td_top_courses=null;
    $top_courses_disp='d-none';
    $top_course_number_of_ratings=$top_course_total_rating=$top_course_number_of_enrolments=0;
    $no_top_courses=count($top_courses);
    $feedback_text=$no_top_courses?((int)$no_top_courses==1?"<b>$no_top_courses</b> course":"<b>$no_top_courses</b> courses"):'no result';
    $no_top_courses=(int)count((array)$top_courses);
    foreach ($top_courses as $top_course){
        $top_course_i++;
        $top_courses_disp=null;
        $top_course_lessons = $this->crud_model->get_lessons('course', $top_course['id'])->result_array();
        $top_course_sections = $this->crud_model->get_section('course', $top_course['id'])->result_array();
        $top_course_instructor_details = $this->user_model->get_all_user($top_course['creator'])->row_array();
        $top_course_course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($top_course['id']);
        $top_course_total_rating =  $this->crud_model->get_ratings('course', $top_course['id'], true)->row()->rating;
        $top_course_number_of_ratings = $this->crud_model->get_ratings('course', $top_course['id'])->num_rows();
        
        $top_course_quizzes = $this->db->get_where('lesson', ['course_id' => $top_course['id'], 'lesson_type' => 'quiz']);
        $top_course_watch_history = $this->crud_model->get_watch_histories($this->session->userdata('user_id'), $top_course['id'])->row_array();
        $top_course_progress = isset($top_course_watch_history['course_progress']) ? $top_course_watch_history['course_progress'] : 0;
        $top_course_progress_text=$top_course_progress==100?'Completed':'Ongoing';
        $top_course_title_slug=slugify($top_course['title']);

        $top_course_details_lesson_url="$system_base_url/home/lesson/$top_course_title_slug/{$top_course['id']}";

        $top_course_num_lessons=$top_course_lessons?count($top_course_lessons):0;
        $top_course_num_sections=$top_course_sections?count($top_course_sections):0;

        if ($top_course_number_of_ratings > 0) {
            $top_course_average_ceil_rating = ceil($top_course_total_rating / $top_course_number_of_ratings);
        } else {
            $top_course_average_ceil_rating = 0;
        }

        $top_course_number_of_enrolments = $this->crud_model->enrol_history($top_course['id'])->num_rows();

        $top_course_url=$__active_tab['my_courses']?site_url("home/my_courses/{$top_course['id']}"):site_url('home/course/' . rawurlencode(slugify($top_course['title'])) . '/' . $top_course['id']);
        
        $top_course_img_url=$this->crud_model->get_course_thumbnail_url($top_course['id']);

        $top_course_price_currency=currency($top_course['price']);
        $top_course_discounted_price_currency=currency($top_course['discounted_price']);
        $top_course_final_price_currency=$top_course['is_free_course']?"Free":($top_course['discount_flag']?"<span class='price_main'>$top_course_price_currency</span> <b class='price_discount'>$top_course_discounted_price_currency</b>":"<span>$top_course_price_currency</span>");
        include(__DIR__."/views/$td_top_courses_file.php");
/*        $td_top_courses.=<<<HTML
                  <div class="item">

                        <a href="$top_course_url" class="courses-card">
                        <div class="top-CC-Card">
                            <img src="$top_course_img_url" />
                        </div>
                        <div class="sub-CC-Card">
                            <h2>{$top_course['title']}</h2>
                            <p>{$top_course['short_description']}</p>

                            <h4>$top_course_average_ceil_rating
                            <span class='rating' _average_rate='$top_course_average_ceil_rating'></span>
                            
                            <b>($top_course_number_of_ratings Reviews)</b>
                            </h4>

                            <h5>By <span>{$top_course_instructor_details['first_name']}</span></h5>
                            <h3>$top_course_final_price_currency</h3>
                            <button class="badge">{$top_course['level']}</button>
                        </div>
                        </a>

                    </div><!--item-->
HTML;*/
    }
?>
