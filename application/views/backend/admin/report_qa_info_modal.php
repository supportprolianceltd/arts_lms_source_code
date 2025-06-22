<?php
  $system_base_url=base_url();
  $report_qa=$this->crud_model->fetch_report_qa(array('id'=>$param2))[0];
  if($report_qa) {
    $time=time();
    $user=$report_qa['user_id']?$this->user_model->get_all_user($report_qa['user_id'])->row_array():[];
    $to_user=$report_qa['to_user']?$this->user_model->get_all_user($report_qa['to_user'])->row_array():[];
    $created=date('j F,Y @h:m:s a',strtotime($report_qa['created']));
    $updated=$report_qa['updated']!='0000-00-00 00:00:00'?date('j F,Y @h:m:s a',strtotime($report_qa['updated'])):null;
    $user_link=$user?"<a target='_blank' href='{$system_base_url}admin/user_profile/{$user['id']}'>{$user['first_name']} {$user['last_name']} ({$user['email']})</a>":null;
    $to_user_link=$to_user?"<a target='_blank' href='$system_base_url/admin/user_profile/{$to_user['id']}'>{$to_user['first_name']} {$to_user['last_name']} ({$to_user['email']})</a>":null;
    $file_disp=$report_qa['file']?null:'d-none';
    echo <<<HTML
      <table class=''>
        <tr>
          <td class='text-left'>Logger:</td>
          <td class='text-left'>$user_link</td>
        </tr>
        <tr class='d-none'>
          <td class='text-left'>User:</td>
          <td class='text-left'>$to_user_link</td>
        </tr>
        <tr>
          <td class='text-left'>Topic:</td>
          <td class='text-left'>{$report_qa['title']}</td>
        </tr>
        <tr>
          <td class='text-left'>Remarks:</td>
          <td class='text-left'>{$report_qa['description']}</td>
        </tr>
        <tr>
          <td class='text-left'>Code:</td>
          <td class='text-left'>{$report_qa['code']}</td>
        </tr>
        <tr class='$file_disp'>
          <td class='text-left'>File:</td>
          <td class='text-left'><a class='btn btn-primary' target='_blank' href='$system_base_url{$report_qa['file']}'> Download </a></td>
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
  else echo "<div class='alert alert-error'><i class='mdi mdi-bell-outline mr-1'></i>Report not found</div>";
?>
