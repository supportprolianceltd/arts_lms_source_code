<?php $schedule=$this->crud_model->get_live_schedule($param2);?>
<div class="row">
	<div class="col-md-12">
    <?php echo $schedule?null:"<div class='alert alert-error'><i class='mdi mdi-bell-outline mr-1'></i>Schedule not found</div>";?>
		<form class="ajaxForms <?php echo $schedule?null:'d-none';?>" action="<?= site_url('admin/live_schedule/update/$param2/1'); ?>" method=post>

      <div class="form-group">
				<label><?php echo get_phrase('Pre-recorded video html5 url'); ?></label>
				<input type="text" name="platform_record_link" class="form-control" placeholder="<?php echo get_phrase('enter_html5_video_url'); ?>" value="<?php echo $schedule['platform_record_link'];?>">
			</div>

      <div class="form-group">
          <button class="btn btn-primary float-right"><?php echo get_phrase('edit_schedule'); ?></button>
      </div>

		</form>
	</div>
</div>