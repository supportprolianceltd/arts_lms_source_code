<input type="hidden" name="lesson_type" value="system-video">
<input type="hidden" name="lesson_provider" value="system_video">

<div class="form-group">
    <label> <?php echo get_phrase('upload_system_video_file'); ?></label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="system_video_file" name="system_video_file" onchange="changeTitleOfImageUploader(this)">
            <label class="custom-file-label" for="system_video_file"><?php echo get_phrase('select_system_video_file'); ?></label>
        </div>
    </div>
    <small class="badge badge-primary"><?php echo 'maximum_upload_size'; ?>: <?php echo ini_get('upload_max_filesize'); ?></small>
    <small class="badge badge-primary"><?php echo 'post_max_size'; ?>: <?php echo ini_get('post_max_size'); ?></small>
    <small class="badge badge-secondary"><?php echo '"post_max_size" '.get_phrase("has_to_be_bigger_than").' "upload_max_filesize"'; ?></small>
</div>
<div class="form-group">
    <label><?php echo get_phrase('duration'); ?></label>
    <input type="text" class="form-control" data-toggle='timepicker' data-minute-step="5" name="system_video_file_duration" id = "system_video_file_duration" data-show-meridian="false" value="<?php echo $lesson_details['duration']; ?>" required>
</div>
<?php 
if($lesson_details['video_type'] == 'system'):?>
    <div class='card'>
        <div class='card-header'><?php echo get_phrase('lesson_video');?></div>
        <video class='w-100' width="100%" height="200" playsinline controls>
            <source src="<?php echo base_url('files?course_id='.$param3.'&lesson_id='.$param2);?>" type="video/<?php echo get_video_extension($lesson_details['video_url']); ?>">
            Your browser does not support the video tag.
        </video>
    </div>
<?php endif;?>
<div class="form-group">
    <label><?php echo get_phrase('caption'); ?>( <?php echo get_phrase('.vtt'); ?> )</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="caption" name="caption" onchange="changeTitleOfImageUploader(this)" accept=".vtt">
            <label class="custom-file-label" for="caption"><?php echo get_phrase('choose_your_caption_file'); ?></label>
        </div>
    </div>
</div>