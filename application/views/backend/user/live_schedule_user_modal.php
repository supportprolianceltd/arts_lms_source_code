<?php $schedule=$this->crud_model->get_live_schedule($param2);?>
<div class="row">
	<div class="col-md-12">
    <?php echo $schedule?null:"<div class='alert alert-error'><i class='mdi mdi-bell-outline mr-1'></i>Schedule not found</div>";?>
		<form class="ajaxForms <?php echo $schedule?null:'d-none';?>" action="<?= site_url("admin/live_schedule/add_user/$param2"); ?>" method=post>

        <div class="form-group">
            <label for="user_id"><?php echo get_phrase('users'); ?><span class="required">*</span> </label>
            <select class="server-side-select2 form-control" data-toggle="select2" data-placeholder="Choose ..." name="user_id[]" id="user_id" multiple="multiple" style='max-height:400px;min-height:200px;' required>
                <?php $user_list = $this->db->where('status', 1)->get('users')->result_array();
                    foreach ($user_list as $user): ?>
                    <?php if(!$this->crud_model->get_all_live_schedule_user($user['id'],$param2)->row_array()):?>
                        <option value="<?php echo $user['id'] ?>" <?php if($user['id']==$schedule['course_ids']) echo 'selected'; ?>> <?php echo $user['first_name'].' '.$user['last_name'].'('.$user['email'].')'; ?> </option>
                    <?php endif;?>
                <?php endforeach; ?>
            </select>
        </div>
    
      <div class="form-group">
          <button class="btn btn-primary float-right"><?php echo get_phrase('add_users'); ?></button>
      </div>

		</form>
	</div>
  <div class="col-md-12 mt-2 shadow" style='overflow-y:scroll;max-height:400px;'>
      <?php $user_list = $this->db->where('live_schedule_id', $param2)->get('live_schedule_user')->result_array();
          foreach ($user_list as $live_schedule_user): ?>
            <?php $user=$this->user_model->get_all_user($live_schedule_user['user_id'])->row_array();?>
            <?php if($user):?>
                <div id="user_<?php echo $live_schedule_user['id'] ?>" user_id="<?php echo $user['id'] ?>" class='p-1 user_list'><?php echo $user['first_name'].' '.$user['last_name'].'('.$user['email'].')'; ?> <button type="button" class="close alignToTitle" aria-label="Close" onclick="ajax_confirm_modal('<?= site_url('admin/live_schedule/delete_user_api/'.$live_schedule_user['id']); ?>', 'user_<?php echo $live_schedule_user['id'] ?>')"><span aria-hidden="true">×</span></button> <hr></div>
            <?php endif;?>
      <?php endforeach; ?>
  </div>
</div>


<script type="text/javascript">
    function remove_user(id){

    }
</script>
