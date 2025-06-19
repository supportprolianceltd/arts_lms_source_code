<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo site_url('modal/popup/key_activity_log_add_modal');?>','Add key activity');" class="btn btn-outline-primary btn-rounded alignToTitle d-none"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_key_activity'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">


            <div class="row justify-content-md-center">
                    <div class="col-12">

                        <form class='justify-content-center' method=post  action="<?php echo site_url('admin/activity_log'); ?>">
                            <div class='form-group'>
                                <div id="reportrange" class="form-control" data-toggle="date-picker-range" data-target-display="#selectedValue" data-cancel-class="btn-light" style="width: 100%;">
                                        <i class="mdi mdi-calendar"></i>&nbsp;
                                        <span id="selectedValue"><?php echo date("F d, Y", $timestamp_start) . " - " . date("F d, Y", $timestamp_end); ?></span> <i class="mdi mdi-menu-down"></i>
                                    </div>
                                    <input id="date_range" type="hidden" name="date_range" value="<?php echo date("d F, Y", $timestamp_start) . " - " . date("d F, Y", $timestamp_end); ?>">
                                </div>
                            </div>

   
                    <div class='form-group col-md-3'>
                        <select class="select2 form-control" data-toggle="select2" data-placeholder="Choose ..." name="user_id" id="user_id">
                            <option value=''><?php echo get_phrase('user'); ?></option>
                            <?php $user_list = $this->db->where('status', '1')->get('users')->result_array();
                                foreach ($user_list as $user): ?>
                                <option value="<?php echo $user['id'] ?>" <?php if($user['id']==$user_id) echo 'selected' ?>><?php echo $user['first_name'].' '.$user['last_name'].'('.$user['email'].')'; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class='form-group col-md-3'>
                        <input type="text" name="controller" class="form-control" value='<?php echo $controller;?>' placeholder="<?php echo get_phrase('controller'); ?>">
                    </div>
                    <div class='form-group col-md-3'>
                        <input type="text" name="function" class="form-control" value='<?php echo $function;?>' placeholder="<?php echo get_phrase('function'); ?>">
                    </div>
                    <div class='form-group col-md-3'>
                        <input type="text" name="action" class="form-control" value='<?php echo $action;?>' placeholder="<?php echo get_phrase('action'); ?>">
                    </div>

                    <div class='form-group col-12 text-right'>
                        <button type="submit" class="btn btn-info" id="submit-button" onclick="update_date_range();"> <?php echo get_phrase('find'); ?></button>
                    </div>
                </div>
            </form>

                        <h4 class="mb-3 header-title"><?php echo get_phrase('site_activities'); ?></h4>
                        <div class="table-responsive mt-4">
                            <table id="basic-datatable" class="table table-striped table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo get_phrase('user'); ?></th>
                                        <th><?php echo get_phrase('priority'); ?></th>
                                        <th><?php echo get_phrase('controller'); ?></th>
                                        <th><?php echo get_phrase('function'); ?></th>
                                        <th><?php echo get_phrase('action'); ?></th>
                                        <th><?php echo get_phrase('created'); ?></th>
                                        <th><?php echo get_phrase('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($activity_log as $key => $log) : ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><?php $user=$log['user_id']?$this->user_model->get_all_user($log['user_id'])->row_array():[]; echo $user['first_name'].' '.$user['last_name'].'('.$user['email'].')';?></td>
                                            <td><?php echo $log['priority']; ?></td>
                                            <td><?php echo $log['controller']?></td>
                                            <td><?php echo $log['function']?></td>
                                            <td><?php echo $log['action']?></td>
                                            <td><?php echo date('j F,Y',strtotime($log['created'])); ?></td>
                                            <td>
                                                <div class="dropright dropright">
                                                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="showAjaxModal('<?php echo site_url('modal/popup/activity_log_info_modal/' . $log['id']);?>','Activity');"><?php echo get_phrase('info'); ?></a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<script type="text/javascript">
    function update_date_range() {
        var x = $("#selectedValue").html();
        $("#date_range").val(x);
    }
</script>