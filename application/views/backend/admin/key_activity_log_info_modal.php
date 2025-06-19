<?php
  $system_base_url=base_url();
  $key_activity_log=$this->crud_model->fetch_key_activity_log(array('id'=>$param2))[0];
  if($key_activity_log) {
    $time=time();
    $user=$key_activity_log['user_id']?$this->user_model->get_all_user($key_activity_log['user_id'])->row_array():[];
    $to_user=$key_activity_log['to_user']?$this->user_model->get_all_user($key_activity_log['to_user'])->row_array():[];
    $created=date('j F,Y @h:m:s a',strtotime($key_activity_log['created']));
    $updated=$key_activity_log['updated']!='0000-00-00 00:00:00'?date('j F,Y @h:m:s a',strtotime($key_activity_log['updated'])):null;
    $user_link=$user?"<a target='_blank' href='{$system_base_url}admin/user_profile/{$user['id']}'>{$user['first_name']} {$user['last_name']} ({$user['email']})</a>":null;
    $to_user_link=$to_user?"<a target='_blank' href='$system_base_url/admin/user_profile/{$to_user['id']}'>{$to_user['first_name']} {$to_user['last_name']} ({$to_user['email']})</a>":null;
    echo <<<HTML
      <table class=''>
        <tr>
          <td class='text-left'>Logger:</td>
          <td class='text-left'>$user_link</td>
        </tr>
        <tr>
          <td class='text-left'>User:</td>
          <td class='text-left'>$to_user_link</td>
        </tr>
        <tr class='d-none'>
          <td class='text-left'>Type:</td>
          <td class='text-left'><span class='badge badge-info'>$type</span></td>
        </tr>
        <tr>
          <td class='text-left'>Activity:</td>
          <td class='text-left'>{$key_activity_log['activity']}</td>
        </tr>
        <tr>
          <td class='text-left'>Description:</td>
          <td class='text-left'>{$key_activity_log['description']}</td>
        </tr>
        <tr class='$course_disp'>
          <td class='text-left'>Activity code:</td>
          <td class='text-left'>{$key_activity_log['priority']}</td>
        </tr>
        <tr>
          <td class='text-left'>Created:</td>
          <td class='text-left'>$created</td>
        </tr>
        <tr>
          <td class='text-left'>Last updated:</td>
          <td class='text-left'>$updated</td>
        </tr>
      </table>
HTML;
  }
  else echo "<div class='alert alert-error'><i class='mdi mdi-bell-outline mr-1'></i>Key activity not found</div>";
?>
