<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function get_admin_details()
    {
        return $this->db->get_where('users', array('role_id' => 1));
    }

    public function get_user($user_id = 0)
    {
        if ($user_id > 0) {
            $this->db->where('id', $user_id);
        }
        $this->db->where('role_id', 2);
        return $this->db->get('users');
    }

    public function get_all_user($user_id = 0)
    {
        if ($user_id > 0) {
            $this->db->where('id', $user_id);
        }
        return $this->db->get('users');
    }

    public function add_user($is_instructor = false, $is_admin = false)
    {
        $validity = $this->check_duplication('on_create', $this->input->post('email'));
        if ($validity == false) {
            $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
        } else {
          //  $data['unique_identifier'] = 0;
            $data['first_name'] = html_escape($this->input->post('first_name'));
            $data['last_name'] = html_escape($this->input->post('last_name'));
            $data['email'] = html_escape($this->input->post('email'));
            $data['password'] = sha1(html_escape($this->input->post('password')));
            $social_link['facebook'] = html_escape($this->input->post('facebook_link'));
            $social_link['twitter'] = html_escape($this->input->post('twitter_link'));
            $social_link['linkedin'] = html_escape($this->input->post('linkedin_link'));
            $data['social_links'] = json_encode($social_link);
            $data['biography'] = $this->input->post('biography');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');

            if ($is_admin) {
                $data['role_id'] = 1;
                //$data['is_instructor'] = 1;
            } else {
                $data['role_id'] = 2;
            }

            $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
            $data['wishlist'] = json_encode(array());
            $data['status'] = 1;
            $data['image'] = md5(rand(10000, 10000000));

            //All payment keys
            if(isset($_POST['gateways'])){
                $data['payment_keys'] = json_encode($_POST['gateways']);
            }

            if ($is_instructor) {
                $data['is_instructor'] = 1;
            }

            if (isset($_POST['country'])) {
                $data['country'] = html_escape($this->input->post('country'));
            }

            if (isset($_POST['city'])) {
                $data['city'] = html_escape($this->input->post('city'));
            }
            if (isset($_POST['ni_no'])) {
                $data['ni_no'] = html_escape($this->input->post('ni_no'));
            }
            if (isset($_POST['building_no'])) {
                $data['building_no'] = html_escape($this->input->post('building_no'));
            }

            if (isset($_POST['off_the_job_training'])) {
                $data['off_the_job_training'] = html_escape($this->input->post('off_the_job_training'));
            }
            if (isset($_POST['accessor'])) {
                $data['accessor'] = html_escape($this->input->post('accessor'));
            }
            if (isset($_POST['ui_no'])) {
                $data['ui_no'] = html_escape($this->input->post('ui_no'));
            }
            if (isset($_POST['cohort'])) {
                $data['cohort'] = html_escape($this->input->post('cohort'));
            }
            if (isset($_POST['employer'])) {
                $data['employer'] = html_escape($this->input->post('employer'));
            }
            if (isset($_POST['partner'])) {
                $data['partner'] = html_escape($this->input->post('partner'));
            }
            if (isset($_POST['expected_completion_date'])) {
                $data['expected_completion_date'] = html_escape($this->input->post('expected_completion_date'));
            }

            $this->db->insert('users', $data);
            $user_id = $this->db->insert_id();
         //   $this->user_model->update_unique_identifier($user_id);

            $system_name=get_settings('system_name');
            $this->email_model->add_user_cv($data['email'],"Your $system_name account is ready","Congratulations {$data['first_name']} {$data['last_name']}!! <br>Your account has been created on $system_name. Here are your login credentials: <br> <div style='width:100%;display:block;'><div style='width:50%;text-align:left;display:inline-block;'>email:</div><div style='width:50%;text-align:left;display:inline-block;'> {$data['email']}</div></div> <div style='width:100%;display:block;'><div style='width:50%;text-align:left;display:inline-block;'>Password:</div><div style='width:50%;text-align:left;display:inline-block;'>{$data['password']}</div></div> <br> Happy learning!");


            // IF THIS IS A USER THEN INSERT BLANK VALUE IN PERMISSION TABLE AS WELL
            if ($is_admin) {
                $permission_data['admin_id'] = $user_id;
                $permission_data['permissions'] = json_encode(array());
                $this->db->insert('permissions', $permission_data);
            }

            $this->upload_user_image($data['image']);
            $this->session->set_flashdata('flash_message', get_phrase('user_added_successfully'));
        }
    }

    public function add_shortcut_user($is_instructor = false)
    {
        $validity = $this->check_duplication('on_create', $this->input->post('email'));
        if ($validity == false) {
            $response['status'] = 0;
            $response['message'] = get_phrase('this_email_already_exits') . '. ' . get_phrase('please_use_another_email');
            return json_encode($response);
        } else {
          //  $data['unique_identifier'] = 0;
            $data['first_name'] = html_escape($this->input->post('first_name'));
            $data['last_name'] = html_escape($this->input->post('last_name'));
            $data['email'] = html_escape($this->input->post('email'));
            $data['password'] = sha1(html_escape($this->input->post('password')));
            $social_link['facebook'] = '';
            $social_link['twitter'] = '';
            $social_link['linkedin'] = '';
            $data['social_links'] = json_encode($social_link);
            $data['role_id'] = 2;
            $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
            $data['wishlist'] = json_encode(array());
            $data['status'] = 1;
            $data['image'] = md5(rand(10000, 10000000));

            // Add paypal keys
            $payment_keys = array();

            $paypal['production_client_id']  = '';
            $paypal['production_secret_key'] = '';
            $payment_keys['paypal'] = $paypal;

            // Add Stripe keys
            $stripe['public_live_key'] = '';
            $stripe['secret_live_key'] = '';
            $payment_keys['stripe'] = $stripe;

            // Add razorpay keys
            $razorpay['key_id'] = '';
            $razorpay['secret_key'] = '';
            $payment_keys['razorpay'] = $razorpay;

            //All payment keys
            $data['payment_keys'] = json_encode(array());

            if ($is_instructor) {
                $data['is_instructor'] = 1;
            }
            $this->db->insert('users', $data);

            $user_id = $this->db->insert_id();
           // $this->user_model->update_unique_identifier($user_id);

            $system_name=get_settings('system_name');
            $this->email_model->add_user_cv($data['email'],"Your $system_name account is ready","Congratulations {$data['first_name']} {$data['last_name']}!! <br>Your account has been created on $system_name. Here are your login credentials: <br> <div style='width:100%;display:block;'><div style='width:50%;text-align:left;display:inline-block;'>email:</div><div style='width:50%;text-align:left;display:inline-block;'> {$data['email']}</div></div> <div style='width:100%;display:block;'><div style='width:50%;text-align:left;display:inline-block;'>Password:</div><div style='width:50%;text-align:left;display:inline-block;'>{$data['password']}</div></div> <br> Happy learning!");

            $this->session->set_flashdata('flash_message', get_phrase('user_added_successfully'));
            $response['status'] = 1;
            return json_encode($response);
        }
    }

    public function check_duplication($action = "", $email = "", $user_id = "")
    {
        $duplicate_email_check = $this->db->get_where('users', array('email' => $email));

        if ($action == 'on_create') {
            if ($duplicate_email_check->num_rows() > 0) {
                if ($duplicate_email_check->row()->status == 1) {
                    return false;
                } else {
                    return 'unverified_user';
                }
            } else {
                return true;
            }
        } elseif ($action == 'on_update') {
            if ($duplicate_email_check->num_rows() > 0) {
                if ($duplicate_email_check->row()->id == $user_id) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }
    }

    public function edit_user($user_id = "")
    { // Admin does this editing
        $validity = $this->check_duplication('on_update', $this->input->post('email'), $user_id);
        if ($validity) {
            $data['first_name'] = html_escape($this->input->post('first_name'));
            $data['last_name'] = html_escape($this->input->post('last_name'));

            if (isset($_POST['email'])) {
                $data['email'] = html_escape($this->input->post('email'));
            }
            if (isset($_POST['phone'])) {
                $data['phone'] = html_escape($this->input->post('phone'));
            }
            if (isset($_POST['country'])) {
                $data['country'] = html_escape($this->input->post('country'));
            }
            if (isset($_POST['city'])) {
                $data['city'] = html_escape($this->input->post('city'));
            }
            if (isset($_POST['ni_no'])) {
                $data['ni_no'] = html_escape($this->input->post('ni_no'));
            }
            if (isset($_POST['building_no'])) {
                $data['building_no'] = html_escape($this->input->post('building_no'));
            }
            if (isset($_POST['address'])) {
                $data['address'] = html_escape($this->input->post('address'));
            }
            if (isset($_POST['off_the_job_training'])) {
                $data['off_the_job_training'] = html_escape($this->input->post('off_the_job_training'));
            }
            if (isset($_POST['accessor'])) {
                $data['accessor'] = html_escape($this->input->post('accessor'));
            }
            if (isset($_POST['ui_no'])) {
                $data['ui_no'] = html_escape($this->input->post('ui_no'));
            }
            if (isset($_POST['cohort'])) {
                $data['cohort'] = html_escape($this->input->post('cohort'));
            }
            if (isset($_POST['employer'])) {
                $data['employer'] = html_escape($this->input->post('employer'));
            }
            if (isset($_POST['partner'])) {
                $data['partner'] = html_escape($this->input->post('partner'));
            }
            if (isset($_POST['expected_completion_date'])) {
                $data['expected_completion_date'] = html_escape($this->input->post('expected_completion_date'));
            }

            if (isset($_POST['post_code'])) {
                $data['post_code'] = html_escape($this->input->post('post_code'));
            }
            $social_link['facebook'] = html_escape($this->input->post('facebook_link'));
            $social_link['twitter'] = html_escape($this->input->post('twitter_link'));
            $social_link['linkedin'] = html_escape($this->input->post('linkedin_link'));
            $data['social_links'] = json_encode($social_link);
            $data['biography'] = $this->input->post('biography');
            $data['title'] = html_escape($this->input->post('title'));
            $data['skills'] = html_escape($this->input->post('skills'));
            $data['last_modified'] = strtotime(date("Y-m-d H:i:s"));

            if (isset($_FILES['user_image']) && $_FILES['user_image']['name'] != "") {
                unlink('uploads/user_image/' . $this->db->get_where('users', array('id' => $user_id))->row('image') . '.jpg');
                $data['image'] = md5(rand(10000, 10000000));
                $this->upload_user_image($data['image']);
            }

            //All payment keys
            if(isset($_POST['gateways'])){
                $data['payment_keys'] = json_encode($_POST['gateways']);
            }

            $this->db->where('id', $user_id);
            $this->db->update('users', $data);
            $this->session->set_flashdata('flash_message', get_phrase('user_update_successfully'));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
        }
    }
    public function delete_user($user_id = "")
    {
        $this->db->where('id', $user_id);
        $this->db->delete('users');
        $this->session->set_flashdata('flash_message', get_phrase('user_deleted_successfully'));
    }

    public function unlock_screen_by_password($password = "")
    {
        $password = sha1($password);
        return $this->db->get_where('users', array('id' => $this->session->userdata('user_id'), 'password' => $password))->num_rows();
    }

    public function register_user($data)
    {
        $this->db->insert('users', $data);
        $user_id = $this->db->insert_id();
       // $this->user_model->update_unique_identifier($user_id);
        return $user_id;
    }

    public function register_user_update_code($data, $status = "")
    {

        //If get back disabled user and again signup
        $update_code['status'] = $status;

        $update_code['verification_code'] = $data['verification_code'];
        $update_code['password'] = $data['password'];
        $this->db->where('email', $data['email']);
        $this->db->update('users', $update_code);
    }

    public function my_courses($user_id = "")
    {
        if ($user_id == "") {
            $user_id = $this->session->userdata('user_id');
        }
        return $this->db->get_where('enrol', array('user_id' => $user_id));
    }

    public function upload_user_image($image_code)
    {
        if (isset($_FILES['user_image']) && $_FILES['user_image']['name'] != "") {
            move_uploaded_file($_FILES['user_image']['tmp_name'], 'uploads/user_image/' . $image_code . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('user_update_successfully'));
        }
    }

    public function update_account_settings($user_id)
    {
        $validity = $this->check_duplication('on_update', $this->input->post('email'), $user_id);
        if ($validity) {
            if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
                $user_details = $this->get_user($user_id)->row_array();
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password');
                $confirm_password = $this->input->post('confirm_password');
                if ($user_details['password'] == sha1($current_password) && $new_password == $confirm_password) {
                    $data['password'] = sha1($new_password);
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('mismatch_password'));
                    return;
                }
            }
            $this->db->where('id', $user_id);
            $this->db->update('users', $data);
            $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
        }
    }

    public function change_password($user_id)
    {
        $data = array();
        if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
            $user_details = $this->get_all_user($user_id)->row_array();
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');

            if ($user_details['password'] == sha1($current_password) && $new_password == $confirm_password) {
                $data['password'] = sha1($new_password);
            } else {
                $this->session->set_flashdata('error_message', get_phrase('mismatch_password'));
                return;
            }
        }

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
        $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
    }


    public function get_instructor($id = 0)
    {
        if ($id > 0) {
            return $this->db->get_where('users', array('id' => $id, 'is_instructor' => 1));
        } else {
            return $this->db->get_where('users', array('is_instructor' => 1));
        }
    }

    public function get_instructor_by_email($email = null)
    {
        return $this->db->get_where('users', array('email' => $email, 'is_instructor' => 1));
    }

    public function get_admins($id = 0)
    {
        if ($id > 0) {
            return $this->db->get_where('users', array('id' => $id, 'role_id' => 1));
        } else {
            return $this->db->get_where('users', array('role_id' => 1));
        }
    }

    public function get_number_of_active_courses_of_instructor($instructor_id)
    {
        $result = $this->crud_model->get_courses_by_instructor_id($instructor_id, 'active');
        return $result->num_rows();
    }

    public function get_user_image_url($user_id)
    {
        $user_profile_image = $this->db->get_where('users', array('id' => $user_id))->row('image');
        if (file_exists('uploads/user_image/optimized/' . $user_profile_image . '.jpg')){
            return base_url() . 'uploads/user_image/optimized/' . $user_profile_image . '.jpg';
        }elseif(file_exists('uploads/user_image/' . $user_profile_image . '.jpg')){
            //resizeImage
            resizeImage('uploads/user_image/' . $user_profile_image . '.jpg', 'uploads/user_image/optimized/', 220);
            return base_url() . 'uploads/user_image/' . $user_profile_image . '.jpg';
        }else{
            return base_url() . 'uploads/user_image/placeholder.png';
        }
    }

    public function get_instructor_list()
    {
        return $this->db->get_where('users', array('status' => '1', 'is_instructor' => '1'));
        // $query1 = $this->db->get_where('course', array('status' => 'active'))->result_array();
        // $instructor_ids = array();
        // $query_result = array();
        // foreach ($query1 as $row1) {
        //     if (!in_array($row1['user_id'], $instructor_ids) && $row1['user_id'] != "") {
        //         array_push($instructor_ids, $row1['user_id']);
        //     }
        // }
        // if (count($instructor_ids) > 0) {
        //     $this->db->where_in('id', $instructor_ids);
        //     $query_result = $this->db->get('users');
        // } else {
        //     $query_result = $this->get_admin_details();
        // }

        // return $query_result;
    }

    public function update_instructor_paypal_settings($user_id = '')
    {
        $user_details = $this->get_all_user($user_id)->row_array();
        $payment_keys = json_decode($user_details['payment_keys'], true);
        // Update paypal keys
        $paypal['production_client_id'] = html_escape($this->input->post('paypal_client_id'));
        $paypal['production_secret_key'] = html_escape($this->input->post('paypal_secret_key'));
        $payment_keys['paypal'] = $paypal;

        //All payment keys
        $data['payment_keys'] = json_encode($payment_keys);

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }
    public function update_instructor_stripe_settings($user_id = '')
    {
        $user_details = $this->get_all_user($user_id)->row_array();
        $payment_keys = json_decode($user_details['payment_keys'], true);
        // Update stripe keys
        $stripe['public_live_key'] = html_escape($this->input->post('stripe_public_key'));
        $stripe['secret_live_key'] = html_escape($this->input->post('stripe_secret_key'));
        $payment_keys['stripe'] = $stripe;

        //All payment keys
        $data['payment_keys'] = json_encode($payment_keys);

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }

    public function update_instructor_razorpay_settings($user_id = ''){
        $user_details = $this->get_all_user($user_id)->row_array();
        $payment_keys = json_decode($user_details['payment_keys'], true);
        // Update razorpay keys
        $razorpay['key_id'] = html_escape($this->input->post('key_id'));
        $razorpay['secret_key'] = html_escape($this->input->post('secret_key'));
        $payment_keys['razorpay'] = $razorpay;

        //All payment keys
        $data['payment_keys'] = json_encode($payment_keys);

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }

    // POST INSTRUCTOR APPLICATION FORM AND INSERT INTO DATABASE IF EVERYTHING IS OKAY
    public function post_instructor_application($user_id = "")
    {
        if($user_id == ""){
            $user_id = $this->input->post('id');
        }
        $user_details = $this->get_all_user($user_id)->row_array();

        if($this->input->post('email')){
            $email = $this->input->post('email');
        }else{
            $email = $user_details['email'];
        }

        // CHECK IF THE PROVIDED ID AND EMAIL ARE COMING FROM VALID USER
        if ($user_details['email'] == $email) {

            // GET PREVIOUS DATA FROM APPLICATION TABLE
            $previous_data = $this->get_applications($user_details['id'], 'user')->num_rows();
            // CHECK IF THE USER HAS SUBMITTED FORM BEFORE
            if ($previous_data > 0) {
                $this->session->set_flashdata('error_message', get_phrase('already_submitted'));
                redirect(site_url('user/become_an_instructor'), 'refresh');
            }
            $data['user_id'] = $user_id;
            $data['address'] = $this->input->post('address');
            $data['phone'] = $this->input->post('phone');
            $data['message'] = $this->input->post('message');
            if (isset($_FILES['document']) && $_FILES['document']['name'] != "") {
                if (!file_exists('uploads/document')) {
                    mkdir('uploads/document', 0777, true);
                }
                $accepted_ext = array('doc', 'docs', 'pdf', 'txt', 'png', 'jpg', 'jpeg');
                $path = $_FILES['document']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if (in_array(strtolower($ext), $accepted_ext)) {
                    $document_custom_name = random(15) . '.' . $ext;
                    $data['document'] = $document_custom_name;
                    move_uploaded_file($_FILES['document']['tmp_name'], 'uploads/document/' . $document_custom_name);
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('invalide_file'));
                    redirect(site_url('user/become_an_instructor'), 'refresh');
                }
            }
            $this->db->insert('applications', $data);
            $this->session->set_flashdata('flash_message', site_phrase('You have successfully submitted your application.').' '.get_phrase('We will review it and notify you via email notification'));
            redirect(site_url('user/become_an_instructor'), 'refresh');
        } else {
            $this->session->set_flashdata('error_message', get_phrase('user_not_found'));
            redirect(site_url('user/become_an_instructor'), 'refresh');
        }
    }

    function instructor_application(){
        // FIRST GET THE USER DETAILS
        $user = $this->db->get_where('users', ['email' => $this->input->post('email')]);
        if($user->num_rows() > 0){
            $user_details = $user->row_array();
            $previous_data = $this->get_applications($user_details['id'], 'user')->num_rows();
            if ($previous_data == 0) {
                if (!file_exists('uploads/document')) {
                    mkdir('uploads/document', 0777, true);
                }
                $data['user_id'] = $user_details['id'];
                $data['address'] = $user_details['address'];
                $data['phone'] = $this->input->post('phone');
                $data['message'] = $this->input->post('message');

                $document_custom_name =random(15).'.'.pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
                $data['document'] = $document_custom_name;
                move_uploaded_file($_FILES['document']['tmp_name'], 'uploads/document/' . $document_custom_name);
                $this->db->insert('applications', $data);
            }
        }
    }


    // GET INSTRUCTOR APPLICATIONS
    public function get_applications($id = "", $type = "")
    {
        if ($id > 0 && !empty($type)) {
            if ($type == 'user') {
                $applications = $this->db->get_where('applications', array('user_id' => $id));
                return $applications;
            } else {
                $applications = $this->db->get_where('applications', array('id' => $id));
                return $applications;
            }
        } else {
            $this->db->order_by("id", "DESC");
            $applications = $this->db->get_where('applications');
            return $applications;
        }
    }

    // GET APPROVED APPLICATIONS
    public function get_approved_applications()
    {
        $applications = $this->db->get_where('applications', array('status' => 1));
        return $applications;
    }

    // GET PENDING APPLICATIONS
    public function get_pending_applications()
    {
        $applications = $this->db->get_where('applications', array('status' => 0));
        return $applications;
    }

    //UPDATE STATUS OF INSTRUCTOR APPLICATION
    public function update_status_of_application($status, $application_id)
    {
        $application_details = $this->get_applications($application_id, 'application');
        if ($application_details->num_rows() > 0) {
            $application_details = $application_details->row_array();
            if ($status == 'approve') {
                $application_data['status'] = 1;
                $this->db->where('id', $application_id);
                $this->db->update('applications', $application_data);

                $instructor_data['is_instructor'] = 1;
                $this->db->where('id', $application_details['user_id']);
                $this->db->update('users', $instructor_data);

                $this->session->set_flashdata('flash_message', get_phrase('application_approved_successfully'));
                redirect(site_url('admin/instructor_application'), 'refresh');
            } else {
                $this->db->where('id', $application_id);
                $this->db->delete('applications');
                $this->session->set_flashdata('flash_message', get_phrase('application_deleted_successfully'));
                redirect(site_url('admin/instructor_application'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_message', get_phrase('invalid_application'));
            redirect(site_url('admin/instructor_application'), 'refresh');
        }
    }

    // ASSIGN PERMISSION
    public function assign_permission()
    {
        $argument = html_escape($this->input->post('arg'));
        $argument = explode('-', $argument);
        $admin_id = $argument[0];
        $module = $argument[1];

        // CHECK IF IT IS A ROOT ADMIN
        if (is_root_admin($admin_id)) {
            return false;
        }

        $permission_data['admin_id'] = $admin_id;
        $previous_permissions = json_decode($this->get_admins_permission_json($permission_data['admin_id']), TRUE);

        if (in_array($module, $previous_permissions)) {
            $new_permission = array();
            foreach ($previous_permissions as $permission) {
                if ($permission != $module) {
                    array_push($new_permission, $permission);
                }
            }
        } else {
            array_push($previous_permissions, $module);
            $new_permission = $previous_permissions;
        }

        $permission_data['permissions'] = json_encode($new_permission);

        $this->db->where('admin_id', $admin_id);
        $this->db->update('permissions', $permission_data);
        return true;
    }

    // GET ADMIN'S PERMISSION JSON
    public function get_admins_permission_json($admin_id)
    {
        $admins_permissions = $this->db->get_where('permissions', ['admin_id' => $admin_id])->row_array();
        return $admins_permissions['permissions'];
    }

    // GET MULTI INSTRUCTOR DETAILS WITH COURSE ID
    public function get_multi_instructor_details_with_csv($csv)
    {
        $instructor_ids = explode(',', $csv);
        $this->db->where_in('id', $instructor_ids);
        return $this->db->get('users')->result_array();
    }

    function quiz_submission_checker($quiz_id = ""){
        $quiz_details = $this->crud_model->get_lessons('lesson', $quiz_id)->row_array();
        $total_quiz_seconds = time_to_seconds($quiz_details['duration']);

        $this->db->where('quiz_id', $quiz_id);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->order_by('quiz_result_id', 'desc')->get('quiz_results');
        if($query->num_rows() > 0){
            $row = $query->row_array();
            if(($total_quiz_seconds + $row['date_added']) < time() && $total_quiz_seconds > 0 || $row['is_submitted'] == 1){

                if($row['is_submitted'] != 1){
                    $this->db->where('quiz_id', $quiz_id);
                    $this->db->where('user_id', $this->session->userdata('user_id'));
                    $this->db->update('quiz_results', array('is_submitted' => 1));
                }

                return 'submitted';
            }else{
                return 'on_progress';
            }
        }else{
            return 'no_data';
        }
    }



/*START LOGIN LOGOUT AND DEVICE ALLOW SECTION*/
    // For device login tracker
    public function new_device_login_tracker($user_id = "", $is_verified = '')
    {
        $pre_sessions = array();
        $updated_session_arr = array();
        $current_session_id = session_id();
        $this->db->where('id', $user_id);
        $sessions = $this->db->get('users');
        $allowed_device = (int)get_settings('allowed_device_number_of_loging');

        if($sessions->row('role_id') == 1){
            $allowed_device=$allowed_device==-1?0:1;
            //if(!$allowed_device) $allowed_device++;
//magic uncomment return;            
            //return;
        }

        $pre_sessions = json_decode($sessions->row('sessions'), true);
//magic
        if($allowed_device>0){
            if(is_array($pre_sessions) && count($pre_sessions) > 0 /*|| true*/){
                if($is_verified == true && !in_array($current_session_id, $pre_sessions) /*&& false*/){
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
                    if(!in_array($current_session_id, $pre_sessions) /*|| true*/){
                        if(is_array($pre_sessions) && count($pre_sessions) >= get_settings('allowed_device_number_of_loging') /*|| true*/){
                            $this->email_model->new_device_login_alert($user_id);
                            redirect(site_url('login/new_login_confirmation'), 'refresh');
                        }else{
                            $updated_session_arr = $pre_sessions;
                            array_push($updated_session_arr, $current_session_id);
                        }
                    }
                }
            }else{
                $updated_session_arr = [$current_session_id];
            }

            if(is_array($updated_session_arr) && count($updated_session_arr) > 0){
                $data['sessions'] = json_encode($updated_session_arr);
                $this->db->where('id', $user_id);
                $this->db->update('users', $data);
            }
        }
    }

    function set_login_userdata($user_id = ""){
        // Checking login credential for admin
        $query = $this->db->get_where('users', array('id' => $user_id));

        if ($query->num_rows() > 0) {
            $row = $query->row();
            //604800s == 7 days
            $this->session->set_userdata('custom_session_limit', (time()+864000));
            $this->session->set_userdata('user_id', $row->id);
            $this->session->set_userdata('role_id', $row->role_id);
            $this->session->set_userdata('role', get_user_role('user_role', $row->id));
            $this->session->set_userdata('name', $row->first_name . ' ' . $row->last_name);
            $this->session->set_userdata('is_instructor', $row->is_instructor);
            $this->session->set_flashdata('flash_message', get_phrase('welcome') . ' ' . $row->first_name . ' ' . $row->last_name);
            if ($row->role_id == 1) {
                $this->session->set_userdata('admin_login', '1');
                redirect(site_url('admin/dashboard'), 'refresh');
            } else if ($row->role_id == 2) {
                $this->session->set_userdata('user_login', '1');
                if($this->session->userdata('url_history')){
                    redirect($this->session->userdata('url_history'), 'refresh');
                }
                redirect(site_url('home'), 'refresh');
            }
        } else {
            $this->session->set_flashdata('error_message', get_phrase('invalid_login_credentials'));
            redirect(site_url('login'), 'refresh');
        }
    }

    function check_session_data($user_type = ""){
        $this->remove_garbage_collection();

        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }

        if (!$this->session->userdata('language')) {
            $this->session->set_userdata('language', get_settings('language'));
        }

        if($user_type == 'admin'){
            if($this->session->userdata('custom_session_limit') >= time()){
                $this->session->set_userdata('custom_session_limit', (time()+864000));
            }else{
                $this->session_destroy();
                redirect(site_url('login'), 'refresh');
            }

            if ($this->session->userdata('admin_login') != true) {
                redirect(site_url('login'), 'refresh');
            }
        }elseif($user_type == 'user'){
            if($this->session->userdata('custom_session_limit') >= time()){
                $this->session->set_userdata('custom_session_limit', (time()+864000));
            }else{
                $this->session_destroy();
                redirect(site_url('login'), 'refresh');
            }

            if ($this->session->userdata('user_login') != true) {
                redirect(site_url('login'), 'refresh');
            }else{
                if($this->get_all_user($this->session->userdata('user_id'))->num_rows() == 0){
                    $this->session_destroy();
                    redirect(site_url('login'), 'refresh');
                }
            }
        }elseif($user_type == 'login'){
            if ($this->session->userdata('admin_login')) {
                redirect(site_url('admin'), 'refresh');
            } elseif ($this->session->userdata('user_login')) {
                redirect(site_url('home/my_courses'), 'refresh');
            }
        }
    }

    public function session_destroy()
    {
        $this->remove_garbage_collection();

        $logged_in_user_id = $this->session->userdata('user_id');
        if($logged_in_user_id > 0 && $this->session->userdata('user_login') == 1){
            $pre_sessions = array();
            $updated_session_arr = array();
            $current_session_id = session_id();

            $this->db->where('id', $logged_in_user_id);
            $sessions = $this->db->get('users')->row('sessions');
            $pre_sessions = json_decode($sessions, true);
            if(is_array($pre_sessions)){
                foreach($pre_sessions as $key => $pre_session){
                    if($pre_session != $current_session_id){
                        if($this->db->get_where('ci_sessions', ['id' => $pre_session])->num_rows() > 0){
                            array_push($updated_session_arr, $pre_session);                        
                        }
                    }else{
                        $this->db->where('id', $pre_session);
                        $this->db->delete('ci_sessions');
                    }
                }
                $data['sessions'] = json_encode($updated_session_arr);
                $this->db->where('id', $logged_in_user_id);
                $this->db->update('users', $data);
            }
        }

        $this->session->unset_userdata('admin_login');
        $this->session->unset_userdata('user_login');
        $this->session->unset_userdata('custom_session_limit');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('is_instructor');
        $this->session->unset_userdata('url_history');
        $this->session->unset_userdata('app_url');
        $this->session->unset_userdata('total_price_of_checking_out');
        $this->session->unset_userdata('register_email');
        $this->session->unset_userdata('applied_coupon');
        $this->session->unset_userdata('new_device_code_expiration_time');
        $this->session->unset_userdata('new_device_user_email');
        $this->session->unset_userdata('new_device_user_id');
        $this->session->unset_userdata('new_device_verification_code');

    }

    function remove_garbage_collection(){
        $this->db->where('timestamp <', time()-864000);
        $this->db->delete('ci_sessions');
    }
    /*END LOGIN LOGOUT AND DEVICE ALLOW SECTION*/


   /* function update_unique_identifier($user_id = ""){
        $data['unique_identifier'] = $user_id.strtolower(random(10));
        $this->db->where('unique_identifier', 0);
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }*/



    //course-gift-ryan

    function get_user_by_email($email = ""){
        if($email){
            $this->db->where('email', $email);
        }
        return $this->db->get('users');
    }

    //course-gift-ryan



    // Instructor Follow

    public function toggle_following($instructor_id, $user_id) {
        $this->db->where('instructor_id', $instructor_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('instructor_followings');
        if ($query->num_rows() > 0) {
            $this->db->where('instructor_id', $instructor_id);
            $this->db->where('user_id', $user_id);
            $this->db->delete('instructor_followings');
            return ['status' => 'unfollowed'];
        } else {
            $data = [
                'instructor_id' => $instructor_id,
                'user_id' => $user_id,
                'is_following' => 1
            ];
            $this->db->insert('instructor_followings', $data);
            $this->email_model->instructor_followups_reminder($instructor_id, $user_id);
            return ['status' => 'followed'];
            
            
        }
       
    }
    
    
    public function is_following($instructor_id, $user_id) {
        $this->db->where('instructor_id', $instructor_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('instructor_followings');
        
        return $query->num_rows() > 0;
    }
    
    public function get_following_instructors($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('instructor_followings');
        return $query->result();
    }
    


    //custom
    public function add_user_api($user)
    {
        $email=$user['email'];
        $first_name=$user['first_name'];
        $last_name=$user['last_name'];
        $phone=$user['phone'];
        $password=$user['password'];
        $is_instructor=$user['is_instructor'];
        $role_id=$user['role_id'];

        $validity = $this->check_duplication('on_create', $email);
        if ($validity == false) {
            $response['status'] = 0;
            $response['message'] = get_phrase('this_email_already_exits') . '. ' . get_phrase('please_use_another_email');
            return $response;
        } else {
          //  $data['unique_identifier'] = 0;
            $data['first_name'] = html_escape($first_name);
            $data['last_name'] = html_escape($last_name);
            $data['email'] = html_escape($email);
            $data['phone'] = html_escape($phone);
            $data['password'] = sha1(html_escape($password));
            $data['is_instructor'] = (int)$is_instructor;
            $social_link['facebook'] = '';
            $social_link['twitter'] = '';
            $social_link['linkedin'] = '';
            $data['social_links'] = json_encode($social_link);
            $data['role_id'] = 2;
            $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
            $data['wishlist'] = json_encode(array());
            $data['status'] = 1;
            $data['image'] = md5(rand(10000, 10000000));

            // Add paypal keys
            $payment_keys = array();

            $paypal['production_client_id']  = '';
            $paypal['production_secret_key'] = '';
            $payment_keys['paypal'] = $paypal;

            // Add Stripe keys
            $stripe['public_live_key'] = '';
            $stripe['secret_live_key'] = '';
            $payment_keys['stripe'] = $stripe;

            // Add razorpay keys
            $razorpay['key_id'] = '';
            $razorpay['secret_key'] = '';
            $payment_keys['razorpay'] = $razorpay;

            //All payment keys
            $data['payment_keys'] = json_encode(array());

            $this->db->insert('users', $data);

            $user_id = $this->db->insert_id();
            $system_name=get_settings('system_name');
            $this->email_model->add_user_cv($email,"Your $system_name account is ready","Congratulations $first_name $last_name!! <br>Your account has been created on $system_name. Here are your login credentials: <br> <div style='width:100%;display:block;'><div style='width:50%;text-align:left;display:inline-block;'>email:</div><div style='width:50%;text-align:left;display:inline-block;'> $email</div></div> <div style='width:100%;display:block;'><div style='width:50%;text-align:left;display:inline-block;'>Password:</div><div style='width:50%;text-align:left;display:inline-block;'>$password</div></div> <br> Happy learning!");
           // $this->user_model->update_unique_identifier($user_id);

            //$this->session->set_flashdata('flash_message', get_phrase('user_added_successfully'));
            $response['status'] = 1;
            return $response;
        }
    }

    function add_users_from_csv(){
        $resp=array('success'=>0,'error'=>0,'total'=>0);

        $csv_arr=$this->crud_model->fromCSV();

        foreach($csv_arr as $data) {
            // number of fields in the csv
            $col_count = count($data);
            $row = array();

            // get the values from the csv
            //$data=explode(' ',$user[0]);
            $row['email'] = trim($data[0]);
            $row['first_name'] = trim($data[1]);
            $row['last_name'] = trim($data[2]);
            $row['phone'] = trim($data[3]);
            $row['password'] = trim($data[3]);

            $response=$this->add_user_api($row);
            if($response['status']) $resp['success']++;
            else $resp['error']++;
            $resp['total']++;
        }

        return $resp;
    }

    function mail_user($user_id){
        if($user_id) {
            $mail_subject=$this->input->post('mail_subject');
            $mail_body=$this->input->post('mail_body');
            $user=$this->get_all_user($user_id)->row_array();
            if($user && $mail_subject && $mail_body){
                if($this->email_model->send_email($user['email'],$mail_subject,$mail_body)) $this->session->set_flashdata('flash_message', get_phrase('mail_was_sent'));
                else $this->session->set_flashdata('error_message', get_phrase('mail_sending_failed'));
            }
            else if(!$user) $this->session->set_flashdata('error_message', get_phrase('user_does_not_exist'));
            else if(!($mail_subject && $mail_body)) $this->session->set_flashdata('error_message', get_phrase('enter_both_subject_and_message'));
        }
        else $this->session->set_flashdata('error_message', get_phrase('invalid'));
    }

}
