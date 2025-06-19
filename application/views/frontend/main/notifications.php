<?php
$notifications = $this->db->order_by('status ASC, id desc')->limit(50)->where('to_user', $user_id)->get('notifications')->result_array();
    foreach($notifications as $notification){
        $i++;
        $notification_past_time=get_past_time($notification['created_at']);
        $notifications_td.=<<<HTML
        <div class="Notti-Card">
          <div class="Top-Notti-Card">
            <h3>{$notification['title']}</h3>
          <span>$notification_past_time</span>
          </div>
          <p>{$notification['description']}</p>
        </div>
HTML;
    }
$this->db->where('to_user', $user_id);
$this->db->update('notifications', ['status' => 1]);

require_once(__DIR__.'/views/notifications.php');
?>