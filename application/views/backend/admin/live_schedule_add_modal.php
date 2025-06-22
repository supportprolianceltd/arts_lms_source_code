<div class="row">
	<div class="col-md-12">
		<form class="ajaxForms" action="<?= site_url('admin/live_schedule/add'); ?>" method=post>
      <div class="form-group">
          <label for="course_id"><?php echo get_phrase('event/course'); ?><span class="required">*</span> </label>
          <select class="select2 form-control" data-toggle="select2" data-placeholder="Choose ..." name="course_id" id="course_id" required>
              <option value="0"><?php echo get_phrase('schedule_event'); ?></option>
              <?php $course_list = $this->db->where('status', 'active')->or_where('status', 'private')->get('course')->result_array();
                  foreach ($course_list as $course): ?>
                  <option value="<?php echo $course['id'] ?>"><?php echo $course['title']; ?></option>
              <?php endforeach; ?>
          </select>
      </div>

      <div class="form-group">
				<label><?php echo get_phrase('title'); ?></label>
				<input type="text" name="title" class="form-control" placeholder="<?php echo get_phrase('title'); ?>">
			</div>

      <div class="mt-1 botder-top mb-2">
                                              
        <label><?php echo get_phrase('start_time').'(GMT)'; ?><span class="required">*</span></label>

          <div class="input-group">
              <input type="datetime-local" class="form-control"  id="start_time" name="start_time" value="" required>
              <div class="input-group-append"> 
                  <span class="input-group-text"><i class="dripicons-clock"></i></span>
              </div>
          </div>
      </div>

      <div class="form-group">
        <label><?php echo get_phrase('duration(hrs)'); ?><span class="required">*</span></label>
        <select required class="form-control select2" id="duration" name="duration" data-toggle="select2" data-allow-clear="true"  data-placeholder="<?php echo get_phrase('duration'); ?> " >
          
              <option value="0"><?php echo get_phrase('Select Duration'); ?> </option>
              <option value='01:00'>1h:00</option>
              <option value='01:15'>1h:15</option>
              <option value='01:30'>1h:30</option>
              <option value='01:45'>1h:45</option>
              <option value='02:00'>2h:00</option>
              <option value='02:15'>2h:15</option>
              <option value='02:30'>2h:30</option>
              <option value='02:45'>2h:45</option>
              <option value='03:00'>3h:00</option>
              <option value='03:15'>3h:15</option>
              <option value='03:30'>3h:30</option>
              <option value='03:45'>3h:45</option>
              <option value='04:00'>4h:00</option>
              <option value='04:15'>4h:15</option>
              <option value='04:30'>4h:30</option>
              <option value='04:45'>4h:45</option>
              <option value='05:00'>5h:00</option>
              <option value='05:15'>5h:15</option>
              <option value='05:30'>5h:30</option>
              <option value='05:45'>5h:45</option>
              <option value='06:00'>6h:00</option>
          </select>
      </div>
      <div class="form-group">
				<label><?php echo get_phrase('platform'); ?></label>
				<input type="text" name="platform" class="form-control" placeholder="<?php echo get_phrase('enter_platform_name_e.g_zoom'); ?>">
			</div>
      <div class="form-group">
				<label><?php echo get_phrase('platform_link'); ?></label>
				<input type="text" name="platform_link" class="form-control" placeholder="<?php echo get_phrase('enter_meeting_link'); ?>">
			</div>
      <div class="form-group">
				<label><?php echo get_phrase('note'); ?></label>
				<textarea type="text" id='note' name="note" class="form-control" rows=3 placeholder="<?php echo get_phrase('any_extra_note'); ?>"></textarea>
			</div>
        <div class="form-group">
            <label for="user_id"><?php echo get_phrase('users'); ?><span class="required">*</span> </label>
            <select class="server-side-select2 form-control" data-toggle="select2" data-placeholder="Choose ..." name="user_id[]" id="user_id" multiple="multiple" style='max-height:400px;min-height:200px;'>
                <?php $user_list = ($param2?$this->user_model->get_instructor():$this->user_model->get_all_user())->result_array();
                    foreach ($user_list as $user): ?>
                    <?php if(!($user['id']==$this->session->userdata('user_id'))):?>
                        <option value="<?php echo $user['id'] ?>" <?php if($user['id']==$param3) echo 'selected'; ?>> <?php echo $user['first_name'].' '.$user['last_name'].'('.$user['email'].')'; ?> </option>
                    <?php endif;?>
                <?php endforeach; ?>
            </select>
        </div>

      <div class="form-group">
          <button class="btn btn-primary float-right"><?php echo get_phrase('create_schedule'); ?></button>
      </div>

		</form>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        initSummerNote(['#note']);
    });
</script>
