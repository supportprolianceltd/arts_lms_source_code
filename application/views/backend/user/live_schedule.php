<?php $system_base_url=base_url();?>
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('live_schedule');?>
                    <a href="javascript:void(0);" onclick="showLargeModal('<?php echo site_url('modal/popup/live_schedule_diary_modal');?>','Events');" class="btn btn-outline-primary btn-rounded alignToTitle ml-3"><?php echo get_phrase('Diary'); ?><small><i class="dripicons-document ml-1"></i></small></a>   <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo site_url('modal/popup/live_schedule_add_modal');?>','Add schedule');" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_schedule'); ?></a>
            </h4>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                    <li class="nav-item">
                        <a href="#ongoing" data-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                            <i class="mdi mdi mdi-play mr-1"></i>
                            <span><?php echo site_phrase('ongoing'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#upcoming" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            <i class="mdi mdi-clock-outline mr-1"></i>
                            <span><?php echo site_phrase('upcoming'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#elapsed" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            <i class="mdi mdi-bell-outline mr-1"></i>
                            <span><?php echo get_phrase('elapsed'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#all" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            <i class="mdi mdi-router-wireless-settings mr-1"></i>
                            <span><?php echo site_phrase('all'); ?></span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div class="tab-pane show active" id="ongoing">
                        <div class="table-responsive-sm mt-4">
                            <table class="table table-striped table-centered mb-0" id='ongoing_live_schedule_table'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo get_phrase('Title'); ?></th>
                                        <th><?php echo get_phrase('Type'); ?></th>
                                        <th><?php echo get_phrase('Status'); ?></th>
                                        <th><?php echo get_phrase('Start'); ?></th>
                                        <th><?php echo get_phrase('Duration'); ?></th>
                                        <th><?php echo get_phrase('Platform'); ?></th>
                                        <th><?php echo get_phrase('Action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$schedules=$ongoing_live_schedules;
$schedules_file='live_schedule_td';
include(__DIR__.'/live_schedule_list.php');
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="upcoming">
                        <div class="table-responsive-sm mt-4">
                            <table class="table table-striped table-centered mb-0" id='upcoming_live_schedule_table'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo get_phrase('Title'); ?></th>
                                        <th><?php echo get_phrase('Type'); ?></th>
                                        <th><?php echo get_phrase('Status'); ?></th>
                                        <th><?php echo get_phrase('Start'); ?></th>
                                        <th><?php echo get_phrase('Duration'); ?></th>
                                        <th><?php echo get_phrase('Platform'); ?></th>
                                        <th><?php echo get_phrase('Action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$schedules=$upcoming_live_schedules;
$schedules_file='live_schedule_td';
include(__DIR__.'/live_schedule_list.php');
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="elapsed">
                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-centered mb-0" id='elapsed_live_schedule_table'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo get_phrase('Title'); ?></th>
                                        <th><?php echo get_phrase('Type'); ?></th>
                                        <th><?php echo get_phrase('Status'); ?></th>
                                        <th><?php echo get_phrase('Start'); ?></th>
                                        <th><?php echo get_phrase('Duration'); ?></th>
                                        <th><?php echo get_phrase('Platform'); ?></th>
                                        <th><?php echo get_phrase('Action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$schedules=$elapsed_live_schedules;
$schedules_file='live_schedule_td';
include(__DIR__.'/live_schedule_list.php');
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="all">
                        <div class="table-responsive-sm mt-4">
                            <table class="table table-striped table-centered mb-0" id='live_schedule_table'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <!--<th><?php echo get_phrase('Creator'); ?></th>-->
                                        <th><?php echo get_phrase('Title'); ?></th>
                                        <th><?php echo get_phrase('Type'); ?></th>
                                        <!--<th><?php echo get_phrase('Course'); ?></th>-->
                                        <th><?php echo get_phrase('Status'); ?></th>
                                        <th><?php echo get_phrase('Start'); ?></th>
                                        <th><?php echo get_phrase('Duration'); ?></th>
                                        <th><?php echo get_phrase('Platform'); ?></th>
                                        <th><?php echo get_phrase('Action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$schedules=$live_schedules;
$schedules_file='live_schedule_td';
include(__DIR__.'/live_schedule_list.php');
?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>

            </div> <!-- end card-body-->
        </div>
    </div>
</div>




<script type="text/javascript">
  $(document).ready(function () {
    initDataTable(['#live_schedule_table', '#ongoing_live_schedule_table', '#upcoming_live_schedule_table', '#elapsed_live_schedule_table']);
  });
</script>

