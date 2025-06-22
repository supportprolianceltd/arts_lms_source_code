<?php
  $user=$param2?$this->user_model->get_all_user($param2)->row_array():[];
  $review_qa=$this->crud_model->fetch_review_qa(array('user_id'=>$this->session->userdata('user_id'),'to_user'=>$param2))[0];
  if($user || true):
?>
<div class="row">
	<div class="col-md-12">
		<form class="ajaxForms" action="<?= site_url("admin/review_qa/add/$param2"); ?>" method=post>

    <div class="form-group">
				<label><?php echo get_phrase('user'); ?><span class="required">*</span></label>
				<input type="text" name="user" class="form-control" value='<?php echo $user?$user['first_name'].' '.$user['last_name'].'('.$user['email'].')':''; ?>' placeholder="<?php echo get_phrase('user'); ?>" readonly>
			</div>
			<input type="hidden" name="to_user" class="form-control" value='<?=$param2?>'/>
      <div class="form-group">
				<label><?php echo get_phrase('review'); ?><span class="required">*</span></label>
				<textarea type="text" id='description' name="description" class="form-control" rows=3 placeholder="<?php echo get_phrase('review'); ?>" required> <?php echo $review_qa['description'];?></textarea>
			</div>

            <div class="form-group">
				<label><?php echo get_phrase('rating'); ?></label>
				<select required class="form-control select2" id="code" name="code" data-toggle="select2" data-allow-clear="true"  data-placeholder="<?php echo get_phrase('rating'); ?> " required>
              		<option value=''><?php echo get_phrase('choose_star_rating'); ?> </option>
              		<option value='1' <?php echo $review_qa['code']==1?'selected':null;?> >1 star</option>
					<option value='2' <?php echo $review_qa['code']==2?'selected':null;?> >2 star</option>
					<option value='3' <?php echo $review_qa['code']==3?'selected':null;?> >3 star</option>
					<option value='4' <?php echo $review_qa['code']==4?'selected':null;?> >4 star</option>
					<option value='5' <?php echo $review_qa['code']==5?'selected':null;?> >5 star</option>
				</select>
			</div>

      <div class="form-group">
          <button class="btn btn-primary float-right"><?php echo get_phrase('add_review'); ?></button>
      </div>

		</form>
	</div>
</div>
<?php else:?>
	<div class='alert alert-error'><i class='mdi mdi-bell-outline mr-1'></i>Review not found</div>
<?php endif;?>