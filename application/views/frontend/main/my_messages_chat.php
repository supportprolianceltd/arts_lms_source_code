<?php
  $messages_thread_details = $this->db->get_where('message_thread', array('message_thread_code' => $message_thread_code))->row_array();
  $this_conversation_user_info=$this->user_model->get_all_user($messages_thread_details['sender']==$user_id?$messages_thread_details['receiver']:$messages_thread_details['sender'])->row_array();
  $this_conversation_user_info_image=$this->user_model->get_user_image_url($this_conversation_user_info['id']);

  $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
  foreach ($messages as $message) {
    if ($message['sender'] == $this->session->userdata('user_id')) {
        $conversation_user = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
        //$this_conversation_user_info=$this->user_model->get_all_user($message['receiver'])->row_array();
    } else {
        $conversation_user = $this->user_model->get_all_user($message['sender'])->row_array();
        //$this_conversation_user_info=$this->user_model->get_all_user($message['sender'])->row_array();
    }
    $conversation_user_image=$this->user_model->get_user_image_url($conversation_user['id']);
    $message_timestamp=get_past_time($message['timestamp']);
    if($conversation_user['id']==$user_id){
      $message_class='user-message-div';
      $btn_top=null;
      $btn_bottom="<button class='user-img'><img src='$conversation_user_image' /></button>";
    }
    else{
      $message_class='artisan-message-div';
      $btn_bottom=null;
      $btn_top="<button class='user-img'><img src='$conversation_user_image' /></button>";
    }

    $td_my_messages_chat.=<<<HTML
    <div class="$message_class">
        $btn_top
        <div class="chart-thumbnail">
            <p>{$message['message']}</p>
            <span>$message_timestamp</span>
        </div>
        $btn_bottom
    </div><!--artisan-message-div-->
HTML;
  }
require_once(__DIR__.'/views/my_messages_chat.php');
?>