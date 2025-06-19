<div class="row">
	<div class="col-md-12">
		<form class="ajaxForms" action="<?= site_url('admin/report_qa/add'); ?>" method=post enctype="multipart/form-data">
      <div class="form-group d-none">
          <label for="to_user"><?php echo get_phrase('user'); ?><span class="required">*</span> </label>
          <select class="select2 form-control" data-toggle="select2" data-placeholder="Choose ..." name="to_user" id="to_user">
              <option><?php echo get_phrase('choose_user'); ?></option>
              <?php $user_list = $this->db->where('status', '1')->where('is_instructor', '1')->get('users')->result_array();
                  foreach ($user_list as $user): ?>
                  <option value="<?php echo $user['id'] ?>"><?php echo $user['first_name'].' '.$user['last_name'].'('.$user['email'].')'; ?></option>
              <?php endforeach; ?>
          </select>
      </div>

      <div class="form-group">
				<label><?php echo get_phrase('topic'); ?><span class="required">*</span></label>
				<input type="text" name="title" class="form-control" placeholder="<?php echo get_phrase('title'); ?>" required>
			</div>

      <div class="form-group">
				<label><?php echo get_phrase('remarks'); ?><span class="required">*</span></label>
				<textarea type="text" id='description' name="description" class="form-control" rows=3 placeholder="<?php echo get_phrase('description'); ?>" required></textarea>
			</div>

            <div class="form-group">
				<label><?php echo get_phrase('code'); ?></label>
				<input type="number" name="code" class="form-control" placeholder="<?php echo get_phrase('optional'); ?>">
			</div>

            <div class="form-group">
				<div class="input-group">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="file" name="file" onchange="changeTitleOfImageUploader(this)">
						<label class="custom-file-label" for="file"><?php echo get_phrase('choose_file'); ?></label>
					</div>
				</div>
			</div>

      <div class="form-group">
          <button class="btn btn-primary float-right"><?php echo get_phrase('create_report'); ?></button>
      </div>

		</form>
	</div>
</div>
