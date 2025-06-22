<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo site_url('modal/popup/review_qa_edit_modal');?>','Add review');" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_review'); ?></a>
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

                        <form class='justify-content-center' method=post  action="<?php echo site_url('admin/review_qa'); ?>">
                            <div class='form-group'>
                                <div id="reportrange" class="form-control" data-toggle="date-picker-range" data-target-display="#selectedValue" data-cancel-class="btn-light" style="width: 100%;">
                                        <i class="mdi mdi-calendar"></i>&nbsp;
                                        <span id="selectedValue"><?php echo date("F d, Y", $timestamp_start) . " - " . date("F d, Y", $timestamp_end); ?></span> <i class="mdi mdi-menu-down"></i>
                                    </div>
                                    <input id="date_range" type="hidden" name="date_range" value="<?php echo date("d F, Y", $timestamp_start) . " - " . date("d F, Y", $timestamp_end); ?>">
                                </div>
                            </div>

   
                    <div class='form-group col-md-4'>
                        <select class="select2 form-control" data-toggle="select2" data-placeholder="Choose ..." name="user_id" id="user_id">
                            <option value=''><?php echo get_phrase('logger'); ?></option>
                            <?php $user_list = $this->db->where('status', '1')->where('role_id', '1')->get('users')->result_array();
                                foreach ($user_list as $user): ?>
                                <option value="<?php echo $user['id'] ?>" <?php if($user['id']==$user_id) echo 'selected' ?>><?php echo $user['first_name'].' '.$user['last_name'].'('.$user['email'].')'; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class='form-group col-md-4'>
                        <select class="select2 form-control" data-toggle="select2" data-placeholder="Choose ..." name="to_user" id="to_user">
                            <option value=''><?php echo get_phrase('user'); ?></option>
                            <?php $user_list = $this->db->where('status', '1')->where('is_instructor', '1')->get('users')->result_array();
                                foreach ($user_list as $user): ?>
                                <option value="<?php echo $user['id'] ?>" <?php if($user['id']==$to_user) echo 'selected' ?>><?php echo $user['first_name'].' '.$user['last_name'].'('.$user['email'].')'; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class='form-group col-4 text-right'>
                        <button type="submit" class="btn btn-info" id="submit-button" onclick="update_date_range();"> <?php echo get_phrase('find'); ?></button>
                    </div>
                </div>
            </form>



                <h4 class="mb-3 header-title">Q/A <?php echo get_phrase('reviews'); ?></h4>
                <div class="table-responsive mt-4">
                    <table id="basic-datatablei" class="datatable-user-data-buttons table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('logger'); ?></th>
                                <th><?php echo get_phrase('user'); ?></th>
                                <th><?php echo get_phrase('title'); ?></th>
                                <th><?php echo get_phrase('created'); ?></th>
                                <th><?php echo get_phrase('updated'); ?></th>
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($review_qa as $key => $activity_log) : ?>
                                <tr id='tr_<?php echo $key + 1; ?>'>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php $user=$activity_log['user_id']?$this->user_model->get_all_user($activity_log['user_id'])->row_array():[]; echo $user['first_name'].' '.$user['last_name'].'('.$user['email'].')';?></td>
                                    <td><?php $to_user=$activity_log['to_user']?$this->user_model->get_all_user($activity_log['to_user'])->row_array():[]; echo $to_user['first_name'].' '.$to_user['last_name'].'('.$to_user['email'].')';?></td>
                                    <td><?php echo $activity_log['title'];?></td>
                                    <td><?php echo date('j F,Y',strtotime($activity_log['created'])); ?></td>
                                    <td><?php echo $activity_log['updated']!='0000-00-00 00:00:00'?date('j F,Y',strtotime($activity_log['updated'])):null; ?></td>
                                    <td>
                                        <div class="dropright dropright">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="showAjaxModal('<?php echo site_url('modal/popup/review_qa_info_modal/' . $activity_log['id']);?>','review');"><?php echo get_phrase('info'); ?></a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="showAjaxModal('<?php echo site_url('modal/popup/review_qa_edit_modal/' . $activity_log['id']);?>','Edit review');"><?php echo get_phrase('edit'); ?></a></li>
                                                <li><a class="dropdown-item" href="#" onclick="ajax_confirm_modal('<?php echo site_url('admin/review_qa/delete_api/' . $activity_log['id']); ?>','tr_<?php echo $key + 1; ?>');"><?php echo get_phrase('delete'); ?></a></li>
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