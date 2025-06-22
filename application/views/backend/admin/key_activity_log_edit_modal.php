<?php
  $key_activity_log=$this->crud_model->fetch_key_activity_log(array('id'=>$param2))[0];
  $user=$key_activity_log['to_user']?$this->user_model->get_all_user($key_activity_log['to_user'])->row_array():[];
?>
<div class="row">
	<div class="col-md-12">
		<form class="ajaxForms" action="<?= site_url("admin/key_activity_log/update/$param2"); ?>" method=post>

    <div class="form-group">
				<label><?php echo get_phrase('user'); ?><span class="required">*</span></label>
				<input type="text" name="user" class="form-control" value='<?php echo $user['first_name'].' '.$user['last_name'].'('.$user['email'].')'; ?>' placeholder="<?php echo get_phrase('user'); ?>" readonly>
			</div>
      <div class="form-group">
				<label><?php echo get_phrase('activity'); ?><span class="required">*</span></label>
				<input type="text" name="activity" class="form-control" value='<?php echo $key_activity_log['activity'];?>' placeholder="<?php echo get_phrase('activity'); ?>" required>
			</div>

      <div class="form-group">
				<label><?php echo get_phrase('description'); ?><span class="required">*</span></label>
				<textarea type="text" id='description' name="description" class="form-control" rows=3 placeholder="<?php echo get_phrase('description'); ?>" required> <?php echo $key_activity_log['description'];?></textarea>
			</div>

            <div class="form-group">
				<label><?php echo get_phrase('activity_code'); ?></label>
				<input type="number" name="priority" class="form-control" value='<?php echo $key_activity_log['priority'];?>' placeholder="<?php echo get_phrase('activity_code'); ?>" required>
			</div>

      <div class="form-group">
          <button class="btn btn-primary float-right"><?php echo get_phrase('edit_key_activity'); ?></button>
      </div>

		</form>
	</div>
</div>
