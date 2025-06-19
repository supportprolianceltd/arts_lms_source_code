<?php

echo <<<HTML
    <tr>
        <td>
            $schedule_i
        </td>
        <td>
            $schedule_title
        </td>
        <td>
            <span class='badge badge-info'>$schedule_type</span>
        </td>
        <!--<td>
            <a href='$system_base_url/admin/course_form/course_edit/$schedule_course_id'>{$schedule_course['title']}</a>
        </td>-->
        <td>
            $status
        </td>
        <td>
            $schedule_start_time_h
        </td>
        <td>
            $schedule_duration_h
        </td>
        <td>
            $schedule_platform
        </td>
        <td>
            <div class="dropright dropright">
                <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_info_modal/$schedule_id','Schedule info');">Info</a></li>
                    <li class='$schedule_edit_btn_disp'><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_edit_modal/$schedule_id','Edit schedule');">Edit</a></li>
                    <li class='$schedule_edit_btn_disp'><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_user_modal/$schedule_id','Event users');">Users</a></li>
                    <li class='$schedule_record_disp'><a class="dropdown-item" href="#" onclick="showAjaxModal('$system_base_url/modal/popup/live_schedule_edit_record_modal/$schedule_id','Pre-recorded video url');">Pre-recorded</a></li>
                    <li class='$schedule_edit_btn_disp'><a class="dropdown-item" href="#" onclick="confirm_modal('$system_base_url/admin/live_schedule/cancel/$schedule_id');">Cancel</a></li>
                    <li><a class="dropdown-item" href="#" onclick="confirm_modal('$system_base_url/admin/live_schedule/delete/$schedule_id');">Delete</a></li>
                </ul>
            </div>
        </td>
    </tr>
HTML;
?>