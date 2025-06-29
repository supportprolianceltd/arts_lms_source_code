<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set(get_settings('timezone'));

        $this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        // THIS FUNCTION DECIDES WHTHER THE ROUTE IS REQUIRES PUBLIC INSTRUCTOR.
        //$this->get_protected_routes($this->router->method);

        // THIS MIDDLEWARE FUNCTION CHECKS WHETHER THE USER IS TRYING TO ACCESS INSTRUCTOR STUFFS.
        $this->instructor_authorization($this->router->method);

        $this->instructor_approval();

        // CHECK CUSTOM SESSION DATA
        $this->user_model->check_session_data('user');
    }

    function instructor_approval()
    {
        $user_id = $this->session->userdata('user_id');
        $query = $this->db->get_where('users', array('id' => $user_id));

        if ($query->num_rows() > 0) {
            $this->session->set_userdata('is_instructor', $query->row('is_instructor'));
        }
    }


    public function get_protected_routes($method)
    {
        // IF ANY FUNCTION DOES NOT REQUIRE PUBLIC INSTRUCTOR, PUT THE NAME HERE.
        $unprotected_routes = ['save_course_progress', 'start_quiz', 'retake_quiz', 'finish_quize_submission', 'submit_quiz_answer', 'join_bbb_meeting'];

        if (!in_array($method, $unprotected_routes)) {
            if (get_settings('allow_instructor') != 1) {
                redirect(site_url('home'), 'refresh');
            }
        }
    }

    public function instructor_authorization($method)
    {
        // IF THE USER IS NOT AN INSTRUCTOR HE/SHE CAN NEVER ACCESS THE OTHER FUNCTIONS EXCEPT FOR BELOW FUNCTIONS.
        if ($this->session->userdata('is_instructor') != 1) {
            $unprotected_routes = ['become_an_instructor', 'manage_profile', 'save_course_progress', 'start_quiz', 'retake_quiz', 'submit_quiz_answer', 'finish_quize_submission', 'join_bbb_meeting'];

            if (!in_array($method, $unprotected_routes)) {
                redirect(site_url('user/become_an_instructor'), 'refresh');
            }
        }
    }

    public function index()
    {
        if ($this->session->userdata('user_login') == true) {
            $this->dashboard();
        } else {
            redirect(site_url('login'), 'refresh');
        }
    }

    public function dashboard()
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index.php', $page_data);
    }

    public function courses()
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['selected_category_id']   = isset($_GET['category_id']) ? $_GET['category_id'] : "all";
        $page_data['selected_instructor_id'] = $this->session->userdata('user_id');
        $page_data['selected_price']         = isset($_GET['price']) ? $_GET['price'] : "all";
        $page_data['selected_status']        = isset($_GET['status']) ? $_GET['status'] : "all";
        $page_data['courses']                = $this->crud_model->filter_course_for_backend($page_data['selected_category_id'], $page_data['selected_instructor_id'], $page_data['selected_price'], $page_data['selected_status']);
        $page_data['page_name']              = 'courses-server-side';
        $page_data['categories']             = $this->crud_model->get_categories();
        $page_data['page_title']             = get_phrase('active_courses');
        $this->load->view('backend/index', $page_data);
    }

    // This function is responsible for loading the course data from server side for datatable SILENTLY
    public function get_courses()
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $courses = array();
        // Filter portion
        $filter_data['selected_category_id']   = $this->input->post('selected_category_id');
        $filter_data['selected_instructor_id'] = $this->input->post('selected_instructor_id');
        $filter_data['selected_price']         = $this->input->post('selected_price');
        $filter_data['selected_status']        = $this->input->post('selected_status');

        // Server side processing portion
        $columns = array(
            0 => '#',
            1 => 'title',
            2 => 'category',
            3 => 'lesson_and_section',
            4 => 'enrolled_student',
            5 => 'status',
            6 => 'price',
            7 => 'actions',
            8 => 'course_id'
        );

        // Coming from databale itself. Limit is the visible number of data
        $limit = html_escape($this->input->post('length'));
        $start = html_escape($this->input->post('start'));
        $order = "";
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->lazyload->count_all_courses($filter_data);
        $totalFiltered = $totalData;

        // This block of code is handling the search event of datatable
        if (empty($this->input->post('search')['value'])) {
            $courses = $this->lazyload->courses($limit, $start, $order, $dir, $filter_data);
        } else {
            $search = $this->input->post('search')['value'];
            $courses =  $this->lazyload->course_search($limit, $start, $search, $order, $dir, $filter_data);
            $totalFiltered = $this->lazyload->course_search_count((array)$search);
        }

        // Fetch the data and make it as JSON format and return it.
        $data = array();
        if (!empty($courses)) {
            foreach ($courses as $key => $row) {
                $instructor_details = $this->user_model->get_all_user($row->user_id)->row_array();
                $category_details = $this->crud_model->get_category_details_by_id($row->sub_category_id)->row_array();
                $sections = $this->crud_model->get_section('course', $row->id);
                $lessons = $this->crud_model->get_lessons('course', $row->id);
                $enroll_history = $this->crud_model->enrol_history($row->id);

                $status_badge = "badge-success-lighten";
                if ($row->status == 'pending') {
                    $status_badge = "badge-danger-lighten";
                } elseif ($row->status == 'draft') {
                    $status_badge = "badge-dark-lighten";
                } elseif ($row->status == 'private') {
                    $status_badge = "badge-dark";
                }

                $price_badge = "badge-dark-lighten";
                $price = 0;
                if ($row->is_free_course == null) {
                    if ($row->discount_flag == 1) {
                        $price = currency($row->discounted_price);
                    } else {
                        $price = currency($row->price);
                    }
                } elseif ($row->is_free_course == 1) {
                    $price_badge = "badge-success-lighten";
                    $price = get_phrase('free');
                }

                $price_field = '<span class="badge ' . $price_badge . '">' . $price . '</span>';
                if ($row->expiry_period > 0) {
                    $price_field .= '<p class="text-12">' . $row->expiry_period . ' ' . get_phrase('Months') . '</p>';
                } else {
                    $price_field .= '<p class="text-12">' . get_phrase('Lifetime') . '</p>';
                }

                $view_course_on_frontend_url = site_url('home/course/' . rawurlencode(slugify($row->title)) . '/' . $row->id);
                $go_to_course_playing_page = site_url('home/lesson/' . rawurlencode(slugify($row->title)) . '/' . $row->id);
                $edit_this_course_url = site_url('user/course_form/course_edit/' . $row->id);
                $section_and_lesson_url = site_url('user/course_form/course_edit/' . $row->id);
                $academic_progress_url = site_url('user/course_form/course_edit/' . $row->id . '?tab=academic_progress');

                if ($row->status == 'active' || $row->status == 'pending') {
                    $course_status_changing_action = "confirm_modal('" . site_url('user/course_actions/draft/' . $row->id) . "')";
                    $course_status_changing_message = get_phrase('mark_as_drafted');
                } else {
                    $course_status_changing_action = "confirm_modal('" . site_url('user/course_actions/publish/' . $row->id) . "')";
                    $course_status_changing_message = get_phrase('publish_this_course');
                }

                $delete_course_url = "confirm_modal('" . site_url('user/course_actions/delete/' . $row->id) . "')";

                if ($row->course_type == 'general') {
                    $section_and_lesson_menu = '<li><a class="dropdown-item" href="' . $section_and_lesson_url . '">' . get_phrase("section_and_lesson") . '</a></li>';
                } else {
                    $section_and_lesson_menu = "";
                }

                $action = '
                <div class="dropright dropright">
                <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="' . $view_course_on_frontend_url . '" target="_blank">' . get_phrase("view_course_on_frontend") . '</a></li>
                <li><a class="dropdown-item" href="' . $go_to_course_playing_page . '" target="_blank">' . get_phrase("go_to_course_playing_page") . '</a></li>
                <li><a class="dropdown-item" href="' . $academic_progress_url . '">' . get_phrase("Academic progress") . '</a></li>
                <li><a class="dropdown-item" href="' . $edit_this_course_url . '">' . get_phrase("edit_this_course") . '</a></li>
                ' . $section_and_lesson_menu . '
                <li><a class="dropdown-item" href="javascript:;" onclick="' . $course_status_changing_action . '">' . $course_status_changing_message . '</a></li>
                <li><a class="dropdown-item" href="javascript:;" onclick="' . $delete_course_url . '">' . get_phrase("delete") . '</a></li>
                </ul>
                </div>
                ';

                $nestedData['#'] = $key + 1;

                $instructor_names = "";
                if ($row->multi_instructor) {
                    $instructors = $this->user_model->get_multi_instructor_details_with_csv($row->user_id);
                    foreach ($instructors as $counterForThis => $instructor) {
                        $instructor_names .= $instructor['first_name'] . ' ' . $instructor['last_name'];
                        $instructor_names .= $counterForThis + 1 == count((array)$instructors) ? '' : ', ';
                    }
                } else {
                    $instructor_names = $instructor_details['first_name'] . ' ' . $instructor_details['last_name'];
                }

                $nestedData['title'] = '<strong><a href="' . site_url('user/course_form/course_edit/' . $row->id) . '">' . $row->title . '</a></strong><br>
                <small class="text-muted">' . get_phrase('instructor') . ': <b>' . $instructor_names . '</b></small>';


                $nestedData['category'] = '<span class="badge badge-dark-lighten">' . $category_details['name'] . '</span>';

                if ($row->course_type == 'scorm') {
                    $nestedData['lesson_and_section'] = '<span class="badge badge-info-lighten">' . get_phrase('scorm_course') . '</span>';
                } elseif ($row->course_type == 'h5p') {
                    $nestedData['lesson_and_section'] = '<span class="badge badge-info-lighten">' . get_phrase('h5p_course') . '</span>';
                } elseif ($row->course_type == 'general') {
                    $nestedData['lesson_and_section'] = '
                    <small class="text-muted"><b>' . get_phrase('total_section') . '</b>: ' . $sections->num_rows() . '</small><br>
                    <small class="text-muted"><b>' . get_phrase('total_lesson') . '</b>: ' . $lessons->num_rows() . '</small>';
                }

                $nestedData['enrolled_student'] = '<small class="text-muted"><b>' . get_phrase('total_enrolment') . '</b>: ' . $enroll_history->num_rows() . '</small>';


                $nestedData['status'] = '<span class="badge ' . $status_badge . '">' . get_phrase($row->status) . '</span>';

                $nestedData['price'] = $price_field;

                $nestedData['actions'] = $action;

                $nestedData['course_id'] = $row->id;

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function course_actions($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        if ($param1 == "add") {
            $course_id = $this->crud_model->add_course();
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','course_actions','add','add_course',null,'crud_model',null,'add course','successful',['text'=>'attempts to add course via course actions']);
            redirect(site_url('user/course_form/course_edit/' . $course_id), 'refresh');
        } elseif ($param1 == "edit") {
            $this->is_the_course_belongs_to_current_instructor($param2);
            $this->crud_model->update_course($param2);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','course_actions','edit','update_course',"$param2",'crud_model',null,'edit course','successful',['text'=>'attempts to edit course via course actions']);
            // CHECK IF LIVE CLASS ADDON EXISTS, ADD OR UPDATE IT TO ADDON MODEL
            if (addon_status('live-class')) {
                $this->load->model('addons/Liveclass_model', 'liveclass_model');
                $this->liveclass_model->update_live_class($param2);
            }

            // CHECK IF JITSI LIVE CLASS ADDON EXISTS, ADD OR UPDATE IT TO ADDON MODEL
            if (addon_status('jitsi-live-class')) {
                $this->load->model('addons/jitsi_liveclass_model', 'jitsi_liveclass_model');
                $this->jitsi_liveclass_model->update_live_class($param2);
            }

            redirect(site_url('user/course_form/course_edit/' . $param2));
        } elseif ($param1 == 'add_shortcut') {
            echo $this->crud_model->add_shortcut_course();
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','course_actions','add_shortcut','add_shortcut_course',null,'crud_model',null,'add shortcut course','successful',['text'=>'attempts to add shortcut course via course actions']);
        } elseif ($param1 == 'delete') {
            $this->is_the_course_belongs_to_current_instructor($param2);
            $this->crud_model->delete_course($param2);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','course_actions','delete','delete_course',"$param2",'crud_model',null,'delete course','successful',['text'=>'attempts to delete course via course actions']);
            redirect(site_url('user/courses'), 'refresh');
        } elseif ($param1 == 'draft') {
            $this->is_the_course_belongs_to_current_instructor($param2);
            $this->crud_model->change_course_status('draft', $param2);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','course_actions','draft','change_course_status',"'draft', $param2",'crud_model',null,'change course status to draft','successful',['text'=>'attempts to set course status to draft']);
            redirect(site_url('user/courses'), 'refresh');
        } elseif ($param1 == 'publish') {
            $this->is_the_course_belongs_to_current_instructor($param2);
            $this->crud_model->change_course_status('pending', $param2);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','course_actions','publish','change_course_status',"'pending', $param2",'crud_model',null,'change course status from pending to publlished','successful',['text'=>'attempts to set course status from pending to published']);
            redirect(site_url('user/courses'), 'refresh');
        }
    }

    public function course_form($param1 = "", $param2 = "")
    {

        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        if ($param1 == 'add_course') {
            $page_data['languages'] = $this->crud_model->get_all_languages();
            $page_data['categories'] = $this->crud_model->get_categories();
            $page_data['page_name'] = 'course_add';
            $page_data['page_title'] = get_phrase('add_course');
            $this->load->view('backend/index', $page_data);
        } elseif ($param1 == 'add_course_shortcut') {
            $page_data['languages'] = $this->crud_model->get_all_languages();
            $page_data['categories'] = $this->crud_model->get_categories();
            $this->load->view('backend/user/course_add_shortcut', $page_data);
        } elseif ($param1 == 'course_edit') {
            $this->is_the_course_belongs_to_current_instructor($param2);
            $page_data['page_name'] = 'course_edit';
            $page_data['course_id'] =  $param2;
            $page_data['page_title'] = get_phrase('edit_course');
            $page_data['languages'] = $this->crud_model->get_all_languages();
            $page_data['categories'] = $this->crud_model->get_categories();
            $this->load->view('backend/index', $page_data);
        }
    }

    public function payout_settings($param1 = "")
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        if (isset($_POST['gateways'])) {
            $data['payment_keys'] = json_encode($_POST['gateways']);
            $data['last_modified'] = time();
            $this->db->where('id', $this->session->userdata('user_id'));
            $this->db->update('users', $data);
            $this->session->set_flashdata('flash_message', get_phrase('payment_settings_has_been_updated'));
            redirect(site_url('user/payout_settings'), 'refresh');
        }

        $page_data['page_name'] = 'payment_settings';
        $page_data['page_title'] = get_phrase('payout_settings');
        $this->load->view('backend/index', $page_data);
    }

    public function sales_report($param1 = "")
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        if ($param1 != "") {
            $date_range                   = $this->input->get('date_range');
            $date_range                   = explode(" - ", $date_range);
            $page_data['timestamp_start'] = strtotime($date_range[0] . ' 00:00:00');
            $page_data['timestamp_end']   = strtotime($date_range[1] . ' 23:59:59');
        } else {
            $page_data['timestamp_start'] = strtotime(date("m/01/Y 00:00:00"));
            $page_data['timestamp_end']   = strtotime(date("m/t/Y 23:59:59"));
        }

        $page_data['payment_history'] = $this->crud_model->get_instructor_revenue($this->session->userdata('user_id'), $page_data['timestamp_start'], $page_data['timestamp_end']);
        $page_data['page_name'] = 'sales_report';
        $page_data['page_title'] = get_phrase('sales_report');
        $this->load->view('backend/index', $page_data);
    }

    public function preview($course_id = '')
    {
        if ($this->session->userdata('user_login') != 1)
            redirect(site_url('login'), 'refresh');

        $this->is_the_course_belongs_to_current_instructor($course_id);
        if ($course_id > 0) {
            $courses = $this->crud_model->get_course_by_id($course_id);
            if ($courses->num_rows() > 0) {
                $course_details = $courses->row_array();
                redirect(site_url('home/lesson/' . rawurlencode(slugify($course_details['title'])) . '/' . $course_details['id']), 'refresh');
            }
        }
        redirect(site_url('user/courses'), 'refresh');
    }

    public function sections($param1 = "", $param2 = "", $param3 = "")
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        if ($param2 == 'add') {
            $this->is_the_course_belongs_to_current_instructor($param1);
            $this->crud_model->add_section($param1);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','sections','add','add_section',"$param1",'crud_model',"section_has_been_added_successfully",'add section','successful',['text'=>'attempts to add section']);
            $this->session->set_flashdata('flash_message', get_phrase('section_has_been_added_successfully'));
        } elseif ($param2 == 'edit') {
            $this->is_the_course_belongs_to_current_instructor($param1, $param3, 'section');
            $this->crud_model->edit_section($param3);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','sections','edit','edit_section',"$param3",'crud_model',"section_has_been_updated_successfully",'edit section','successful',['text'=>'attempts to edit section']);
            $this->session->set_flashdata('flash_message', get_phrase('section_has_been_updated_successfully'));
        } elseif ($param2 == 'delete') {
            $this->is_the_course_belongs_to_current_instructor($param1, $param3, 'section');
            $this->crud_model->delete_section($param1, $param3);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','sections','delete','delete_section',"$param1,$param3",'crud_model',"section_has_been_deleted_successfully",'delete section','successful',['text'=>'attempts to delete section']);
            $this->session->set_flashdata('flash_message', get_phrase('section_has_been_deleted_successfully'));
        }
        redirect(site_url('user/course_form/course_edit/' . $param1));
    }

    public function lessons($course_id = "", $param1 = "", $param2 = "")
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        if ($param1 == 'add') {
            $valid_user = $this->is_the_course_belongs_to_current_instructor($course_id, null, null, true);
            if ($valid_user > 0) {
                $response = $this->crud_model->add_lesson();
                $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','lessons','add','add_lesson',null,'crud_model',null,'add lesson','successful',['text'=>'attempts to add lesson']);
            } else {
                $response = json_encode(['error' => get_phrase('you_do_not_have_right_to_access_this_course')]);
                $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','lessons','add','add_lesson',null,'crud_model',"you_do_not_have_right_to_access_this_course",'add lesson','failed',['text'=>'attempts to add lesson']);
            }
            echo $response;
            return;
        } elseif ($param1 == 'edit') {
            $valid_user = +$this->is_the_course_belongs_to_current_instructor($course_id, $param2, 'lesson', true);

            if ($valid_user > 0) {
                $response = $this->crud_model->edit_lesson($param2);
                $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','lessons','edit','edit_lesson',"$param2",'crud_model',null,'edit lesson','successful',['text'=>'attempts to edit lesson']);
            } else {
                $response = json_encode(['error' => get_phrase('you_do_not_have_right_to_access_this_course')]);
                $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','lessons','edit','edit_lesson',"$param2",'crud_model',"you_do_not_have_right_to_access_this_course",'edit lesson','failed',['text'=>'attempts to edit lesson']);
            }
            echo $response;
            return;
        } elseif ($param1 == 'delete') {
            $this->is_the_course_belongs_to_current_instructor($course_id, $param2, 'lesson');
            $this->crud_model->delete_lesson($param2);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','lessons','delete','delete_lesson',"$param2",'crud_model',null,'delete lesson','successful',['text'=>'attempts to delete lesson']);
            $this->session->set_flashdata('flash_message', get_phrase('lesson_has_been_deleted_successfully'));
            redirect('user/course_form/course_edit/' . $course_id);
        } elseif ($param1 == 'filter') {
            redirect('user/lessons/' . $this->input->post('course_id'));
        }
        $page_data['page_name'] = 'lessons';
        $page_data['lessons'] = $this->crud_model->get_lessons('course', $course_id);
        $page_data['course_id'] = $course_id;
        $page_data['page_title'] = get_phrase('lessons');
        $this->load->view('backend/index', $page_data);
    }

    // Manage Quizes
    public function quizes($course_id = "", $action = "", $quiz_id = "")
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        if ($action == 'add') {
            $this->is_the_course_belongs_to_current_instructor($course_id);
            $this->crud_model->add_quiz($course_id);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','quizes','add','add_quiz',"$course_id",'crud_model',"quiz_has_been_added_successfully",'add quiz','successful',['text'=>'attempts to add quiz']);
            $this->session->set_flashdata('flash_message', get_phrase('quiz_has_been_added_successfully'));
        } elseif ($action == 'edit') {
            $this->is_the_course_belongs_to_current_instructor($course_id, $quiz_id, 'quize');
            $this->crud_model->edit_quiz($quiz_id);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','quizes','edit','edit_quiz',"$quiz_id",'crud_model',"quiz_has_been_updated_successfully",'edit quiz','successful',['text'=>'attempts to edit quiz']);
            $this->session->set_flashdata('flash_message', get_phrase('quiz_has_been_updated_successfully'));
        } elseif ($action == 'delete') {
            $this->is_the_course_belongs_to_current_instructor($course_id, $quiz_id, 'quize');
            $this->crud_model->delete_lesson($quiz_id);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','quizes','delete','delete_lesson',"$quiz_id",'crud_model',"quiz_has_been_deleted_successfully",'delete quiz','successful',['text'=>'attempts to delete quiz']);
            $this->session->set_flashdata('flash_message', get_phrase('quiz_has_been_deleted_successfully'));
        }
        redirect(site_url('user/course_form/course_edit/' . $course_id));
    }

    // Manage Quize Questions
    public function quiz_questions($quiz_id = "", $action = "", $question_id = "")
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $quiz_details = $this->crud_model->get_lessons('lesson', $quiz_id)->row_array();

        if ($action == 'add' || $action == 'edit') {
            echo $this->crud_model->manage_quiz_questions($quiz_id, $question_id, $action);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','quiz_questions','add_edit','manage_quiz_question',"$quiz_id, $question_id, $action",'crud_model',null,'add or edit quiz question','successful',['text'=>'attempts to add or edit quiz question']);
        } elseif ($action == 'delete') {
            if ($this->db->get_where('question', array('id' => $question_id, 'quiz_id' => $quiz_id))->num_rows() <= 0) {
                $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','quiz_questions','delete','delete_quiz_question',"$question_id",'crud_model',"you_do_not_have_right_to_access_this_quiz_question",'delete quiz question','failed',['text'=>'attempts to delete quiz question']);
                $this->session->set_flashdata('error_message', get_phrase('you_do_not_have_right_to_access_this_quiz_question'));
                redirect(site_url('user/courses'), 'refresh');
            }

            $response = $this->crud_model->delete_quiz_question($question_id);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','quiz_questions','delete','delete_quiz_question',"$question_id",'crud_model',"question_has_been_deleted",'delete quiz question','successful',['text'=>'attempts to delete quiz question']);
            $this->session->set_flashdata('flash_message', get_phrase('question_has_been_deleted'));
            redirect(site_url('user/course_form/course_edit/' . $quiz_details['course_id']), 'refresh');
        }
    }

    function manage_profile()
    {
        redirect(site_url('home/profile/user_profile'), 'refresh');
    }

    function invoice($payment_id = "")
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name'] = 'invoice';
        $page_data['payment_details'] = $this->crud_model->get_payment_details_by_id($payment_id);
        $page_data['page_title'] = get_phrase('invoice');
        $this->load->view('backend/index', $page_data);
    }


    function become_an_instructor()
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        $applications = $this->user_model->get_applications($this->session->userdata('user_id'), 'user');
        if ($applications->num_rows() == 0) :
            redirect('home/become_an_instructor', 'refresh');
        endif;

        // CHEKING IF A FORM HAS BEEN SUBMITTED FOR REGISTERING AN INSTRUCTOR
        if (isset($_POST) && !empty($_POST)) {
            $this->user_model->post_instructor_application();
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','become_an_instructor',null,'post_instructor_application',null,'user_model',null,'post instructor application','successful',['text'=>'attempts to post instructor application']);
        }

        // CHECK USER AVAILABILITY
        $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'));
        if ($user_details->num_rows() > 0) {
            $page_data['user_details'] = $user_details->row_array();
        } else {
            $this->session->set_flashdata('error_message', get_phrase('user_not_found'));
            redirect('home/login', 'refresh');
            //$this->load->view('backend/index', $page_data);
        }
        $page_data['page_name'] = 'become_an_instructor';
        $page_data['page_title'] = get_phrase('become_an_instructor');
        $this->load->view('backend/index', $page_data);
    }


    // PAYOUT REPORT
    public function payout_report()
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        $page_data['page_name'] = 'payout_report';
        $page_data['page_title'] = get_phrase('payout_report');

        $page_data['payouts'] = $this->crud_model->get_payouts($this->session->userdata('user_id'), 'user');
        $page_data['total_pending_amount'] = $this->crud_model->get_total_pending_amount($this->session->userdata('user_id'));
        $page_data['total_payout_amount'] = $this->crud_model->get_total_payout_amount($this->session->userdata('user_id'));
        $page_data['requested_withdrawal_amount'] = $this->crud_model->get_requested_withdrawal_amount($this->session->userdata('user_id'));

        if (addon_status('ebook')) {
            $this->db->select_sum('instructor_revenue');
            $this->db->where('ebook.user_id', $this->session->userdata('user_id'));
            $this->db->where('ebook_payment.instructor_payment_status', 0);
            $this->db->from('ebook_payment');
            $this->db->join('ebook', 'ebook_payment.ebook_id = ebook.ebook_id');
            $ebook_total_pending_amount = $this->db->get()->row('instructor_revenue');

            $page_data['total_pending_amount'] = $page_data['total_pending_amount'] + $ebook_total_pending_amount;
        }

        if (addon_status('tutor_booking')) {
            $this->db->select_sum('instructor_revenue');
            $this->db->where('tutor_id', $this->session->userdata('user_id'));
            $this->db->from('tutor_payment');
            $tutor_total_pending_amount = $this->db->get()->row('instructor_revenue');

            $page_data['total_pending_amount'] = $page_data['total_pending_amount'] + $tutor_total_pending_amount;
        }

        $this->load->view('backend/index', $page_data);
    }

    // HANDLED WITHDRAWAL REQUESTS
    public function withdrawal($action = "")
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        if ($action == 'request') {
            $this->crud_model->add_withdrawal_request();
        }

        if ($action == 'delete') {
            $this->crud_model->delete_withdrawal_request();
        }

        redirect(site_url('user/payout_report'), 'refresh');
    }
    // Ajax Portion
    public function ajax_get_video_details()
    {
        $video_details = $this->video_model->getVideoDetails($_POST['video_url']);
        if (is_array($video_details)) {
            echo $video_details['duration'];
        }
    }

    // AJAX PORTION
    // this function is responsible for managing multiple choice question
    function quiz_fields_type_wize()
    {
        $page_data['question_type'] = $this->input->post('question_type');
        $this->load->view('backend/user/quiz_fields_type_wize', $page_data);
    }

    // This function checks if this course belongs to current logged in instructor
    function is_the_course_belongs_to_current_instructor($course_id, $id = null, $type = null, $is_ajax_call = null)
    {
        $is_valid = 1;
        $course_details = $this->crud_model->get_course_by_id($course_id);

        if ($course_details->num_rows() > 0) {
            $course_details = $course_details->row_array();
            if ($course_details['multi_instructor']) {
                $instructor_ids = explode(',', $course_details['user_id']);
                if (!in_array($this->session->userdata('user_id'), $instructor_ids)) {
                    $this->session->set_flashdata('error_message', get_phrase('you_do_not_have_right_to_access_this_course'));
                    $is_valid = 0;

                    if ($is_ajax_call == null) {
                        redirect(site_url('user/courses'), 'refresh');
                    }
                }
            } else {
                if ($course_details['user_id'] != $this->session->userdata('user_id')) {
                    $this->session->set_flashdata('error_message', get_phrase('you_do_not_have_right_to_access_this_course'));
                    $is_valid = 0;
                    if ($is_ajax_call == null) {
                        redirect(site_url('user/courses'), 'refresh');
                    }
                }
            }
        } else {
            $this->session->set_flashdata('error_message', get_phrase('course_not_found'));
            $is_valid = 0;
            if ($is_ajax_call == null) {
                redirect(site_url('user/courses'), 'refresh');
            }
        }


        if ($type == 'section' && $this->db->get_where('section', array('id' => $id, 'course_id' => $course_id))->num_rows() <= 0) {
            $this->session->set_flashdata('error_message', get_phrase('you_do_not_have_right_to_access_this_section'));
            $is_valid = 0;
            if ($is_ajax_call == null) {
                redirect(site_url('user/courses'), 'refresh');
            }
        }
        if ($type == 'lesson' && $this->db->get_where('lesson', array('id' => $id, 'course_id' => $course_id))->num_rows() <= 0) {
            $this->session->set_flashdata('error_message', get_phrase('you_do_not_have_right_to_access_this_lesson'));
            $is_valid = 0;
            if ($is_ajax_call == null) {
                redirect(site_url('user/courses'), 'refresh');
            }
        }
        if ($type == 'quize' && $this->db->get_where('lesson', array('id' => $id, 'course_id' => $course_id))->num_rows() <= 0) {
            $this->session->set_flashdata('error_message', get_phrase('you_do_not_have_right_to_access_this_quize'));
            $is_valid = 0;
            if ($is_ajax_call == null) {
                redirect(site_url('user/courses'), 'refresh');
            }
        }

        return $is_valid;
    }

    public function ajax_sort_section()
    {
        $section_json = $this->input->post('itemJSON');
        $this->crud_model->sort_section($section_json);
        $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','ajax_sort_section','ajax_sort_section','sort_section',"$section_json",'crud_model',null,'ajax sort section','successful',['text'=>'attempts to ajax sort section']);
    }
    public function ajax_sort_lesson()
    {
        $lesson_json = $this->input->post('itemJSON');
        $this->crud_model->sort_lesson($lesson_json);
        $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','ajax_sort_lesson','ajax_sort_lesson','sort_lesson',"$lesson_json",'crud_model',null,'ajax sort lesson','successful',['text'=>'attempts to ajax sort lesson']);
    }
    public function ajax_sort_question()
    {
        $question_json = $this->input->post('itemJSON');
        $this->crud_model->sort_question($question_json);
        $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','ajax_sort_question','ajax_sort_question','sort_question',"$question_json",'crud_model',null,'ajax sort question','successful',['text'=>'attempts to ajax sort question']);
    }



    // REMOVING INSTRUCTOR FROM COURSE
    public function remove_an_instructor($course_id, $instructor_id)
    {
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();

        if ($course_details['creator'] == $instructor_id) {
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','remove_an_instructor',null,'update',"course,id,$course_id",'crud_model','course_creator_can_be_removed','remove an instructor from course','failed',['text'=>'attempts to remove an instructor from course']);
            $this->session->set_flashdata('error_message', get_phrase('course_creator_can_be_removed'));
            redirect('admin/course_form/course_edit/' . $course_id);
        }

        if ($course_details['multi_instructor']) {
            $instructor_ids = explode(',', $course_details['user_id']);

            if (in_array($instructor_id, $instructor_ids) && in_array($this->session->userdata('user_id'), $instructor_ids)) {
                if (count((array)$instructor_ids) > 1) {
                    if (($key = array_search($instructor_id, $instructor_ids)) !== false) {
                        unset($instructor_ids[$key]);

                        $data['user_id'] = implode(",", $instructor_ids);
                        $this->db->where('id', $course_id);
                        $this->db->update('course', $data);
                        $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','remove_an_instructor',null,'update',"course,id,$course_id",'crud_model','instructor_has_been_removed','remove an instructor from course','successful',['text'=>'attempts to remove an instructor from course']);
                        $this->session->set_flashdata('flash_message', get_phrase('instructor_has_been_removed'));
                        if ($this->session->userdata('user_id') == $instructor_id) {
                            redirect('user/courses/');
                        } else {
                            redirect('user/course_form/course_edit/' . $course_id);
                        }
                    }
                } else {
                    $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','remove_an_instructor',null,'update',"course,id,$course_id",'crud_model','a_course_should_have_at_least_one_instructor','remove an instructor from course','failed',['text'=>'attempts to remove an instructor from course']);
                    $this->session->set_flashdata('error_message', get_phrase('a_course_should_have_at_least_one_instructor'));
                    redirect('user/course_form/course_edit/' . $course_id);
                }
            } else {
                $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','remove_an_instructor',null,'update',"course,id,$course_id",'crud_model','invalid_instructor_id','remove an instructor from course','failed',['text'=>'attempts to remove an instructor from course']);
                $this->session->set_flashdata('error_message', get_phrase('invalid_instructor_id'));
                redirect('user/course_form/course_edit/' . $course_id);
            }
        } else {
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','remove_an_instructor',null,'update',"course,id,$course_id",'crud_model','a_course_should_have_at_least_one_instructor','remove an instructor from course','failed',['text'=>'attempts to remove an instructor from course']);
            $this->session->set_flashdata('error_message', get_phrase('a_course_should_have_at_least_one_instructor'));
            redirect('user/course_form/course_edit/' . $course_id);
        }
    }


    //Blog start
    function add_blog()
    {
        $page_data['page_title'] = get_phrase('add_blog');
        $page_data['page_name'] = 'blog_add';
        $this->load->view('backend/index', $page_data);
    }

    function edit_blog($blog_id = "")
    {
        $page_data['blog'] = $this->crud_model->get_blogs($blog_id)->row_array();
        $page_data['page_title'] = get_phrase('edit_blog');
        $page_data['page_name'] = 'blog_edit';
        $this->load->view('backend/index', $page_data);
    }

    function blog($param1 = "", $param2 = "")
    {
        if (!get_frontend_settings('instructors_blog_permission')) {
            $this->session->set_flashdata('error_message', get_phrase('access_to_the_blog_section_denied'));
            redirect(site_url('user/dashboard'), 'refresh');
        }


        if ($param1 == 'add') {
            $this->crud_model->add_blog();
            $this->session->set_flashdata('flash_message', get_phrase('blog_added_successfully'));
            redirect(site_url('user/pending_blog'), 'refresh');
        } elseif ($param1 == 'update') {
            if ($this->check_validity($param2)) {
                $this->crud_model->update_blog($param2);
            }
            $this->session->set_flashdata('flash_message', get_phrase('blog_updated_successfully'));
            redirect(site_url('user/blog'), 'refresh');
        } elseif ($param1 == 'status') {
            if ($this->check_validity($param2)) {
                $this->crud_model->update_blog_status($param2);
            }
            $this->session->set_flashdata('flash_message', get_phrase('blog_status_has_been_updated'));
            redirect(site_url('user/blog'), 'refresh');
        } elseif ($param1 == 'delete') {
            if ($this->check_validity($param2)) {
                $this->crud_model->blog_delete($param2);
            }
            $this->session->set_flashdata('flash_message', get_phrase('blog_deleted_successfully'));
            redirect(site_url('user/blog'), 'refresh');
        }
        $page_data['blogs'] = $this->crud_model->get_blogs_by_user_id($this->session->userdata('user_id'));
        $page_data['page_title'] = get_phrase('blog');
        $page_data['page_name'] = 'blog';
        $this->load->view('backend/index', $page_data);
    }

    function pending_blog($param1 = "", $param2 = "")
    {
        if ($param1 == 'delete') {
            if ($this->check_validity($param2)) {
                $this->crud_model->blog_delete($param2);
            }
            $this->session->set_flashdata('flash_message', get_phrase('blog_deleted_successfully'));
            redirect(site_url('user/pending_blog'), 'refresh');
        }
        $page_data['pending_blogs'] = $this->crud_model->get_instructors_pending_blog($this->session->userdata('user_id'));
        $page_data['page_title'] = get_phrase('pending_blog');
        $page_data['page_name'] = 'pending_blog';
        $this->load->view('backend/index', $page_data);
    }

    function check_validity($blog_id = "")
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('blog_id', $blog_id);
        $query = $this->db->get('blogs');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //End Blog


    function start_quiz($quiz_id = "", $retake = "")
    {
        $quiz_details = $this->crud_model->get_lessons('lesson', $quiz_id)->row_array();

        $data['quiz_id'] = $quiz_details['id'];
        $data['user_id'] = $this->session->userdata('user_id');
        $data['user_answers'] = json_encode(array());
        $data['correct_answers'] = json_encode(array());
        $data['date_added'] = time();
        $data['date_updated'] = time();
        $data['is_submitted'] = 0;
        $data['total_obtained_marks'] = 0;

        $row = $this->db->get_where('quiz_results', array('user_id' => $data['user_id'], 'quiz_id' => $quiz_id));
        $total_attemped = $this->db->where('quiz_id', $quiz_id)->where('user_id', $data['user_id'])->get('quiz_results')->num_rows();
        if ($quiz_details['quiz_attempt'] == 0 && $row->num_rows() <= 0 || $quiz_details['quiz_attempt'] > ($total_attemped - 1)) :

            if ($this->db->get_where('quiz_results', array('user_id' => $data['user_id'], 'is_submitted' => 0, 'quiz_id' => $quiz_id))->num_rows() == 0) :
                $this->db->insert('quiz_results', $data);
            endif;
        endif;

        if ($retake != "") {
            $course_title = $this->crud_model->get_course_by_id($quiz_details['course_id'])->row('title');
            redirect(site_url('home/lesson/' . slugify($course_title) . '/' . $quiz_details['course_id'] . '/' . $quiz_details['id']), 'refresh');
        }

        $page_data['quiz_questions'] = $this->db->get_where('question', array('quiz_id' => $quiz_id));
        $page_data['quiz_id'] = $quiz_id;
        $this->load->view('lessons/quiz_answer_sheet', $page_data);
    }

    function submit_quiz_answer($quiz_id = "", $question_id = "", $question_type = "")
    {

        //Quize details
        $user_id = $this->session->userdata('user_id');
        $quiz_details = $this->crud_model->get_lessons('lesson', $quiz_id)->row_array();
        $total_seconds = time_to_seconds($quiz_details['duration']);
        $total_marks = json_decode($quiz_details['attachment'], true)['total_marks'];

        //Question details
        $question_details = $this->db->get_where('question', array('id' => $question_id))->row_array();


        $results = $this->db->order_by('quiz_result_id', 'desc')->get_where('quiz_results', array('quiz_id' => $quiz_id, 'user_id' => $user_id));

        if ($results->num_rows() > 0 && ($total_seconds + $results->row('date_added')) > time() || $total_seconds == 0) {
            $result = $results->row_array();
            $correct_answer_question_ids = json_decode($result['correct_answers'], true);

            $answers = $this->input->post('answer');

            $user_answers = json_decode($result['user_answers'], true);
            $user_answers[$question_id] = $answers;

            if ($question_type == 'multiple_choice') {
                $is_correct_answer = 1;
                $currect_answers = json_decode($question_details['correct_answers'], true);
                foreach ($answers as $answer) {
                    if (!in_array($answer, $currect_answers)) {
                        $is_correct_answer = 0;
                    }
                }
                if (!is_array($answers) || count($answers) <= 0 || count((array)$currect_answers) != count((array)$answers)) {
                    $is_correct_answer = 0;
                }
            } elseif ($question_type == 'single_choice') {
                $is_correct_answer = 0;
                $currect_answers = json_decode($question_details['correct_answers'], true);
                if (in_array($answers[0], $currect_answers)) {
                    $is_correct_answer = 1;
                }
            } elseif ($question_type == 'fill_in_the_blank') {
                $is_correct_answer = 1;
                $currect_answers = json_decode(strtolower($question_details['correct_answers']), true);
                foreach ($answers as $key => $answer) {
                    $answer = strtolower($answer);
                    if ($answer != $currect_answers[$key]) {
                        $is_correct_answer = 0;
                    }
                }
                if (!is_array($answers) || count($answers) <= 0 || count((array)$currect_answers) != count($answers)) {
                    $is_correct_answer = 0;
                }
            }

            if ($is_correct_answer == 1) {
                if (!in_array($question_id, $correct_answer_question_ids)) {
                    array_push($correct_answer_question_ids, $question_id);
                }
            } else {
                $updated_correct_answer_question_ids = array();
                foreach ($correct_answer_question_ids as $correct_answer_question_id) {
                    if ($correct_answer_question_id != $question_id) {
                        array_push($updated_correct_answer_question_ids, $correct_answer_question_id);
                    }
                }
                $correct_answer_question_ids = $updated_correct_answer_question_ids;
            }

            $total_questions = $this->db->get_where('question', array('quiz_id' => $quiz_id))->num_rows();
            $data['total_obtained_marks'] = round(($total_marks / $total_questions) * count((array)$correct_answer_question_ids), 1);

            $data['user_answers'] = json_encode($user_answers);
            $data['correct_answers'] = json_encode($correct_answer_question_ids);
            $data['date_updated'] = time();
            $this->db->where('user_id', $user_id);
            $this->db->where('quiz_id', $quiz_id);
            $this->db->where('is_submitted', 0);
            $this->db->update('quiz_results', $data);
        } else {
            $this->finish_quize_submission($quiz_id);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','submit_quiz_answer',null,'finish_quize_submission',"$quiz_id",null,"time_over",'finish quize submission','successful',['text'=>'attempts to finish quize submission']);
            $response['status'] = 'time_over';
            $response['message'] = site_phrase('time_over');
            echo json_encode($response);
        }
    }

    function finish_quize_submission($quiz_id = "")
    {
        $user_id = $this->session->userdata('user_id');
        $data['is_submitted'] = 1;
        $this->db->where('user_id', $user_id);
        $this->db->where('is_submitted', 0);
        $this->db->where('quiz_id', $quiz_id);
        $this->db->update('quiz_results', $data);

        //Mark this quiz as completed
        $lesson = $this->crud_model->get_lessons('lesson', $quiz_id)->row_array();
        $completed_lessons = $this->crud_model->get_watch_histories($user_id, $lesson['course_id'])->row_array();
        $course_details = $this->crud_model->get_course_by_id($lesson['course_id'])->row_array();
        $quiz_results = $this->db->where('user_id', $user_id)->where('quiz_id', $quiz_id)->order_by('quiz_result_id', 'DESC')->get('quiz_results')->row_array();
        $completed_lessons = json_decode($completed_lessons['completed_lesson'], true);
        if (!is_array($completed_lessons) || !in_array($quiz_id, $completed_lessons)) {

            //check passing mark
            $quiz_attribute = json_decode($lesson['attachment'], true);
            $pass_mark = $quiz_attribute['pass_mark'] ?? 0;
            $drip_content_for_passing_rule = $quiz_attribute['drip_content_for_passing_rule'] ?? 'not_applicable';

            if ($course_details['enable_drip_content'] && $drip_content_for_passing_rule == 'applicable') {
                if ($pass_mark <= $quiz_results['total_obtained_marks']) {
                    $this->crud_model->update_watch_history_manually($quiz_id, $lesson['course_id'], $user_id);
                }
            } else {
                $this->crud_model->update_watch_history_manually($quiz_id, $lesson['course_id'], $user_id);
            }
        }
        $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','finish_quize_submission',null,'update',"quiz_results",'db',"quiz_submission_successfully",'finish quize submission','succesful',['text'=>'attempts to finish quize submission']);
        $response['status'] = 'submit';
        $response['message'] = site_phrase('quiz_submission_successfully');
        echo json_encode($response);
    }

    function ai_img_download()
    {
        $this->load->model('addons/ai_model');
        $this->ai_model->ai_img_download();
    }

    function chat_gpt()
    {
        if (isset($_POST['service_type']) && !empty($_POST['service_type'])) {
            $this->load->model('addons/ai_model');
            echo $this->ai_model->chat_gpt();
        } else {
            $this->load->view('backend/admin/chat_gpt');
        }
    }

    function gpt_assistant()
    {
        $this->load->model('addons/ai_model');
        echo $this->ai_model->gpt_assistant();
    }

    function student_academic_progress($course_id = "")
    {
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        $multi_instructors = explode(',', $course_details['user_id']);

        if (!in_array($this->session->userdata('user_id'), $multi_instructors)) {
            return false;
        }

        $page_data['course_details'] = $course_details;
        $this->load->view('backend/user/student_academic_progress', $page_data);
    }

    function student_academic_quiz_result($course_id = "", $student_id = "")
    {
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        $multi_instructors = explode(',', $course_details['user_id']);

        if (!in_array($this->session->userdata('user_id'), $multi_instructors)) {
            return false;
        }

        $page_data['course_details'] = $course_details;
        $page_data['student_id'] = $student_id;
        $this->load->view('backend/user/student_academic_quiz_result', $page_data);
    }

    function student_certificate($user_id = "", $course_id = "")
    {
        $this->load->model('addons/Certificate_model', 'certificate_model');
        $course_progress = $this->crud_model->get_watch_histories($user_id, $course_id)->row('course_progress');
        $certificate = $this->db->get_where('certificates', array('course_id' => $course_id, 'student_id' => $user_id));
        if ($course_progress >= 100) {
            $this->certificate_model->check_certificate_eligibility($course_id, $user_id);
            redirect(site_url('certificate/' . $certificate->row('shareable_url')));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('The course is not compleated yet'));
            redirect(site_url('user/course_form/course_edit/' . $certificate->row('shareable_url')));
        }
    }



    function resource_files($param1 = "", $param2 = "")
    {
        if ($param1 == 'add') {
            if (isset($_FILES['resource_file']['name']) && $_FILES['resource_file']['name'] != "") {
                $data['file_name'] = random(20) . '.' . pathinfo($_FILES['resource_file']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['resource_file']['tmp_name'], 'uploads/resource_files/' . $data['file_name']);
            }

            $data['title'] = $this->input->post('title');
            $data['lesson_id'] = $param2;
            $data['created_at'] = time();
            $this->db->insert('resource_files', $data);

            $response['replace'] = ['elem' => '.resource_file_content', 'content' => $this->load->view('backend/user/resource_files', ['param2' => $param2], true)];
            echo json_encode($response);
        } elseif ($param1 == 'update') {
            $file_details = $this->db->get_where('resource_files', ['id' => $param2])->row_array();
            if (isset($_FILES['resource_file']['name']) && $_FILES['resource_file']['name'] != "") {
                if (file_exists('uploads/resource_files/' . $file_details['file_name']) && $file_details['file_name']) {
                    unlink('uploads/resource_files/' . $file_details['file_name']);
                }
                $data['file_name'] = random(20) . '.' . pathinfo($_FILES['resource_file']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['resource_file']['tmp_name'], 'uploads/resource_files/' . $data['file_name']);
            }

            $data['title'] = $this->input->post('title');
            $data['updated_at'] = time();
            $this->db->where('id', $param2);
            $this->db->update('resource_files', $data);

            $response['replace'] = ['elem' => '.resource_file_content', 'content' => $this->load->view('backend/user/resource_files', ['param2' => $file_details['lesson_id']], true)];
            echo json_encode($response);
        } elseif ($param1 == 'delete') {
            $file_details = $this->db->get_where('resource_files', ['id' => $param2])->row_array();
            if (file_exists('uploads/resource_files/' . $file_details['file_name']) && $file_details['file_name']) {
                unlink('uploads/resource_files/' . $file_details['file_name']);
            }

            $this->db->where('id', $param2);
            $this->db->delete('resource_files');

            $response['replace'] = ['elem' => '.resource_file_content', 'content' => $this->load->view('backend/user/resource_files', ['param2' => $file_details['lesson_id']], true)];
            $response['success'] = get_phrase('Resource deleted successfully');
            $response['fadeOut'] = '#resource_file_' . $file_details['id'];
            echo json_encode($response);
        }
    }


    function save_bbb_meeting($course_id = "")
    {
        $user_id = $this->session->userdata('user_id');
        if (!$this->crud_model->is_course_instructor($course_id, $user_id)) {
            return;
        }
        $data['meeting_id'] = $this->input->post('bbb_meeting_id');
        $data['moderator_pw'] = $this->input->post('bbb_moderator_pw');
        $data['viewer_pw'] = $this->input->post('bbb_viewer_pw');
        $data['instructions'] = $this->input->post('instructions');

        if ($this->db->where('course_id', $course_id)->get('bbb_meetings')->num_rows() > 0) {
            $data['updated_at'] = time();
            $this->db->where('course_id', $course_id)->update('bbb_meetings', $data);
        } else {
            $data['course_id'] = $course_id;
            $data['created_at'] = time();
            $data['updated_at'] = $data['created_at'];
            $this->db->insert('bbb_meetings', $data);
        }

        echo get_phrase("BigBlueButton Meeting has been updated");
    }

    function start_bbb_meeting($course_id = "")
    {
        $user_id = $this->session->userdata('user_id');
        if (!$this->crud_model->is_course_instructor($course_id, $user_id)) {
            return;
        }

        $course_details = $this->crud_model->get_courses($course_id)->row_array();
        $bbb_meeting = $this->db->where('course_id', $course_id)->get('bbb_meetings');
        $current_url = site_url('user/course_form/course_edit/' . $course_id . '?tab=bbb-live-class');

        if ($bbb_meeting->num_rows() > 0) {
            $bbb_meeting = $bbb_meeting->row_array();
            //Sanitize API URL START
            $api_url = get_settings('bbb_setting', true)['endpoint'] ?? '';
            // Parse the URL
            $parsed_url = parse_url($api_url);
            // Remove the 'api' part if it exists in the path
            $path = rtrim(str_replace('/api', '', $parsed_url['path']), '/');
            // Rebuild the URL
            $api_url = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $path;
            //Sanitize API URL END

            //Create BBB meeting START
            $query_data = http_build_query([
                'name' => $course_details['title'],
                'meetingID' => $bbb_meeting['meeting_id'],
                'attendeePW' => $bbb_meeting['viewer_pw'],
                'moderatorPW' => $bbb_meeting['moderator_pw'],
                'redirectURL' => $current_url,
            ]);
            $response = $this->crud_model->callBbbApi('create', $query_data);
            //Create BBB meeting END

            // Handle response & redirect to meeting url
            if ($response) {
                $join_url = $this->crud_model->join_bbb_meeting_by_curl_calls($course_id);
                redirect($join_url, 'refresh');
                return;
            } else {
                $this->session->set_flashdata('error_message', get_phrase("Failed to connect to BigBlueButton API"));
            }
        } else {
            $this->session->set_flashdata('error_message', get_phrase("Please save your meeting info first"));
        }
        echo $current_url;
    }

    function join_bbb_meeting($course_id = "")
    {
        if (enroll_status($course_id) == 'valid') {
            $bbb_meeting = $this->db->where('course_id', $course_id)->get('bbb_meetings');
            $current_url = $_SERVER['HTTP_REFERER'];

            if ($bbb_meeting->num_rows() > 0) {
                $join_url = $this->crud_model->join_bbb_meeting_by_curl_calls($course_id);
                redirect($join_url, 'refresh');
            } else {
                $this->session->set_flashdata('error_message', get_phrase("Meeting not scheduled yet"));
            }
            redirect($current_url, 'refresh');
        } else {
            $this->session->set_flashdata('error_message', get_phrase("Please purchase this course first"));
            redirect(site_url('home/my_courses'), 'refresh');
        }
    }







    //custom code
    function live_schedule($param=null,$param_id=0,$param_filter=false){

        $user_id=$this->session->userdata('user_id');

        if ($param == "add") {
            $this->crud_model->add_live_schedule();
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','live_schedule','add','add_live_schedule',null,'crud_model',null,'add live schedule','successful',['text'=>'attempts to add live schedule']);
            redirect(site_url('user/live_schedule'), 'refresh');
        }
        if ($param == "update" && $param_id) {
            $this->crud_model->update_live_schedule($param_id,null,$param_filter);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','live_schedule','update','update_live_schedule',"$param_id,null,$param_filter",'crud_model',null,'update live schedule','successful',['text'=>'attempts to update live schedule']);
            redirect(site_url('user/live_schedule'), 'refresh');
        }
        if ($param == "cancel" && $param_id) {
            $this->crud_model->update_live_schedule($param_id,0,$param_filter);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','live_schedule','cancel','update_live_schedule',"$param_id,0,$param_filter",'crud_model',null,'cancel live schedule','successful',['text'=>'attempts to cancel live schedule']);
            redirect(site_url('user/live_schedule'), 'refresh');
        }
        if ($param == "delete" && $param_id) {
            $this->crud_model->delete_live_schedule($param_id);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','live_schedule','delete','delete_live_schedule',"$param_id",'crud_model',null,'delete live schedule','successful',['text'=>'attempts to delete live schedule']);
            redirect(site_url('user/live_schedule'), 'refresh');
        }

        $time=date('Y-m-d H:i:s');
        
        $page_data['page_name'] = 'live_schedule';
        $page_data['page_title'] = get_phrase('manage_live_schedule');
        $page_data['live_schedules'] = $this->crud_model->fetch_live_schedule(null,$user_id,$param_id);
        $page_data['upcoming_live_schedules'] = $this->crud_model->fetch_live_schedule(true,$user_id,$param_id,$time);
        $page_data['ongoing_live_schedules'] = $this->crud_model->fetch_live_schedule(true,$user_id,$param_id,$time,0,$time);
        $page_data['elapsed_live_schedules'] = $this->crud_model->fetch_live_schedule(null,$user_id,$param_id,0,0,$time);

        $this->load->view('backend/index', $page_data);
    }

    function message($param1 = 'message_home', $param2 = '', $param3 = '')
    {

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','message','send_new','send_new_private_message',null,'crud_model',"message_sent",'send new private message','successful',['text'=>'attempts to send new private message']);
            $this->session->set_flashdata('flash_message', get_phrase('message_sent'));
            redirect(site_url('user/message/message_read/' . $message_thread_code), 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2); //$param2 = message_thread_code
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','message','send_reply','send_reply_message',"$param2",'crud_model',"message_sent",'send reply for a private message','successful',['text'=>'attempts to send reply for a private message']);
            $this->session->set_flashdata('flash_message', get_phrase('message_sent'));
            redirect(site_url('user/message/message_read/' . $param2), 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2; // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
            $this->crud_model->add_activity_log($this->session->userdata('user_id'),1,'user','message','message','mark_thread_messages_read',"$param2",'crud_model',null,'mark thread messages as read','successful',['text'=>'attempts to mark thread messages as read']);
        }

        $page_data['message_inner_page_name'] = $param1;
        $page_data['page_name']               = 'message';
        $page_data['page_title']              = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }
}
