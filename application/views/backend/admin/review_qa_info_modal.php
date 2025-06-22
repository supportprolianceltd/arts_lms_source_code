<?php
  $system_base_url=base_url();
  $review_qa=$this->crud_model->fetch_review_qa(array('id'=>$param2))[0];
  if($review_qa) {
    $time=time();
    $user=$review_qa['user_id']?$this->user_model->get_all_user($review_qa['user_id'])->row_array():[];
    $to_user=$review_qa['to_user']?$this->user_model->get_all_user($review_qa['to_user'])->row_array():[];
    $created=date('j F,Y @h:m:s a',strtotime($review_qa['created']));
    $updated=$review_qa['updated']!='0000-00-00 00:00:00'?date('j F,Y @h:m:s a',strtotime($review_qa['updated'])):null;
    $user_link=$user?"<a target='_blank' href='{$system_base_url}admin/user_profile/{$user['id']}'>{$user['first_name']} {$user['last_name']} ({$user['email']})</a>":null;
    $to_user_link=$to_user?"<a target='_blank' href='$system_base_url/admin/user_profile/{$to_user['id']}'>{$to_user['first_name']} {$to_user['last_name']} ({$to_user['email']})</a>":null;
    $file_disp=$review_qa['file']?null:'d-none';
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
        <tr>
          <td class='text-left'>Review:</td>
          <td class='text-left'>{$review_qa['description']}</td>
        </tr>
        <tr>
          <td class='text-left'>rating:</td>
          <td class='text-left'>{$review_qa['code']}</td>
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
  else echo "<div class='alert alert-error'><i class='mdi mdi-bell-outline mr-1'></i>review not found</div>";
?>
