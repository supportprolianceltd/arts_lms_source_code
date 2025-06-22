<?php
  $report_qa=$this->crud_model->fetch_report_qa(array('id'=>$param2))[0];
  $user=$report_qa['to_user']?$this->user_model->get_all_user($report_qa['to_user'])->row_array():[];
  if($report_qa):
?>
<div class="row">
	<div class="col-md-12">
		<form class="ajaxForms" action="<?= site_url("admin/report_qa/update/$param2"); ?>" method=post enctype="multipart/form-data">


      <div class="form-group">
				<label><?php echo get_phrase('topic'); ?><span class="required">*</span></label>
				<input type="text" name="title" class="form-control" value='<?php echo $report_qa['title'];?>' placeholder="<?php echo get_phrase('title'); ?>" required>
			</div>

      <div class="form-group">
				<label><?php echo get_phrase('remarks'); ?><span class="required">*</span></label>
				<textarea type="text" id='description' name="description" class="form-control" rows=3 placeholder="<?php echo get_phrase('remarks'); ?>" required> <?php echo $report_qa['description'];?></textarea>
			</div>

            <div class="form-group">
				<label><?php echo get_phrase('code'); ?></label>
				<input type="number" name="code" class="form-control" value='<?php echo $report_qa['code'];?>' placeholder="<?php echo get_phrase('optional'); ?>">
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
          <button class="btn btn-primary float-right"><?php echo get_phrase('edit_report'); ?></button>
      </div>

		</form>
	</div>
</div>
<?php else:?>
	<div class='alert alert-error'><i class='mdi mdi-bell-outline mr-1'></i>Report not found</div>
<?php endif;?>