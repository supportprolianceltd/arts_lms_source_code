<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
{

	// constructor
	function __construct()
	{
		parent::__construct();
		/*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
	}

	// get the top courses
	public function top_courses_get($top_course_id = "")
	{
		if ($top_course_id != "") {
			$this->db->where('id', $top_course_id);
		}
		$this->db->where('is_top_course', 1);
		$this->db->where('status', 'active');
		$top_courses = $this->db->get('course')->result_array();
		// This block of codes return the required data of courses
		$result = array();
		$result = $this->course_data($top_courses);
		return $result;
	}

	function all_categories_get(){
		$all_categories = array();
		$this->db->where('parent', 0);
		$categories = $this->db->get('category')->result_array();
		foreach ($categories as $key => $category) {
			$all_categories[$key] = $category;

			$this->db->where('parent', $category['id']);
			$sub_categories = $this->db->get('category')->result_array();
			$all_categories[$key]['sub_categories'] = $sub_categories;
		}

		return $all_categories;
	}

	// Get categories
	public function categories_get($category_id)
	{
		if ($category_id != "") {
			$this->db->where('id', $category_id);
		}
		$this->db->where('parent', 0);
		$categories = $this->db->get('category')->result_array();
		foreach ($categories as $key => $category) {
			$categories[$key]['thumbnail'] = $this->get_image('category_thumbnail', $category['thumbnail']);
			$categories[$key]['number_of_courses'] = $this->crud_model->get_category_wise_courses($category['id'])->num_rows();

			$this->db->where('parent', $category['id']);
			$number_of_sub_categories = $this->db->get('category')->num_rows();
			$categories[$key]['number_of_sub_categories'] = $number_of_sub_categories;
		}
		return $categories;
	}

	// Get sub categories
	public function sub_categories_get($parent_category_id)
	{
		$response = array();

		$this->db->where('parent', $parent_category_id);
		$categories = $this->db->get('category')->result_array();
		foreach ($categories as $key => $category) {
			$this->db->where('status', 'active');
			$this->db->where('sub_category_id', $category['id']);
			$number_of_courses = $this->db->get('course')->num_rows();
			$category['number_of_courses'] = $number_of_courses;
			$response[$key] = $category;
		}
		
		return $response;
	}

	// Get category wise courses
	public function category_wise_course_get($category_id)
	{
		$category_details = $this->crud_model->get_category_details_by_id($category_id)->row_array();

		if ($category_details['parent'] > 0) {
			$this->db->where('sub_category_id', $category_id);
		} else {
			$this->db->where('category_id', $category_id);
		}
		$this->db->where('status', 'active');
		$courses = $this->db->get('course')->result_array();

		// This block of codes return the required data of courses
		$result = array();
		$result = $this->course_data($courses);
		return $result;
	}

	// Filter courses
	function filter_course()
	{
		$selected_category = $_GET['selected_category'];
		$selected_price = $_GET['selected_price'];
		$selected_level = $_GET['selected_level'];
		$selected_language = $_GET['selected_language'];
		$selected_rating = $_GET['selected_rating'];
		$selected_search_string = ltrim(rtrim($_GET['selected_search_string']));

		$course_ids = array();

		if ($selected_search_string != "" && $selected_search_string != "null") {
			$this->db->like('title', $selected_search_string);
		}
		if ($selected_category != "all") {
			$category_details = $this->crud_model->get_category_details_by_id($selected_category)->row_array();

			if ($category_details['parent'] > 0) {
				$this->db->where('sub_category_id', $selected_category);
			} else {
				$this->db->where('category_id', $selected_category);
			}
		}

		if ($selected_price != "all") {
			if ($selected_price == "paid") {
				$this->db->where('is_free_course', null);
			} elseif ($selected_price == "free") {
				$this->db->where('is_free_course', 1);
			}
		}

		if ($selected_level != "all") {
			$this->db->where('level', $selected_level);
		}

		if ($selected_language != "all") {
			$this->db->where('language', $selected_language);
		}

		$this->db->where('status', 'active');
		$courses = $this->db->get('course')->result_array();

		foreach ($courses as $course) {
			if ($selected_rating != "all") {
				$total_rating =  $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
				$number_of_ratings = $this->crud_model->get_ratings('course', $course['id'])->num_rows();
				if ($number_of_ratings > 0) {
					$average_ceil_rating = ceil($total_rating / $number_of_ratings);
					if ($average_ceil_rating == $selected_rating) {
						array_push($course_ids, $course['id']);
					}
				}
			} else {
				array_push($course_ids, $course['id']);
			}
		}

		if (count((array)$course_ids) > 0) {
			$this->db->where_in('id', $course_ids);
			$courses = $this->db->get('course')->result_array();
		} else {
			return array();
		}

		// This block of codes return the required data of courses
		$result = array();
		$result = $this->course_data($courses);
		return $result;
	}

	public function courses_by_search_string_get($search_string)
	{
		$this->db->like('title', $search_string);
		$this->db->where('status', 'active');
		$courses = $this->db->get('course')->result_array();
		return $this->course_data($courses);
	}

	// Return require course data
	public function course_data($courses = array())
	{
		foreach ($courses as $key => $course) {
			$courses[$key]['requirements'] = json_decode($course['requirements']);
			$courses[$key]['outcomes'] = json_decode($course['outcomes']);
			$courses[$key]['thumbnail'] = $this->get_image('course_thumbnail', $course['id']);
			$courses[$key]['enable_drip_content'] = $course['enable_drip_content'];
			if ($course['is_free_course'] == 1) {
				$courses[$key]['price'] = 'Free';
			} else {
				if ($course['discount_flag'] == 1) {
					$courses[$key]['price'] = currency($course['discounted_price']);
				} else {
					$courses[$key]['price'] = currency($course['price']);
				}
			}
			$total_rating =  $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
			$number_of_ratings = $this->crud_model->get_ratings('course', $course['id'])->num_rows();
			if ($number_of_ratings > 0) {
				$courses[$key]['rating'] = ceil($total_rating / $number_of_ratings);
			} else {
				$courses[$key]['rating'] = 0;
			}
			$courses[$key]['number_of_ratings'] = $number_of_ratings;
			$instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();
			$courses[$key]['instructor_name'] = $instructor_details['first_name'] . ' ' . $instructor_details['last_name'];
			$courses[$key]['instructor_image'] = $this->user_model->get_user_image_url($instructor_details['id']);
			$courses[$key]['total_enrollment'] = $this->crud_model->enrol_history($course['id'])->num_rows();
			$courses[$key]['shareable_link'] = site_url('home/course/' . slugify($course['title']) . '/' . $course['id']);
		}

		return $courses;
	}
	// Get all the language of system
	public function languages_get()
	{
		$language_files = array();
		$all_files = $this->crud_model->get_list_of_language_files();
		$counter = 0;
		foreach ($all_files as $file) {
			$info = pathinfo($file);
			if (isset($info['extension']) && strtolower($info['extension']) == 'json') {
				$inner_array = array();
				$file_name = explode('.json', $info['basename']);
				$inner_array = array(
					'id' => $counter++,
					'value' => $file_name[0],
					'displayedValue' => ucfirst($file_name[0])
				);

				array_push($language_files, $inner_array);
			}
		}
		return $language_files;
	}

	// Get image for course, categories or user image
	public function get_image($type, $identifier)
	{ // type is the flag to realize whether it is course, category or user image. For course, user image Identifier is id but for category Identifier is image name
		if ($type == 'user_image') {
			// code...
		} elseif ($type == 'course_thumbnail') {
			return $this->crud_model->get_course_thumbnail_url($identifier);
		} elseif ($type == 'category_thumbnail') {
			if (file_exists('uploads/thumbnails/category_thumbnails/' . $identifier) && $identifier != "") {
				return base_url() . 'uploads/thumbnails/category_thumbnails/' . $identifier;
			} else {
				return base_url() . 'uploads/thumbnails/category_thumbnails/category-thumbnail.png';
			}
		}
	}

	public function system_settings_get_older()
	{
		$query = $this->db->get('settings')->result_array();
		$system_settings_data = array();
		foreach ($query as $row) {
			if ($row['key'] == 'paypal' || $row['key'] == 'stripe_keys') {
				$system_settings_data[$row['key']] = json_decode($row['value'], true);
			} else {
				$system_settings_data[$row['key']] = $row['value'];
			}
		}
		$system_settings_data['thumbnail'] = base_url() . 'uploads/system/'.get_frontend_settings('dark_logo');
		return $system_settings_data;
	}

	public function system_settings_get()
	{
		$query = $this->db->get('settings')->result_array();
		$system_settings_data = array();
		foreach ($query as $row) {
			if (
				$row['key'] == "language" ||
				$row['key'] == "system_name" ||
				$row['key'] == "system_title" ||
				$row['key'] == "system_email" ||
				$row['key'] == "address" ||
				$row['key'] == "phone" ||
				$row['key'] == "slogan" ||
				$row['key'] == "version" ||
				$row['key'] == "youtube_api_key" ||
				$row['key'] == "vimeo_api_key" ||
				$row['key'] == "course_accessibility" ||
				$row['key'] == "allowed_device_number_of_loging" ||
				$row['key'] == "drip_content_settings"
			) {
				if(isJson($row['value'])){
					$system_settings_data[$row['key']] = json_decode($row['value'], true);
				}else{
					$system_settings_data[$row['key']] = $row['value'];
				}
			}
		}
		$system_settings_data['thumbnail'] = base_url() . 'uploads/system/'.get_frontend_settings('dark_logo');
		$system_settings_data['favicon'] = base_url() . 'uploads/system/'.get_frontend_settings('favicon');
		return $system_settings_data;
	}

	// Login mechanism
	public function login_get()
	{
		$userdata = array();
		$credential = array('email' => $_GET['email'], 'password' => sha1($_GET['password']), 'status' => 1);
		$query = $this->db->get_where('users', $credential);
		if ($query->num_rows() > 0) {
			$row = $query->row_array();

			$response = $this->new_device_login_tracker($row['id']);

			$userdata['user_id'] = $row['id'];
			$userdata['first_name'] = $row['first_name'];
			$userdata['last_name'] = $row['last_name'];
			$userdata['email'] = $row['email'];
			$userdata['role'] = strtolower(get_user_role('user_role', $row['id']));
			$userdata['validity'] = 1;

			if($response['validity'] == 1){
                $userdata['device_verification'] = 'no-need-verification';
			}else{
                $userdata['device_verification'] = 'needed-verification';
			}
		} else {
			$userdata['validity'] = 0;
            $userdata['device_verification'] = 'invalid-login-credentials';
		}
		return $userdata;
	}


	public function new_device_login_tracker($user_id = "", $is_verified = '')
    {
        $pre_sessions = array();
        $updated_session_arr = array();
        $current_session_id = session_id();
        $this->db->where('id', $user_id);
        $sessions = $this->db->get('users');

        if($sessions->row('role_id') == 1){
            return;
        }

        $pre_sessions = json_decode($sessions->row('sessions'), true);

        if(is_array($pre_sessions) && count($pre_sessions) > 0){
            if($is_verified == true && !in_array($current_session_id, $pre_sessions)){
                $allowed_device = get_settings('allowed_device_number_of_loging');
                $previous_tatal_device = count((array)$pre_sessions) + 1; //current device

                $removeable_device = $previous_tatal_device - $allowed_device;

                foreach($pre_sessions as $key => $pre_session){
                    if($removeable_device >= 1){
                        $this->db->where('id', $pre_session);
                        $this->db->delete('ci_sessions');
                    }else{

                        if($this->db->get_where('ci_sessions', ['id' => $pre_session])->num_rows() > 0){
                            array_push($updated_session_arr, $pre_session);                        
                        }
                    }
                    $removeable_device = $removeable_device - 1;
                }
                array_push($updated_session_arr, $current_session_id);
            }else{
                if(!in_array($current_session_id, $pre_sessions)){
                    if(count((array)$pre_sessions) >= get_settings('allowed_device_number_of_loging')){
                        $this->email_model->new_device_login_alert($user_id);
                        
                        $response['validity'] = 0;
                        $response['device_verification'] = 1;
                    }else{
                        $updated_session_arr = $pre_sessions;
                        array_push($updated_session_arr, $current_session_id);
                    }
                }
            }
        }else{
            $updated_session_arr = [$current_session_id];
        }

        if(count((array)$updated_session_arr) > 0){
            $data['sessions'] = json_encode($updated_session_arr);
            $this->db->where('id', $user_id);
            $this->db->update('users', $data);
        }


        if(isset($response)){
        }else{
        	$response['validity'] = 1;
			$response['device_verification'] = 0;
        }
		return $response;

    }

    function new_login_confirmation($param1 = "", $user_id = ""){
    	$response = array();
    	// Checking login credential for admin
        $query = $this->db->get_where('users', array('id' => $user_id));
        $row = $query->row_array();

        if($param1 == 'submit'){
            $new_device_verification_code = $this->input->post('new_device_verification_code');
            if($new_device_verification_code != $row['verification_code']){
                $response['user_id'] = $user_id;
                $response['new_device_verification_code'] = $new_device_verification_code;

                $response['validity'] = 0;
	            $response['message'] = get_phrase('verification_code_is_wrong');
	            return $response;
            }

            

            if ($query->num_rows() > 0) {

                // For device login tracker
                $this->new_device_login_tracker($row['id'], true);
                $response['user_id'] = $row['id'];
				$response['first_name'] = $row['first_name'];
				$response['last_name'] = $row['last_name'];
				$response['email'] = $row['email'];
				$response['role'] = strtolower(get_user_role('user_role', $row['id']));
                $response['validity'] = 1;
	            $response['message'] = get_phrase('Logged in successfully');
	            return $response;
            }else{
            	$response['validity'] = 0;
	            $response['message'] = get_phrase('something_is_wrong');
	            return $response;
            }
        }

        if($param1 == 'resend'){
            $this->email_model->new_device_login_alert($user_id);
            $response['validity'] = 1;
            $response['message'] = get_phrase('verification_code_sent');
            return $response;
        }

        $response['validity'] = 0;
	    $response['message'] = get_phrase('something_is_wrong');
	    return $response;
    }

	// // For single device Login mechanism
	// public function login_get($session_id = "")
	// {
	// 	$userdata = array();
	// 	$credential = array('email' => $_GET['email'], 'password' => sha1($_GET['password']), 'status' => 1);
	// 	$query = $this->db->get_where('users', $credential);
	// 	if ($query->num_rows() > 0) {
	// 		$row = $query->row_array();
	// 		$userdata['user_id'] = $row['id'];
	// 		$userdata['first_name'] = $row['first_name'];
	// 		$userdata['last_name'] = $row['last_name'];
	// 		$userdata['email'] = $row['email'];
	// 		$userdata['role'] = strtolower(get_user_role('user_role', $row['id']));
			
	// 		$userdata['session_id'] = $session_id;
	// 		$userdata['validity'] = 1;
	// 	} else {
	// 		$userdata['validity'] = 0;
	// 	}
	// 	return $userdata;
	// }

	// Signup mechanism
	public function signup_post()
	{
		$response = array();

		$data['first_name'] = $_POST['first_name'];
		$data['last_name'] = $_POST['last_name'];
	    $data['email'] = $_POST['email'];
	    $data['password'] = sha1($_POST['password']);
	    $verification_code = rand(100000, 999999);
	    $data['verification_code'] = $verification_code;

	    if (get_settings('student_email_verification') == 'enable') {
            $data['status'] = 0;
        }else {
            $data['status'] = 1;
        }

        $data['wishlist'] = json_encode(array());
        $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
        $social_links = array(
            'facebook' => "",
            'twitter'  => "",
            'linkedin' => ""
        );
        $data['social_links'] = json_encode($social_links);
        $data['role_id']  = 2;

        $data['payment_keys'] = json_encode(array());

        $validity = $this->user_model->check_duplication('on_create', $data['email']);
        if($validity === 'unverified_user' || $validity == true) {
        	if($validity === true){
                $this->db->insert('users', $data);

                $insert_id = $this->db->insert_id();

		        if($insert_id > 0){
		          $response['message'] = 'Registration successful';
		          $response['email_verification'] = get_settings('student_email_verification');
		          $response['status'] = 200;
		          $response['validity'] = true;
		        }else{
		          $response['message'] = 'Registration updated successfully';
		          $response['email_verification'] = get_settings('student_email_verification');
		          $response['status'] = 200;
		          $response['validity'] = true;
		        }
            } else{
            	$response['message'] = 'Registration failed';
            	$response['email_verification'] = get_settings('student_email_verification');
		        $response['status'] = 403;
		        $response['validity'] = false;
            } 
            if (get_settings('student_email_verification') == 'enable') {
            	 if($validity === 'unverified_user'){
            	 	$credentials = array('email' => $_POST['email'], 'status' => 0);
	    			$query = $this->db->get_where('users', $credentials);
	    			$this->email_model->send_email_verification_mail($data['email'], $query->row('verification_code'));
                    $response['message'] = 'You have already signed up. Please check your inbox to verify your email address';
                    $response['email_verification'] = get_settings('student_email_verification');
                }else{
                	$this->email_model->send_email_verification_mail($data['email'], $verification_code);
                     $response['message'] = 'Registration successful. Please check your inbox to verify your email address';
                     $response['email_verification'] = get_settings('student_email_verification');
                }
            } else {
            	$this->user_model->register_user_update_code($data, $data['status']);
            	$response['message'] = 'Registration successful';
            	$response['email_verification'] = get_settings('student_email_verification');
            }
        } else {
        	$response['message'] = 'This email userdata already exists';
        	$response['email_verification'] = get_settings('student_email_verification');
	        $response['status'] = 403;
	        $response['validity'] = false;
        }
	    return $response;
	}

	// Email verify
	public function verify_email_address_post(){
	    $response = array();
	    $credentials = array('email' => $_POST['email'], 'verification_code' => $_POST['verification_code'], 'status' => 0);
	    $query = $this->db->get_where('users', $credentials);
	    if($query->num_rows() > 0){
	      $this->db->where('id', $query->row('id'));
	      $this->db->update('users', array('status' => 1));

	      $response['message'] = 'Email verification successfully';
	      $response['status'] = 200;
	      $response['validity'] = true;
	    }else{
	      $response['message'] = 'Verification code not matched';
	      $response['status'] = 403;
	      $response['validity'] = false;
	    }

	    return $response;
  	}

  	// Resend Verification Code
	public function resend_verification_code_post(){
	    $response = array();
	    $check['email'] = $_POST['email'];
	    $credentials = array('email' => $_POST['email'], 'status' => 0);
	    $query = $this->db->get_where('users', $credentials);
	    if($query->num_rows() > 0) {
	    	$this->email_model->send_email_verification_mail($check['email'], $query->row('verification_code'));
	    	$response['message'] = 'Please check your inbox to verify your email address';
	      	$response['status'] = 200;
	      	$response['validity'] = true;
	    } else{
	    	$response['message'] = 'Verification code not send';
	    	$response['status'] = 403;
	    	$response['validity'] = false;
	    }

	    return $response;
  	}

	// My Courses
	public function my_courses_get($user_id = "")
	{
		$my_courses = array();
		$my_courses_ids = $this->user_model->my_courses($user_id)->result_array();
		foreach ($my_courses_ids as $my_courses_id) {
			$course_details = $this->crud_model->get_course_by_id($my_courses_id['course_id'])->row_array();
			array_push($my_courses, $course_details);
		}
		$my_courses = $this->course_data($my_courses);
		foreach ($my_courses as $key => $my_course) {
			if (isset($my_course['id']) && $my_course['id'] > 0) {
				$my_courses[$key]['completion'] = round(course_progress($my_course['id'], $user_id));
				$my_courses[$key]['total_number_of_lessons'] = $this->crud_model->get_lessons('course', $my_course['id'])->num_rows();
				$my_courses[$key]['total_number_of_completed_lessons'] = $this->get_completed_number_of_lesson($user_id, 'course', $my_course['id']);
			}
		}
		return $my_courses;
	}

	// My Wishlists
	public function my_wishlist_get($user_id = "")
	{
		$wishlists = $this->crud_model->getWishLists($user_id);
		if (sizeof((array)$wishlists) > 0) {
			$this->db->where_in('id', $wishlists);
			$courses = $this->db->get('course')->result_array();
			return $this->course_data($courses);
		} else {
			return array();
		}
	}

	// Remove from wishlist
	public function toggle_wishlist_items_get($user_id = "")
	{
		$status = "";
		$course_id = $_GET['course_id'];
		$wishlists = array();
		$user_details = $this->user_model->get_user($user_id)->row_array();
		$wishlists = json_decode($user_details['wishlist']);
		if (in_array($course_id, $wishlists)) {
			$container = array();
			foreach ($wishlists as $key) {
				if ($key != $course_id) {
					array_push($container, $key);
				}
			}
			$wishlists = $container;
			$status = "removed";
		} else {
			array_push($wishlists, $course_id);
			$status = "added";
		}
		$updater['wishlist'] = json_encode($wishlists);
		$this->db->where('id', $user_id);
		$this->db->update('users', $updater);
		$this->my_wishlist_get($user_id);
		return $status;
	}

	//get all sections
	public function sections_get($course_id = "", $user_id = "")
	{
		$lesson_counter_starts = 0;
		$lesson_counter_ends   = 0;
		$sections = $this->crud_model->get_section('course', $course_id)->result_array();
		foreach ($sections as $key => $section) {
			$sections[$key]['lessons'] = $this->section_wise_lessons($section['id'], $user_id);
			$sections[$key]['total_duration'] = str_replace(' Hours', "", $this->crud_model->get_total_duration_of_lesson_by_section_id($section['id']));
			if ($key == 0) {
				$lesson_counter_starts = 1;
				$lesson_counter_ends = count((array)$sections[$key]['lessons']);
			} else {
				$lesson_counter_starts = $lesson_counter_ends + 1;
				$lesson_counter_ends = $lesson_counter_starts + count((array)$sections[$key]['lessons']);
			}
			$sections[$key]['lesson_counter_starts'] = $lesson_counter_starts;
			$sections[$key]['lesson_counter_ends'] = $lesson_counter_ends;
			if ($user_id > 0) {
				$sections[$key]['completed_lesson_number'] = $this->get_completed_number_of_lesson($user_id, 'section', $section['id']);
			} else {
				$sections[$key]['completed_lesson_number'] = 0;
			}
		}
		$response = $this->add_user_validity($sections);
		return $response;
	}

	public function section_wise_lessons($section_id = "", $user_id = "")
	{
		$response = array();
		$lessons = $this->crud_model->get_lessons('section', $section_id)->result_array();
		foreach ($lessons as $key => $lesson) {
			$response[$key]['id'] = $lesson['id'];
			$response[$key]['title'] = $lesson['title'];
			$response[$key]['duration'] = readable_time_for_humans($lesson['duration_for_mobile_application']);
			$response[$key]['course_id'] = $lesson['course_id'];
			$response[$key]['section_id'] = $lesson['section_id'];
			$response[$key]['video_type'] = ($lesson['video_type_for_mobile_application'] == "" ? "" : $lesson['video_type_for_mobile_application']);
			$response[$key]['video_url'] = ($lesson['video_url_for_mobile_application'] == "" ? "" : $lesson['video_url_for_mobile_application']);;
			$response[$key]['video_url_web'] = $lesson['video_url'];
			$response[$key]['video_type_web'] = $lesson['video_type'];
			$response[$key]['lesson_type'] = $lesson['lesson_type'];
			$response[$key]['is_free'] = $lesson['is_free'];
			if($lesson['lesson_type'] == 'text'){
                $response[$key]['attachment'] = remove_js(htmlspecialchars_decode_($lesson['attachment']));
            }else{
                $response[$key]['attachment'] = $lesson['attachment'];
            }
            $response[$key]['attachment_url'] = base_url() . 'uploads/lesson_files/' . $lesson['attachment'];
            $response[$key]['attachment_type'] = $lesson['attachment_type'];
            $response[$key]['summary'] = remove_js(htmlspecialchars_decode_($lesson['summary']));
			if ($user_id > 0) {
				$response[$key]['is_completed'] = lesson_progress($lesson['id'], $user_id);
			} else {
				$response[$key]['is_completed'] = 0;
			}
		}
		$response = $this->add_user_validity($response);
		return $response;
	}

	public function add_user_validity($responses = array())
	{
		foreach ($responses as $key => $response) {
			$responses[$key]['user_validity'] = true;
		}
		return $responses;
	}

	public function get_completed_number_of_lesson($user_id = "", $type = "", $id = "")
	{
		$counter = 0;
		if ($type == 'section') {
			$lessons = $this->crud_model->get_lessons('section', $id)->result_array();
		} else {
			$lessons = $this->crud_model->get_lessons('course', $id)->result_array();
		}
		foreach ($lessons as $key => $lesson) {
			if (lesson_progress($lesson['id'], $user_id)) {
				$counter = $counter + 1;
			}
		}
		return $counter;
	}

	public function lesson_details_get($user_id = "", $lession_id = "")
	{
		$lesson_details = $this->crud_model->get_lessons('lesson', $lession_id)->result_array();
		foreach ($lesson_details as $key => $lesson_detail) {
			$lesson_details[$key]['duration'] = readable_time_for_humans($lesson_detail['duration']);
		}
		return $this->add_user_validity($lesson_details);
	}

	// Get course details by id
	public function course_details_by_id_get($user_id = "", $course_id = "")
	{
		$course_details = $this->crud_model->get_course_by_id($course_id)->result_array();
		$response = $this->course_data($course_details);
		foreach ($response as $key => $resp) {
			$response[$key]['sections'] = $this->sections_get($course_id);
			$response[$key]['is_wishlisted'] = $this->is_added_to_wishlist($user_id, $course_id);
			$response[$key]['is_purchased'] = $this->is_purchased($user_id, $course_id);
			$response[$key]['includes'] = array(
				$this->crud_model->get_total_duration_of_lesson_by_course_id($course_id) . ' On demand videos',
				$this->crud_model->get_lessons('course', $course_id)->num_rows() . ' Lessons',
				'High quality videos',
				'Life time access'
			);
		}
		return $response;
	}

	public function is_added_to_wishlist($user_id = 0, $course_id = "")
	{
		if ($user_id > 0) {
			$wishlists = array();
			$user_details = $this->user_model->get_all_user($user_id)->row_array();
			$wishlists = json_decode($user_details['wishlist']);
			if (is_array($wishlists) && in_array($course_id, $wishlists)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function is_purchased($user_id = 0, $course_id = "")
	{
		// 0 represents Not purchased, 1 represents Purchased, 2 represents Pending
		if ($user_id > 0) {
			if (enroll_status($course_id, $user_id) == 'valid') {
				return 1;
			}else{
				return 0;
			}
		} else {
			return 0;
		}
	}

	// This function returns a single object of course by its id
	public function course_object_by_id_get()
	{
		$course_id = $_GET['course_id'];
		$course = $this->crud_model->get_course_by_id($course_id)->row_array();
		$course['requirements'] = json_decode($course['requirements']);
		$course['outcomes'] = json_decode($course['outcomes']);
		$course['thumbnail'] = $this->get_image('course_thumbnail', $course['id']);
		if ($course['is_free_course'] == 1) {
			$course['price'] = 'Free';
		} else {
			if ($course['discount_flag'] == 1) {
				$course['price'] = currency($course['discounted_price']);
			} else {
				$course['price'] = currency($course['price']);
			}
		}
		$total_rating =  $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
		$number_of_ratings = $this->crud_model->get_ratings('course', $course['id'])->num_rows();
		if ($number_of_ratings > 0) {
			$course['rating'] = ceil($total_rating / $number_of_ratings);
		} else {
			$course['rating'] = 0;
		}
		$course['number_of_ratings'] = $number_of_ratings;
		$instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();
		$course['instructor_name'] = $instructor_details['first_name'] . ' ' . $instructor_details['last_name'];
		$course['total_enrollment'] = $this->crud_model->enrol_history($course['id'])->num_rows();
		$course['shareable_link'] = site_url('home/course/' . slugify($course['title']) . '/' . $course['id']);
		return $course;
	}

	// save lesson completion status
	// code of mark this lesson as completed
	function save_course_progress_get($user_id = "")
	{
		$lesson_id = $_GET['lesson_id'];
		$lesson_details = $this->crud_model->get_lessons('lesson', $lesson_id)->row_array();
		$this->crud_model->update_watch_history_manually($lesson_id, $lesson_details['course_id'], $user_id);
		return $this->course_completion_data($lesson_details['course_id'], $user_id);
	}

	private function course_completion_data($course_id = "", $user_id = "")
	{
		$response = array();
		$course = $this->crud_model->get_course_by_id($course_id)->row_array();
		$response['course_id'] = $course['id'];
		$response['number_of_lessons'] = $this->crud_model->get_lessons('course', $course_id)->num_rows();
		$response['number_of_completed_lessons'] = $this->get_completed_number_of_lesson($user_id, 'course', $course_id);
		$response['course_progress'] = round(course_progress($course_id, $user_id));
		return $response;
	}

	public function userdata_get($user_id = "")
	{
		$user_details = $this->user_model->get_all_user($user_id)->row_array();
		$response['id'] = $user_details['id'];
		$response['first_name'] = $user_details['first_name'];
		$response['last_name'] = $user_details['last_name'];
		$response['email'] = $user_details['email'];
		$social_links = json_decode($user_details['social_links'], true);
		$response['facebook'] = $social_links['facebook'];
		$response['twitter'] = $social_links['twitter'];
		$response['linkedin'] = $social_links['linkedin'];
		$response['biography'] = $user_details['biography'];
		$response['image'] = $this->user_model->get_user_image_url($user_details['id']);
		return $response;
	}

	public function update_userdata_post($user_id = "")
	{
		$response = array();
		$validity = $this->user_model->check_duplication('on_update', $this->input->post('email'), $user_id);
		if ($validity) {
			if (html_escape($this->input->post('first_name')) != "") {
				$data['first_name'] = html_escape($this->input->post('first_name'));
			} else {
				$response['status'] = 'failed';
				$response['error_reason'] = 'First name can not be empty';
				return $response;
			}
			if (html_escape($this->input->post('last_name')) != "") {
				$data['last_name'] = html_escape($this->input->post('last_name'));
			} else {
				$response['status'] = 'failed';
				$response['error_reason'] = 'Last name can not be empty';
				return $response;
			}
			if (isset($_POST['email']) && html_escape($this->input->post('email')) != "") {
				$data['email'] = html_escape($this->input->post('email'));
			} else {
				$response['status'] = 'failed';
				$response['error_reason'] = 'Email can not be empty';
				return $response;
			}

			$social_link['facebook'] = html_escape($this->input->post('facebook_link'));
			$social_link['twitter'] = html_escape($this->input->post('twitter_link'));
			$social_link['linkedin'] = html_escape($this->input->post('linkedin_link'));
			$data['social_links'] = json_encode($social_link);
			$data['biography'] = $this->input->post('biography');
			$this->db->where('id', $user_id);
			$this->db->update('users', $data);
			$response = $this->userdata_get($user_id);
			$response['status'] = 'success';
			$response['error_reason'] = 'None';
		} else {
			$response['status'] = 'failed';
			$response['error_reason'] = 'Email duplication';
		}
		return $response;
	}

	public function update_password_post($user_id = "")
	{
		$response = array();
		if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
			$user_details = $this->user_model->get_user($user_id)->row_array();
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password');
			$confirm_password = $this->input->post('confirm_password');
			if ($user_details['password'] == sha1($current_password) && $new_password == $confirm_password) {
				$data['password'] = sha1($new_password);
				$this->db->where('id', $user_id);
				$this->db->update('users', $data);
				$response['status'] = 'success';
			} else {
				$response['status'] = 'failed';
			}
		} else {
			$response['status'] = 'failed';
		}

		return $response;
	}

	public function certificate_addon_get($user_id = "", $course_id = "")
	{
		$response = array();
		if (addon_status('certificate')) {
			$response['addon_status'] = 'success';

			$this->load->model('addons/Certificate_model', 'certificate_model');
			$course_progress = course_progress($course_id, $user_id);
			if ($course_progress == 100) {
				$checker = array(
					'course_id' => $course_id,
					'student_id' => $user_id
				);
				$previous_data = $this->db->get_where('certificates', $checker);
				if ($previous_data->num_rows() == 0) {

					$certificate_identifier = substr(sha1($user_id . '-' . $course_id . '-' . date('d-M-Y')), 0, 10);
					$certificate_link = base_url('uploads/certificates/' . $certificate_identifier . '.jpg');
					$insert_data = array(
						'course_id' => $course_id,
						'student_id' => $user_id,
						'shareable_url' => $certificate_identifier . '.jpg'
					);
					$this->db->insert('certificates', $insert_data);
					$this->certificate_model->create_certificate($user_id, $course_id, $certificate_identifier);
					$this->email_model->notify_on_certificate_generate($user_id, $course_id);
					$certificate_link = base_url('uploads/certificates/' . $certificate_identifier . '.jpg');
				} else {
					$previous_data = $previous_data->row_array();
					$certificate_link = base_url('uploads/certificates/' . $previous_data['shareable_url']);
				}

				$response['is_completed'] = 1;
				$response['certificate_shareable_url'] = $certificate_link;
			} else {
				$response['is_completed'] = 0;
				$response['certificate_shareable_url'] = "";
			}
		} else {
			$response['addon_status'] = 'failed';
			$response['is_completed'] = 0;
			$response['certificate_shareable_url'] = "";
		}

		return $response;
	}
	

	function forgot_password_post(){
    	$email = $this->input->post('email');
        $verification_code = str_replace('=', '', base64_encode($email.'_Uh6#@#6hU_'.rand(111111, 9999999)));
        $this->db->where('email', $email);
        $this->db->update('users', array('verification_code' => $verification_code, 'last_modified' => time()));
        // send new password reset link to user email
        $this->email_model->password_reset_email($verification_code, $email);
        return true;
    }



//Start bundle addon
	// get the bundle courses
	public function bundles_get($limit ="")
	{
		$this->load->model('addons/course_bundle_model');
		$result = array();

		if ($limit != "") {
			$this->db->limit($limit);
		}
		$this->db->order_by('id', 'DESC');
		$this->db->where('status', 1);
		$bundle_courses = $this->db->get('course_bundle')->result_array();
		
		foreach ($bundle_courses as $key => $bundle_course) {
			$ratings = $this->course_bundle_model->get_bundle_wise_ratings($bundle_course['id']);
			$bundle_total_rating = $this->course_bundle_model->sum_of_bundle_rating($bundle_course['id']);
			if ($ratings->num_rows() > 0) {
				$bundle_course['average_rating'] = ceil($bundle_total_rating / $ratings->num_rows());
				$bundle_course['number_of_ratings'] = $ratings->num_rows();
				$bundle_course['price'] = currency($bundle_course['price']);
			}else {
				$bundle_course['average_rating'] = 0;
				$bundle_course['number_of_ratings'] = 0;
				$bundle_course['price'] = currency($bundle_course['price']);
			}

			$result[$key] = $bundle_course;
		}

		return $result;
	}
	
	public function bundle_courses_get($bundle_id = "", $user_id = "")
	{
		$this->load->model('addons/course_bundle_model');
		$result = array();
		$index = 0;
		$this->db->where('id', $bundle_id);
		$this->db->where('status', 1);
		$bundle_details 		= $this->db->get('course_bundle')->row_array();
		$user_details 		= $this->db->get_where('users', array('id' => $bundle_details['user_id']))->row_array();
		$result['id'] 			= $bundle_details['id'];
		$result['user_id'] 		= $bundle_details['user_id'];
		$result['title'] 		= $bundle_details['title'];
		$result['banner'] 		= $bundle_details['banner'];
		$result['course_ids'] 	= $bundle_details['course_ids'];
		$result['subscription_limit'] = $bundle_details['subscription_limit'];
		$result['price'] 		= currency($bundle_details['price']);
		$result['bundle_details'] = $bundle_details['bundle_details'];
		$result['status'] 		= $bundle_details['status'];
		$result['date_added'] 	= $bundle_details['date_added'];
		$result['user_name'] = $user_details['first_name'].' '.$user_details['last_name'];
		$result['user_image'] = $this->user_model->get_user_image_url($user_details['id']);


		$ratings = $this->course_bundle_model->get_bundle_wise_ratings($bundle_details['id']);
		$bundle_total_rating = $this->course_bundle_model->sum_of_bundle_rating($bundle_details['id']);
		if ($ratings->num_rows() > 0) {
			$result['average_rating'] = ceil($bundle_total_rating / $ratings->num_rows());
			$result['number_of_ratings'] = $ratings->num_rows();
		}else {
			$result['average_rating'] = 0;
			$result['number_of_ratings'] = 0;
		}

		if($user_id != ""){
			$result['subscription_status'] = get_bundle_validity($bundle_details['id'], $user_id);
		}else{
			$result['subscription_status'] = 'invalid';
		}
		
		// This block of codes return the required data of bundle courses
		$bundle_course_ids = json_decode($bundle_details['course_ids']);

		$this->db->where_in('id', $bundle_course_ids);
		$this->db->where('status', 'active');
		$courses = $this->db->get('course')->result_array();
		$result['bundle_courses'] = $this->course_data($courses);

		return array($result);
	}

	public function my_bundles_get($user_id = ""){
		$this->load->model('addons/course_bundle_model');
		$result = array();

		$this->db->order_by('id', 'desc');
		$this->db->where('user_id', $user_id);
		$bundle_payments = $this->db->get('bundle_payment')->result_array();
		
		foreach ($bundle_payments as $key => $bundle_payment) {
			$this->db->where('id', $bundle_payment['bundle_id']);
			$bundle_details = $this->db->get('course_bundle')->row_array();
			$user_details 		= $this->db->get_where('users', array('id' => $bundle_details['user_id']))->row_array();
			$bundle_details['user_name'] = $user_details['first_name'].' '.$user_details['last_name'];
			$bundle_details['user_image'] = $this->user_model->get_user_image_url($user_details['id']);
			$ratings = $this->course_bundle_model->get_bundle_wise_ratings($bundle_details['id']);
			$bundle_total_rating = $this->course_bundle_model->sum_of_bundle_rating($bundle_details['id']);
			if ($ratings->num_rows() > 0) {
				$bundle_details['average_rating'] = ceil($bundle_total_rating / $ratings->num_rows());
				$bundle_details['number_of_ratings'] = $ratings->num_rows();
			}else {
				$bundle_details['average_rating'] = 0;
				$bundle_details['number_of_ratings'] = 0;
			}
			$bundle_details['price'] = currency($bundle_details['price']);
			$bundle_details['subscription_status'] = get_bundle_validity($bundle_details['id'], $user_id);

			$result[$key] = $bundle_details;
		}

		return $result;
	}

	public function my_bundle_course_details_get($user_id= "", $bundle_id = "", $course_id = "")
	{
		if(get_bundle_validity($bundle_id, $user_id) != 'valid'){return array(); }

		$my_bundle_course_details = array();
		$course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
		array_push($my_bundle_course_details, $course_details);
		
		$my_bundle_course_details = $this->course_data($my_bundle_course_details);
		foreach ($my_bundle_course_details as $key => $my_course) {
			if (isset($my_course['id']) && $my_course['id'] > 0) {
				$my_bundle_course_details[$key]['completion'] = round(course_progress($my_course['id'], $user_id));
				$my_bundle_course_details[$key]['total_number_of_lessons'] = $this->crud_model->get_lessons('course', $my_course['id'])->num_rows();
				$my_bundle_course_details[$key]['total_number_of_completed_lessons'] = $this->get_completed_number_of_lesson($user_id, 'course', $my_course['id']);
			}
		}
		return $my_bundle_course_details;
	}
//End Bundle








  //Start Form addon
	public function forum_add_questions_post($user_id = "", $course_id = "") {
	    $response = array('status' => 200, 'message' => 'Your question has been added');

	    $data['user_id'] = $user_id;
	    $data['course_id'] = $course_id;
	    $data['title'] = $this->input->post('title');
	    $data['description'] = $this->input->post('description');
	    $data['is_parent'] = 0;
	    $data['date_added'] = time();

	    $this->db->insert('course_forum', $data);
	    if($this->db->insert_id() > 0){
	    	return $response;
	    }
	}


	public function forum_questions_get($user_id, $course_id = "", $page_number = 0, $limit = 20){
		if($page_number != 0){
			$offset = ($page_number * $limit) - $limit;
		}else{
			$offset = 0;
		}

		$question_arr = array();
		$this->db->order_by('id', 'DESC');
		$this->db->limit($limit, $offset);
		$this->db->where('course_id', $course_id);
		$this->db->where('is_parent', 0);
		$questions = $this->db->get('course_forum');

		foreach($questions->result_array() as $key => $question):
			$user_details 		= $this->db->get_where('users', array('id' => $question['user_id']))->row_array();
			$question_arr[$key] = $question;
			$question_arr[$key]['user_name'] = $user_details['first_name'].' '.$user_details['last_name'];
			$question_arr[$key]['user_image'] = $this->user_model->get_user_image_url($question['user_id']);


			$upvoted_user_arr = json_decode($question['upvoted_user_id']);
			if(is_array($upvoted_user_arr)){
				$upvoted_user_number = count($upvoted_user_arr);
			}else{
				$upvoted_user_number = 0;
			}
			$question_arr[$key]['upvoted_user_number'] = $upvoted_user_number;
			$question_arr[$key]['comment_number'] = $this->db->get_where('course_forum', array('is_parent' => $question['id']))->num_rows();
			if(is_array($upvoted_user_arr)){
				$is_liked = in_array($user_id, $upvoted_user_arr);
			} else {
				$is_liked = false;
			}
			$question_arr[$key]['is_liked'] = $is_liked;
		endforeach;
		return $question_arr;
	}



	public function search_forum_questions_get($user_id, $course_id = ""){
		$search_val = $_GET['search'];

		$question_arr = array();
		$this->db->order_by('id', 'DESC');

		$this->db->like('title', $search_val);
		$this->db->or_like('description', $search_val);

		$this->db->where('course_id', $course_id);
		$this->db->where('is_parent', 0);
		$questions = $this->db->get('course_forum');

		foreach($questions->result_array() as $key => $question):
			$user_details 		= $this->db->get_where('users', array('id' => $question['user_id']))->row_array();
			$question_arr[$key] = $question;
			$question_arr[$key]['user_name'] = $user_details['first_name'].' '.$user_details['last_name'];
			$question_arr[$key]['user_image'] = $this->user_model->get_user_image_url($question['user_id']);
			

			$upvoted_user_arr = json_decode($question['upvoted_user_id']);
			if(is_array($upvoted_user_arr)){
				$upvoted_user_number = count($upvoted_user_arr);
			}else{
				$upvoted_user_number = 0;
			}
			$question_arr[$key]['upvoted_user_number'] = $upvoted_user_number;
			$question_arr[$key]['comment_number'] = $this->db->get_where('course_forum', array('is_parent' => $question['id']))->num_rows();
			if(is_array($upvoted_user_arr)){
				$is_liked = in_array($user_id, $upvoted_user_arr);
			} else {
				$is_liked = false;
			}
			$question_arr[$key]['is_liked'] = $is_liked;
		endforeach;
		return $question_arr;
	}

	public function add_questions_reply_post($user_id = "", $parent_id = "") {
	    $response = array('status' => 200, 'message' => 'Your reply has been added');

	    $data['user_id'] = $user_id;
	    $data['course_id'] = $this->db->get_where('course_forum', array('id' => $parent_id))->row()->course_id;
	    $data['description'] = $this->input->post('description');
	    $data['is_parent'] = $parent_id;
	    $data['date_added'] = time();

	    $this->db->insert('course_forum', $data);
	    if($this->db->insert_id() > 0){
	    	return $response;
	    }
	}

	public function forum_child_questions_get($parent_question_id = "") {
		$question_arr = array();
		$this->db->where('is_parent', $parent_question_id);
		$child_questions = $this->db->get('course_forum');

		foreach($child_questions->result_array() as $key => $question):
			$user_details 		= $this->db->get_where('users', array('id' => $question['user_id']))->row_array();
			$question_arr[$key] = $question;
			$question_arr[$key]['user_name'] = $user_details['first_name'].' '.$user_details['last_name'];
			$question_arr[$key]['user_image'] = $this->user_model->get_user_image_url($question['user_id']);
		endforeach;

		return $question_arr;
	}

	public function forum_question_vote_get($user_id = "", $question_id = ""){
		$array_data = array();

        $this->db->where('id', $question_id);
        $upvoted_user_ids = $this->db->get_where('course_forum')->row('upvoted_user_id');
        if($upvoted_user_ids == 'null' || $upvoted_user_ids == null){
            $data['upvoted_user_id'] = json_encode(array(0 => $user_id));
            $return_type =  'upvoted';
        }else{
            $array_of_user_id = json_decode($upvoted_user_ids);
            $array_data = $array_of_user_id;

            if(in_array($user_id, $array_of_user_id)){
                $key = array_search($user_id, $array_of_user_id);
                unset($array_data[$key]);
                $array_data = array_values($array_data);
                $return_type =  'unvoted';
            }else{
                array_push($array_data, $user_id);
                $return_type = 'upvoted';
            }

            $data['upvoted_user_id'] = json_encode($array_data);

        }

        $this->db->where('id', $question_id);
        $this->db->update('course_forum', $data);

        $response['type'] = $return_type;
        $response['total'] = count((array)$array_data);
        return $response;
	}

	public function forum_question_delete_get($user_id = "", $question_id = ""){
		$response = array('status' => 200, 'message' => 'Your comment has been deleted');

		$this->db->where('user_id', $user_id);
		$this->db->where('id', $question_id);
        $this->db->delete('course_forum');
        return $response;
	}


	function update_watch_history_with_duration_post($user_id = "")
    {
        $course_progress = 0;
        $is_completed = 0;
        $number_of_completed_lessons = 0;
        $data['watched_course_id'] = htmlspecialchars_($this->input->post('course_id'));
        $data['watched_lesson_id'] = htmlspecialchars_($this->input->post('lesson_id'));
        $data['watched_student_id'] = $user_id;

        $current_duration = htmlspecialchars_($this->input->post('current_duration'));

        $current_history = $this->db->get_where('watched_duration', $data);
        if ($current_history->num_rows() > 0) {
            $current_history = $current_history->row_array();
            $watched_duration_arr = json_decode($current_history['watched_counter'], true);
            if (!is_array($watched_duration_arr)) $watched_duration_arr = array();
            if (!in_array($current_duration, $watched_duration_arr)) {
                array_push($watched_duration_arr, $current_duration);
            }

            $watched_duration_json = json_encode($watched_duration_arr);

            $this->db->where('watched_course_id', $data['watched_course_id']);
            $this->db->where('watched_lesson_id', $data['watched_lesson_id']);
            $this->db->where('watched_student_id', $data['watched_student_id']);
            $this->db->update('watched_duration', array('watched_counter' => $watched_duration_json));
        } else {
            $watched_duration_arr = array($current_duration);
            $data['watched_counter'] = json_encode($watched_duration_arr);
            $this->db->insert('watched_duration', $data);
        }


        $drip_content_settings = json_decode(get_settings('drip_content_settings'), true);
        $lesson_total_duration = $this->db->get_where('lesson', array('id' => $data['watched_lesson_id']))->row('duration');
        $lesson_total_duration = explode(':', $lesson_total_duration);
        $lesson_total_seconds = ($lesson_total_duration[0] * 3600) + ($lesson_total_duration[1] * 60) + $lesson_total_duration[2];
        $current_total_seconds = count((array)$watched_duration_arr) * 5;

        if ($drip_content_settings['lesson_completion_role'] == 'duration') {
            if ($current_total_seconds >= $drip_content_settings['minimum_duration']) {
                $is_completed = 1;
            } elseif (($current_total_seconds + 4) >= $lesson_total_seconds) {
                $is_completed = 1;
            }
        } else {
            $required_duration = ($lesson_total_seconds / 100) * $drip_content_settings['minimum_percentage'];
            if ($current_total_seconds >= $required_duration) {
                $is_completed = 1;
            } elseif (($current_total_seconds + 4) >= $lesson_total_seconds) {
                $is_completed = 1;
            }
        }

        if ($is_completed == 1) {
            $query = $this->db->get_where('watch_histories', array('course_id' => $data['watched_course_id'], 'student_id' => $data['watched_student_id']));
            $course_progress = $query->row('course_progress');

            if ($query->num_rows() > 0) {
                $lesson_ids = json_decode($query->row('completed_lesson'), true);
                if (!is_array($lesson_ids)) $lesson_ids = array();
                if (!in_array($data['watched_lesson_id'], $lesson_ids)) {
                    array_push($lesson_ids, $data['watched_lesson_id']);
                    $total_lesson = $this->db->get_where('lesson', array('course_id' => $data['watched_course_id']))->num_rows();
                    $course_progress = (100 / $total_lesson) * count((array)$lesson_ids);

                    $this->db->where('watch_history_id', $query->row('watch_history_id'));
                    $this->db->update('watch_histories', array('course_progress' => $course_progress, 'completed_lesson' => json_encode($lesson_ids), 'date_updated' => time()));

                    // CHECK IF THE USER IS ELIGIBLE FOR CERTIFICATE
                    if (addon_status('certificate') && $course_progress >= 100) {
                        $this->load->model('addons/Certificate_model', 'certificate_model');
                        $this->certificate_model->check_certificate_eligibility($data['watched_course_id'], $data['watched_student_id']);
                    }

                    $number_of_completed_lessons = count((array)$lesson_ids);
                }else{
                	$number_of_completed_lessons = count((array)$lesson_ids);
                }
            }
        }
        return array('lesson_id' => $data['watched_lesson_id'], 'course_progress' => round($course_progress), 'is_completed' => $is_completed, 'number_of_completed_lessons' => $number_of_completed_lessons);
    }

//End Forum addon




//Logged in from mobile app only for web view. Avoite tracking multiple device login for mbile app web view
    function login_for_web_view($user_id = ""){
    	$query = $this->user_model->get_all_user($user_id);
    	if($query->num_rows() > 0){
	    	$row = $query->row();
	    	if($this->session->userdata('user_login') != '1'){
	    		//Session data added for 12 hours only for mobile view browser
				$this->session->set_userdata('custom_session_limit', (time()+43200));
				$this->session->set_userdata('user_id', $row->id);
				$this->session->set_userdata('role_id', $row->role_id);
				$this->session->set_userdata('role', get_user_role('user_role', $row->id));
				$this->session->set_userdata('name', $row->first_name . ' ' . $row->last_name);
				$this->session->set_userdata('is_instructor', $row->is_instructor);
				$this->session->set_userdata('user_login', '1');
		    }
		}
    }








}
