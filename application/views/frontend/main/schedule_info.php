<?php
$schedules_list[]=$this->crud_model->get_live_schedule($schedule_id);
$schedules_list_file='schedule_info_td';
$title='Info';
require_once(__DIR__.'/schedules_list.php');
require_once(__DIR__.'/views/schedule_info.php');
?>
