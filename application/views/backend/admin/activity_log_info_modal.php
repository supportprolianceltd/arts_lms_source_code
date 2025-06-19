<?php
  $system_base_url=base_url();
  $activity_log=$this->crud_model->fetch_activity_log(array('id'=>$param2))[0];
  if($activity_log) {
    $time=time();
    $user=$activity_log['user_id']?$this->user_model->get_all_user($activity_log['user_id'])->row_array():[];
    $created=date('j F,Y @h:m:s a',strtotime($activity_log['created']));
    $updated=date('j F,Y @h:m:s a',strtotime($activity_log['updated']));
    $feedback_bg=$activity_log['feedback']=='failed'?'danger':'info';
    $user_link=$user?"<a target='_blank' href='$system_base_url/admin/user_profile/{$user['id']}'>{$user['first_name']} {$user['last_name']} ({$user['email']})</a>":null;
    echo <<<HTML
      <table class=''>
        <tr>
          <td class='text-left'>User:</td>
          <td class='text-left'>$user_link</td>
        </tr>
        <tr>
          <td class='text-left'>Priority:</td>
          <td class='text-left'>{$activity_log['priority']}</td>
        </tr>
        <tr>
          <td class='text-left'>Feedback:</td>
          <td class='text-left'><span class='badge badge-$feedback_bg'>{$activity_log['feedback']}</span></td>
        </tr>
        <tr>
          <td class='text-left'>Controller:</td>
          <td class='text-left'>{$activity_log['controller']}</td>
        </tr>
        <tr>
          <td class='text-left'>Function:</td>
          <td class='text-left'>{$activity_log['function']}</td>
        </tr>
        <tr>
          <td class='text-left'>Option:</td>
          <td class='text-left'>{$activity_log['option']}</td>
        </tr>
        <tr>
          <td class='text-left'>Action:</td>
          <td class='text-left'>{$activity_log['action']}</td>
        </tr>
        <tr>
          <td class='text-left'>Parameter:</td>
          <td class='text-left'>{$activity_log['parameter']}</td>
        </tr>
        <tr>
          <td class='text-left'>Model:</td>
          <td class='text-left'>{$activity_log['model']}</td>
        </tr>
        <tr>
          <td class='text-left'>Message:</td>
          <td class='text-left'>{$activity_log['message']}</td>
        </tr>
        <tr>
          <td class='text-left'>Created:</td>
          <td class='text-left'>$created</td>
        </tr>
        <tr class='d-none'>
          <td class='text-left'>Last updated:</td>
          <td class='text-left'>$updated</td>
        </tr>
      </table>
HTML;
  }
  else echo "<div class='alert alert-error'><i class='mdi mdi-bell-outline mr-1'></i>Activity not found</div>";
?>
