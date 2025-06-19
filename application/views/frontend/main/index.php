<?php
$time=time();
$system_base_url_trail=base_url();
$system_base_url=rtrim($system_base_url_trail,'/');
$system_settings=$this->crud_model->get_settings();
$system_frontend_settings=$this->crud_model->get_frontend_settings();
$system_assets_base_url="$system_base_url/assets/frontend/{$system_frontend_settings['theme']}";
$system_frontend_base_url="$system_base_url/uploads/system/";
$system_frontend_settings_banner_image=json_decode($system_frontend_settings['banner_image'],true);

$system_flash_message=$this->session->flashdata('flash_message');
$system_error_message=$this->session->flashdata('error_message');
$system_info_message=$this->session->flashdata('info_message');

$cart_items = (array)$this->session->userdata('cart_items');
$user_id = $this->session->userdata('user_id');
$user_login = $this->session->userdata('user_login');
$admin_login = $this->session->userdata('admin_login');
$is_instructor = $this->session->userdata('is_instructor');

$num_cart_items=count($cart_items);

if($user_id > 0) {
    $id=$this->crud_model->toID($user_id);
    $user_details = $this->user_model->get_all_user($user_id)->row_array();
    $number_of_unread_notification = $this->db->order_by('status ASC, id desc')->limit(50)->where('status', 0)->where('to_user', $user_id)->get('notifications')->num_rows();
    $number_of_unread_notification_text=$number_of_unread_notification?"<span>$number_of_unread_notification+</span>":null;
    $user_profile_photo=$this->user_model->get_user_image_url($user_id);
}

{
    $__hide_elem_class_if_logged_in=$user_id?'d-none':null;
    $__hide_elem_class_if_logged_out=$user_id?null:'d-none';
    $__show_elem_class_if_logged_in=$user_id?null:'d-none';
    $__show_elem_class_if_logged_out=$user_id?'d-none':null;

    $__show_elem_class_if_admin=$admin_login?null:'d-none';
    $__hide_elem_class_if_admin=$admin_login || !$user_id?'d-none':null;

    $__show_elem_class_if_instructor=$is_instructor?null:'d-none';
    $__hide_elem_class_if_instructor=$is_instructor || !$user_id?'d-none':null;

    $__show_elem_class_if_user=$is_instructor||$admin_login?null:'d-none';
    $__hide_elem_class_if_user=$is_instructor || $admin_login || !$user_id?'d-none':null;


    $system_facebook_disp = $system_settings['facebook']?null:'d-none';
    $system_twitter_disp = $system_settings['twitter']?null:'d-none';
    $system_linkedin_disp = $system_settings['linkedin']?null:'d-none';
}

$default_header='header';
$default_footer='footer';

$meta_description=$meta_description?$meta_description:$system_settings['meta_description'];
$meta_keywords=$meta_keywords?$meta_keywords:$system_settings['meta_keywords'];

$headers=array('sign_up'=>'login_header','login'=>'login_header','forgot-password'=>'login_header','password-reset'=>'login_header','404'=>'login_header','verification_code'=>'login_header','book_class'=>'login_header','my_courses'=>'logged_in_header','purchase_history'=>'logged_in_header','user_profile'=>'logged_in_header','all_courses'=>'logged_in_header','completed_courses'=>'logged_in_header','all_schedules'=>'logged_in_header','ongoing_schedules'=>'logged_in_header','upcoming_schedules'=>'logged_in_header','elapsed_schedules'=>'logged_in_header','schedule_info'=>'logged_in_header','all_assignments'=>'logged_in_header','pending_assignments'=>'logged_in_header','active_assignments'=>'logged_in_header','elapsed_assignments'=>'logged_in_header','statistics'=>'logged_in_header','notifications'=>'logged_in_header','my_messages'=>'logged_in_header','my_messages_chat'=>'logged_in_header','shopping_carts'=>'login_header');
$footers=array('sign_up'=>'login_footer','login'=>'login_footer','forgot-password'=>'login_footer','password-reset'=>'login_footer','404'=>'login_footer','verification_code'=>'login_footer','book_class'=>'foot','my_courses'=>'logged_in_footer','purchase_history'=>'logged_in_footer','user_profile'=>'logged_in_footer','all_courses'=>'logged_in_footer','completed_courses'=>'logged_in_footer','all_schedules'=>'logged_in_footer','ongoing_schedules'=>'logged_in_footer','upcoming_schedules'=>'logged_in_footer','elapsed_schedules'=>'logged_in_footer','schedule_info'=>'logged_in_footer','all_assignments'=>'logged_in_footer','pending_assignments'=>'logged_in_footer','active_assignments'=>'logged_in_footer','elapsed_assignments'=>'logged_in_footer','statistics'=>'logged_in_footer','notifications'=>'logged_in_footer','my_messages'=>'logged_in_footer','my_messages_chat'=>'logged_in_footer','shopping_carts'=>'login_footer');

$__active_tab[$page_name]='active-left-AHrf';

$pre_header=$headers[$page_name];
$pre_footer=$footers[$page_name];
$header=$pre_header?$pre_header:$default_header;
$footer=$pre_footer?$pre_footer:$default_footer;

require_once($header.'.php');
require_once($page_name.'.php');
require_once($footer.'.php');
?>
