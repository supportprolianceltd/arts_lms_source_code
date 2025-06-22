<div class="row">
	<div class="col-md-12">
		<form class="ajaxForms" action="<?= site_url('admin/key_activity_log/add'); ?>" method=post>
      <div class="form-group">
          <label for="to_user"><?php echo get_phrase('user'); ?><span class="required">*</span> </label>
          <select class="select2 form-control" data-toggle="select2" data-placeholder="Choose ..." name="to_user" id="to_user" required>
              <option><?php echo get_phrase('choose_user'); ?></option>
              <?php $user_list = $this->db->where('status', '1')->get('users')->result_array();
                  foreach ($user_list as $user): ?>
                  <option value="<?php echo $user['id'] ?>"><?php echo $user['first_name'].' '.$user['last_name'].'('.$user['email'].')'; ?></option>
              <?php endforeach; ?>
          </select>
      </div>

      <div class="form-group">
				<label><?php echo get_phrase('activity'); ?><span class="required">*</span></label>
				<input type="text" name="activity" class="form-control" placeholder="<?php echo get_phrase('activity'); ?>" required>
			</div>

      <div class="form-group">
				<label><?php echo get_phrase('description'); ?><span class="required">*</span></label>
				<textarea type="text" id='description' name="description" class="form-control" rows=3 placeholder="<?php echo get_phrase('description'); ?>" required></textarea>
			</div>

            <div class="form-group">
				<label><?php echo get_phrase('activity_code'); ?></label>
				<input type="number" name="priority" class="form-control" placeholder="<?php echo get_phrase('activity_code'); ?>" required>
			</div>

      <div class="form-group">
          <button class="btn btn-primary float-right"><?php echo get_phrase('create_key_activity'); ?></button>
      </div>

		</form>
	</div>
</div>
