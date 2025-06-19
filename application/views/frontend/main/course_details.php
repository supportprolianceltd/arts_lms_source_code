<?php
$course_number_of_ratings=$course_total_rating=$course_number_of_enrolments=$course_num_sections=0;
$course_disp='d-none';
if($course_details){
    $course_disp=null;
    $course_lessons = $this->crud_model->get_lessons('course', $course_details['id']);
    $course_instructor_details = $this->user_model->get_all_user($course_details['creator'])->row_array();
    $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']);
    $course_number_of_enrolments = $this->crud_model->enrol_history($course_details['id'])->num_rows();
    $course_total_rating =  $this->crud_model->get_ratings('course', $course_details['id'], true)->row()->rating;
    $course_number_of_ratings = $this->crud_model->get_ratings('course', $course_details['id'])->num_rows();

    $course_lectures = $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type !=' => 'quiz']);
    $course_quizzes = $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type' => 'quiz']);
    $course_watch_history = $this->crud_model->get_watch_histories($this->session->userdata('user_id'), $course_details['id'])->row_array();
    $course_progress = isset($course_watch_history['course_progress']) ? $course_watch_history['course_progress'] : 0;
    $course_user_specific_rating = $this->crud_model->get_user_specific_rating('course', $course_details['id']);

    $selected_star_rating[$course_user_specific_rating['rating']]='selected';

    if ($course_number_of_ratings > 0) {
        $course_average_ceil_rating = ceil($course_total_rating / $course_number_of_ratings);
    } else {
        $course_average_ceil_rating = 0;
    }

    $course_url=site_url('home/course/' . rawurlencode(slugify($course_details['title'])) . '/' . $course_details['id']);
    $course_img_url=$this->crud_model->get_course_thumbnail_url($course_details['id'],'course_thumbnail',false);

    $course_price_currency=currency($course_details['price']);
    $course_discounted_price_currency=currency($course_details['discounted_price']);
    $course_final_price_currency=$course_details['is_free_course']?"Free":($course_details['discount_flag']?"<span class='price_main'>$course_price_currency</span> <b class='price_discount'>$course_discounted_price_currency</b>":"<span>$course_price_currency</span>");

    $course_sections = $this->crud_model->get_section('course', $course_id)->result_array();
    $course_category = $this->crud_model->get_category_details_by_id($course_details['category_id'])->row_array();
    $course_category_name_slug=slugify($course_category['name']);

    $course_num_sections=$course_sections?count($course_sections):0;

    $course_outcomes=$course_details['outcomes']?json_decode($course_details['outcomes']):null;
    $course_requirements=$course_details['requirements']?json_decode($course_details['requirements']):null;
    $course_faqs=$course_details['faqs']?json_decode($course_details['faqs'],true):null;

    $ratings = $this->crud_model->get_rating_by_status('course', $course_details['id'],1)->result_array();

    $course_outcome_disp=$course_requirement_disp=$course_faq_disp=$course_rating_disp='d-none';

    $course_details_title_slug=slugify($course_details['title']);

    $course_details_lesson_url="$system_base_url/home/lesson/$course_details_title_slug/{$course_details['id']}";

    $is_in_cart=in_array($course_details['id'], $cart_items);

    $add_to_cart_disp=$is_in_cart?'d-hidden':'';
    $added_to_cart_disp=$is_in_cart?'':'d-hidden';

    //$course_details_action="<a href='$system_base_url/home/purchase_now/{$course_details['id']}' class='AddTo-CartBtn leraning-btn'><i class='fa fa-money'></i>&nbsp;Buy Now</a>";
    $course_details_action="<a href='#' onclick='actionTo(".'"'."$system_base_url/home/handle_buy_now/{$course_details['id']}".'"'.")'><i class='fa fa-credit-card'></i> Buy Now</a>";
    if(is_purchased($course_details['id'])) $course_details_action="<a href='$system_base_url/home/my_courses/{$course_details['id']}' class='leraning-btn'><i class='fa fa-play-circle'></i>&nbsp;Start Now</a>";
    elseif($course_details['is_free_course']) $course_details_action="<a href='$system_base_url/home/get_enrolled_to_free_course/{$course_details['id']}' class='leraning-btn'><i class='fa fa-play-circle'></i>&nbsp;Enroll Now</a>";
    else {
        $course_details_action.=<<<HTML
        <a id='add_to_cart_btn_{$course_details['id']}' class='AddTo-CartBtn $add_to_cart_disp' href='#' onclick="actionTo('$system_base_url/home/handle_cart_items/{$course_details['id']}');"><i class='fa fa-plus'></i>Add to cart</a>
        <a id='added_to_cart_btn_{$course_details['id']}' class='AddTo-CartBtn $added_to_cart_disp active' href='#' onclick="actionTo('$system_base_url/home/handle_cart_items/{$course_details['id']}');"><i class='fa fa-minus'></i>Remove from cart</a>
HTML;
    }

    if($course_outcomes) {
        $course_outcome_disp=null;
        foreach ($course_outcomes as $course_outcome) $course_outcome_td.="<li><i class='fa fa-check'></i>$course_outcome</li>";
    }

    if($course_requirements) {
        $course_requirement_disp=null;
        foreach ($course_requirements as $course_requirement) $course_requirement_td.="<li><i class='fa fa-check'></i>$course_requirement</li>";
    }

    if($course_faqs) {
        $course_faq_disp=null;
        foreach ($course_faqs as $course_faq_key=>$course_faq_val) $course_faq_td.=<<<HTML
            <div class="accordion-item">
                <div class="accordion-header">$course_faq_key? <span class="ti-angle-down"></span></div>
                <div class="accordion-content">
                        <p>
                        <span>$course_faq_val.</span>
                      </p>
                  
                </div>
            </div>
HTML;
    }

    foreach($ratings as $rating){
        $course_rating_disp=null;
        $rating_user_details = $this->user_model->get_user($rating['user_id'])->row_array();
        $rating_date=date('d-M-Y', $rating['date_added']);
        $course_rating_td.=<<<HTML
        <div class="comments-sec-box">
                                            <div class="s-comment" style='grid-gap:20px!important;'>
                                            <div class="s-comment-1">
                                                <div class="s-comment-1-flex">
                                                <div class="s-comment-10">
                                                    <span>{$rating_user_details['first_name'][0]}</span>
                                                </div>
                                                <div class="s-comment-11">
                                                    <span>{$rating_user_details['first_name']}</span>
                                                    <p>$rating_date</p>
                                                </div>
                                            </div>
                                        </div>
                                        <span class='rating' _average_rate='{$rating['rating']}'></span>
                                            <div class="s-comment-2">
                                                <span class='d-none'> 
                                                    <i class="fa fa-star star-on"></i>
                                                     <i class="fa fa-star star-on"></i>
                                                     <i class="fa fa-star star-off"></i>
                                                     <i class="fa fa-star star-off"></i>
                                                     <i class="fa fa-star star-off"></i>
                                                 </span>
                                                <p>{$rating['review']}</p>
                                            </div>
                                            </div>
                                        </div><!--comments-sec-box-->
HTML;

    }

    foreach ($course_sections as $course_sections_key => $course_section){
        $course_sections_td.=<<<HTML
            <div class="accordion-item">
                <div class="accordion-header">{$course_section['title']} <span class="ti-angle-down"></span></div>
                <div class="accordion-content">
HTML;
    $course_section_lessons = $this->crud_model->get_lessons('section', $course_section['id'])->result_array();
    foreach ($course_section_lessons as $course_section_lesson){
        if($course_sections_key==1){
            $course_section_1_title=$course_section['title'];
            $course_section_lesson_1_title=$course_section_lesson['title'];
        }

        if($course_section_lesson['lesson_type']!='quiz'){
            $course_sections_td.=<<<HTML
                    <a href="learning-page">
                        <i class="ti-control-play"></i>
                        <div>
                            <p>
                                <span>{$course_section_lesson['title']}</span>
                            </p>

                            <h3 class='d-none'>
                                <span><i class="ti-video-camera"></i>Video</span>
                                <span><i class="ti-book"></i> Materials</span>
                            </h3>
                        </div>

                    </a>
HTML;
    }
    else {$course_sections_td.=<<<HTML
                                  <a href="#" class="asss-aa-href">
                                <i class="ti-pencil"></i>
                                <div>
                                <p>
                                  <span>Assessment - {$course_section_lesson['title']}</span>
                                </p>


                                <div class="progressr-sec d-none">
                                    <p><span>Progress</span> 20%</p>
                                    <div class="l-progress-bar">
                                      <span></span>
                                    </div>
                                  </div>
          
                            </div>

                            <div class="assc-score d-none">
                                <h6>Score</h6>
                                <h2>0/10</h2>
                            </div>
          
                              </a>
HTML;
    }

    }
    $course_sections_td.=<<<HTML
    </div>
</div>
HTML;
}

require_once(__DIR__.'/course_video_provider.php');
}
?>
