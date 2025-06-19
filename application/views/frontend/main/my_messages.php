<?php
$this->db->where('sender', $user_details['id']);
$this->db->or_where('receiver', $user_details['id']);
$message_threads = $this->db->get('message_thread')->result_array();

$this_conversation_user_info = '';
$message_thread_details = '';
foreach ($message_threads as $row){
    // defining the user to show
    if ($row['sender'] != $user_details['id']) {
        $conversation_user_id = $row['sender'];
    }
    if ($row['receiver'] != $user_details['id']) {
        $conversation_user_id = $row['receiver'];
    }

    $number_of_unreaded_message = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
    $conversation_user_info = $this->user_model->get_all_user($conversation_user_id)->row_array();
    $last_messages_details =  $this->crud_model->get_last_message_by_message_thread_code($row['message_thread_code'])->row_array();
    if (isset($message_thread_code) && $message_thread_code == $row['message_thread_code']) {
        $this_conversation_user_info = $conversation_user_info;
        $message_thread_details = $row;
    }
    $last_messages_details_time=get_past_time($last_messages_details['timestamp']);

    $td_messages.=<<<HTML
        <div class="Notti-Card">
          <div class="Top-Notti-Card">
            <h3><span>{$conversation_user_info['first_name'][0]}</span>{$conversation_user_info['first_name']} {$conversation_user_info['last_name']} <span class='badge badge-info'>$number_of_unreaded_message</span> </h3>
          <span>$last_messages_details_time</span>
          </div>

          <p>{$last_messages_details['message']}</p>
          
            <a href="$system_base_url/home/my_messages_chat/read_message/{$row['message_thread_code']}" class="message-hgHAI message-togler-11"><i class="ti-comment-alt"></i> Chat</a>
            
        </div>
HTML;
  }
  if(!$message_threads) $td_messages="<p>You do not have any messages at this time!</p>";
                    

require_once(__DIR__.'/views/my_messages.php');
?>