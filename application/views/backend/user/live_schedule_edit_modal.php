<?php $schedule=$this->crud_model->get_live_schedule($param2);?>
<div class="row">
	<div class="col-md-12">
    <?php echo $schedule?null:"<div class='alert alert-error'><i class='mdi mdi-bell-outline mr-1'></i>Schedule not found</div>";?>
		<form class="ajaxForms <?php echo $schedule?null:'d-none';?>" action="<?= site_url("admin/live_schedule/update/$param2"); ?>" method=post>

    <div class="form-group">
      <label for="course_id"><?php echo get_phrase('event/course'); ?><span class="required">*</span> </label>
      <select class="select2 form-control" data-toggle="select2" data-placeholder="Choose ..." name="course_id" id="course_id" required>
          <option value="0"><?php echo get_phrase('schedule_event'); ?></option>
          <?php $course_list = $this->db->where('status', 'active')->or_where('status', 'private')->get('course')->result_array();
              foreach ($course_list as $course): ?>
              <option value="<?php echo $course['id'] ?>" <?php if($course['id']==$schedule['course_id']) echo 'selected'; ?>><?php echo $course['title']; ?></option>
          <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
				<label><?php echo get_phrase('title'); ?></label>
				<input type="text" name="title" class="form-control"  placeholder="<?php echo get_phrase('title_of_event'); ?>" value="<?php echo $schedule['title']; ?>">
			</div>

      <div class="mt-1 botder-top mb-2">
                                              
        <label><?php echo get_phrase('start_time').'(GMT)'; ?><span class="required">*</span></label>

          <div class="input-group">
              <input type="datetime-local" class="form-control"  id="start_time" name="start_time" value="<?php echo $schedule['start_time'];?>" required>
              <div class="input-group-append"> 
                  <span class="input-group-text"><i class="dripicons-clock"></i></span>
              </div>
          </div>
      </div>

      <div class="form-group">
        <label><?php echo get_phrase('duration(hrs)'); ?><span class="required">*</span></label>
        <select required class="form-control select2" id="duration" name="duration" data-toggle="select2" data-allow-clear="true"  data-placeholder="<?php echo get_phrase('duration'); ?> " >
              <option value="0"><?php echo get_phrase('Select Duration'); ?> </option>
              <option value='01:00' <?php echo $schedule['duration']=='01:00:00'?'selected':null;?> >1h:00</option>
              <option value='01:15' <?php echo $schedule['duration']=='01:15:00'?'selected':null;?> >1h:15</option>
              <option value='01:30' <?php echo $schedule['duration']=='01:30:00'?'selected':null;?> >1h:30</option>
              <option value='01:45' <?php echo $schedule['duration']=='01:45:00'?'selected':null;?> >1h:45</option>
              <option value='02:00' <?php echo $schedule['duration']=='02:00:00'?'selected':null;?> >2h:00</option>
              <option value='02:15' <?php echo $schedule['duration']=='02:15:00'?'selected':null;?> >2h:15</option>
              <option value='02:30' <?php echo $schedule['duration']=='02:30:00'?'selected':null;?> >2h:30</option>
              <option value='02:45' <?php echo $schedule['duration']=='02:45:00'?'selected':null;?> >2h:45</option>
              <option value='03:00' <?php echo $schedule['duration']=='03:00:00'?'selected':null;?> >3h:00</option>
              <option value='03:15' <?php echo $schedule['duration']=='03:15:00'?'selected':null;?> >3h:15</option>
              <option value='03:30' <?php echo $schedule['duration']=='03:30:00'?'selected':null;?> >3h:30</option>
              <option value='03:45' <?php echo $schedule['duration']=='03:45:00'?'selected':null;?> >3h:45</option>
              <option value='04:00' <?php echo $schedule['duration']=='04:00:00'?'selected':null;?> >4h:00</option>
              <option value='04:15' <?php echo $schedule['duration']=='04:15:00'?'selected':null;?> >4h:15</option>
              <option value='04:30' <?php echo $schedule['duration']=='04:30:00'?'selected':null;?> >4h:30</option>
              <option value='04:45' <?php echo $schedule['duration']=='04:45:00'?'selected':null;?> >4h:45</option>
              <option value='05:00' <?php echo $schedule['duration']=='05:00:00'?'selected':null;?> >5h:00</option>
              <option value='05:15' <?php echo $schedule['duration']=='05:15:00'?'selected':null;?> >5h:15</option>
              <option value='05:30' <?php echo $schedule['duration']=='05:30:00'?'selected':null;?> >5h:30</option>
              <option value='05:45' <?php echo $schedule['duration']=='05:45:00'?'selected':null;?> >5h:45</option>
              <option value='06:00' <?php echo $schedule['duration']=='06:00:00'?'selected':null;?> >6h:00</option>
          </select>
      </div>
      <div class="form-group">
				<label><?php echo get_phrase('platform'); ?></label>
				<input type="text" name="platform" class="form-control" placeholder="<?php echo get_phrase('enter_platform_name_e.g_zoom'); ?>" value="<?php echo $schedule['platform'];?>">
			</div>
      <div class="form-group">
				<label><?php echo get_phrase('platform_link'); ?></label>
				<input type="text" name="platform_link" class="form-control" placeholder="<?php echo get_phrase('enter_meeting_link'); ?>" value="<?php echo $schedule['platform_link'];?>">
			</div>
      <div class="form-group">
				<label><?php echo get_phrase('note'); ?></label>
				<textarea type="text" id='note' name="note" class="form-control" rows=3 placeholder="<?php echo get_phrase('any_extra_note'); ?>"><?php echo $schedule['note'];?></textarea>
			</div>

      <div class="form-group">
          <button class="btn btn-primary float-right"><?php echo get_phrase('edit_schedule'); ?></button>
      </div>

		</form>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        initSummerNote(['#note']);
    });
</script>
