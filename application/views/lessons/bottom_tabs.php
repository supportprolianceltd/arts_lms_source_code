<?php
 $user_review=$this->db->get_where('rating', array('ratable_type' => 'course', 'ratable_id' => $course_details['id'],'user_id'=>$user_id))->row_array();
 $selected_star_rating[$user_review['rating']]='selected';
 echo <<<HTML
  <section id="rateContainer" class="rate-dropdown">
    <div class="rate-dropdown-box">
      <div class="rate-header">
      <h2>Drop a Review</h2>
      <button id="hideRateButton"><i class="fas fa-times"></i></button>
    </div>
      <form class="rate-form">
        <div class="rate-input">
          <label>Rate</label>
          <select id='course_star_rating_input'>
            <option value='0' disabled>---select star number---</option>
            <option value='1' {$selected_star_rating[1]}>1 Star</option>
            <option value='2' {$selected_star_rating[2]}>2 Stars</option>
            <option value='3' {$selected_star_rating[3]}>3 Stars</option>
            <option value='4' {$selected_star_rating[4]}>4 Stars</option>
            <option value='5' {$selected_star_rating[5]}>5 Star</option>
          </select>
        </div>

        <div class="rate-input">
          <label>Drop a Review</label>
          <textarea id='course_review_input' placeholder="Message">{$user_review['review']}</textarea>
        </div>

          <div class="rate-input">
            <input type="button" value="Submit" onclick='publishCourseRating({$course_details['id']})'/>
            </div>
      </form>
    </div>
  </section>
HTML;
?>

<style>
        #toggleSection {
      padding: 10px;
      background-color: #EFF2F6;
      margin-top: 10px;
      border: 1px solid #ccc;
    }
    
    #summary-icon{
        margin-left:5px;
        font-size:13px !important;
    }

    
</style>

<ul class="nav nav-tabs ct-tabs-custom-one player-bottom-tabs mt-3" role="tablist">

	<?php if (isset($lesson_details) && is_array($lesson_details) && count($lesson_details) > 0) : ?>
	<?php if (addon_status('assignment')) : ?>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="assignment-tab" data-bs-toggle="tab" data-bs-target="#assignment-content" type="button" role="tab" aria-controls="assignment-content" aria-selected="true">
				<i class="fab fa-wpforms"></i>
				<?php echo get_phrase('Assignment'); ?>
				<span></span>
			</button>
		</li>
	<?php endif ?>
		<li class="nav-item" role="presentation">

			<button class="nav-link" id="summary-class-tab" data-bs-toggle="tab" data-bs-target="#summary-class-content" type="button" role="tab" aria-controls="summary-class-content" aria-selected="true">

				<?php echo get_phrase('Summary'); ?>
			    <i id="summary-icon" class="fas fa-angle-down"></i>
				<span></span>
			</button>

		</li>
	<?php endif; ?>

	<li class="nav-item d-none" role="presentation">
		<button class="nav-link" id="live-class-tab" data-bs-toggle="tab" data-bs-target="#live-class-content" type="button" role="tab" aria-controls="live-class-content" aria-selected="true">
			<i class="fas fa-video"></i>
			<?php echo get_phrase('Live class'); ?>
			<span></span>
		</button>
	</li>
	<?php if (addon_status('forum')) : ?>
		<li class="nav-item" role="presentation">
			<button class="nav-link" onclick="load_questions('<?= $course_id; ?>')" id="forum-tab" data-bs-toggle="tab" data-bs-target="#forum-content" type="button" role="tab" aria-controls="forum-content" aria-selected="true">
				<i class="far fa-comments"></i>
				<?php echo get_phrase('Forum'); ?>
				<span></span>
			</button>
		</li>
	<?php endif ?>
	<?php if (addon_status('noticeboard')) : ?>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="noticeboard-tab" onclick="load_course_notices('<?= $course_id; ?>')" data-bs-toggle="tab" data-bs-target="#noticeboard-content" type="button" role="tab" aria-controls="noticeboard-content" aria-selected="true">
				<i class="far fa-bell"></i>
				<?php echo get_phrase('Noticeboard'); ?>
				<span></span>
			</button>
		</li>
	<?php endif ?>
	<?php if (addon_status('certificate')) : ?>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="certificate-tab" onclick="actionTo('<?php echo site_url('addons/certificate/certificate_progress/' . $course_details['id']); ?>')" data-bs-toggle="tab" data-bs-target="#certificate-content" type="button" role="tab" aria-controls="certificate-content" aria-selected="true">
				<i class="fas fa-graduation-cap"></i>
				<?php echo get_phrase('Certificate'); ?>
				<span></span>
			</button>
		</li>
	<?php endif ?>
	<li class="nav-item d-none" role="presentation">
        <a href="javascript:void(0);" id="showRateButton" class='btn btn-secondary'><i class="ti-star"></i> Drop a Review</a>
	</li>
</ul>

<div class="Summmm-Polas" id="toggleSection">
<div class="tab-content ct-tabs-content">
	<?php if (isset($lesson_details) && is_array($lesson_details) && count($lesson_details) > 0) : ?>
		<div class="tab-pane fade" id="summary-class-content" role="tabpanel" aria-labelledby="summary-class-tab">


			<?php $resource_files = $this->db->order_by('id', 'desc')->where('lesson_id', $lesson_details['id'])->get('resource_files')->result_array(); ?>
			<?php if (is_array($resource_files) && count($resource_files) > 0) : ?>
				<div class="row mb-4">
					<div class="col-auto">
						<h6 class="text-dark pt-2"><?php echo get_phrase('Attached Files'); ?>:</h6>
					</div>
					<?php foreach ($resource_files as $resource_file) : ?>
						<?php if ($resource_file['file_name']) : ?>
							<div class="col-auto">
								<a class="btn p-1" href="<?php echo base_url('uploads/resource_files/' . $resource_file['file_name']); ?>" download>
									<span class="mr-auto"><?php echo $resource_file['title']; ?></span>
									<i class="fas fa-download"></i>
								</a>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<?php echo htmlspecialchars_decode_($lesson_details['summary']); ?>
		</div>
	<?php endif; ?>

	<div class="tab-pane fade" id="live-class-content" role="tabpanel" aria-labelledby="live-class-tab">
		
		<!-- BigBlueButton -->
				
		<?php $live_class_scheduled = 0; ?>
		<?php $bbb_meeting = $this->db->where('course_id', $course_id)->get('bbb_meetings');
		if ($bbb_meeting->num_rows() > 0) :
			$live_class_scheduled = 1;
			$bbb_meeting = $bbb_meeting->row_array(); ?>
			<div class="live_class">
				<i class="fa fa-calendar-check"></i> <?php echo get_phrase('BigBlueButton live class schedule'); ?>
				<div class="py-4">
					<?php echo $bbb_meeting['instructions']; ?>
				</div>
				<a href="<?php echo site_url('user/join_bbb_meeting/'.$course_id); ?>" target="_blank" class="btn btn_zoom">
					<i class="fa fa-video"></i>&nbsp;
					<?php echo get_phrase('join_live_class'); ?>
				</a>
			</div>
			<hr>
		<?php endif; ?>


		<?php if (addon_status('live-class')) : ?>
			<?php $live_class = $this->db->get_where('live_class', array('course_id' => $course_id));
			if ($live_class->num_rows() > 0) :
				$live_class_scheduled = 1;
				$live_class = $this->db->get_where('live_class', array('course_id' => $course_id))->row_array(); ?>
				<div class="live_class">
					<i class="fa fa-calendar-check"></i> <?php echo get_phrase('zoom_live_class_schedule'); ?>
					<h5 style="margin-top: 20px;"><?php echo date('h:i A', $live_class['time']); ?> : <?php echo date('D, d M Y', $live_class['date']); ?></h5>
					<div class="live_class_note">
						<?php echo $live_class['note_to_students']; ?>
					</div>
					<a href="<?php echo site_url('addons/liveclass/join/' . $lesson_details['course_id']); ?>" class="btn btn_zoom">
						<i class="fa fa-video"></i>&nbsp;
						<?php echo get_phrase('join_live_video_class'); ?>
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php if (addon_status('live-class') && addon_status('jitsi-live-class')) echo '<hr>'; ?>

		<?php if (addon_status('jitsi-live-class')) : ?>
			<?php $live_class = $this->db->get_where('jitsi_live_class', array('course_id' => $course_id));
			if ($live_class->num_rows() > 0) :
				$live_class_scheduled = 1;
				$live_class = $live_class->row_array(); ?>
				<div class="live_class">
					<i class="fa fa-calendar-check"></i> <?php echo get_phrase('jitsi_live_class_schedule'); ?>
					<h5 style="margin-top: 20px;"><?php echo date('h:i A', $live_class['time']); ?> : <?php echo date('D, d M Y', $live_class['date']); ?></h5>
					<div class="live_class_note">
						<?php echo $live_class['note_to_students']; ?>
					</div>
					<a target="_blank" href="<?php echo site_url('addons/jitsi_liveclass/join/' . $course_id); ?>" class="btn btn_zoom">
						<i class="fa fa-video"></i>&nbsp;
						<?php echo get_phrase('join_live_video_class'); ?>
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php if(!$live_class_scheduled): ?>
			<div class="alert alert-warning" role="alert" style="padding: 30px 0px;">
				<?php echo get_phrase('live_class_is_not_scheduled_yet'); ?>
			</div>
		<?php endif; ?>

	</div>

	<?php if (addon_status('assignment')) : ?>
		<div class="tab-pane fade" id="assignment-content" role="tabpanel" aria-labelledby="assignment-tab">
			<?php include 'assignment_body.php'; ?>
		</div>
	<?php endif; ?>

	<?php if (addon_status('forum')) : ?>
		<div class="tab-pane fade" id="forum-content" role="tabpanel" aria-labelledby="forum-tab"></div>
	<?php endif; ?>

	<?php if (addon_status('noticeboard')) : ?>
		<div class="tab-pane fade" id="noticeboard-content" role="tabpanel" aria-labelledby="noticeboard-tab"></div>
	<?php endif; ?>

	<?php if (addon_status('certificate')) : ?>
		<div class="tab-pane fade" id="certificate-content" role="tabpanel" aria-labelledby="certificate-tab"></div>
	<?php endif; ?>
</div>
</div>


<?php if (addon_status('forum')) : ?>
	<?php include 'course_forum_scripts.php'; ?>
<?php endif; ?>
<?php if (addon_status('noticeboard')) : ?>
	<?php include 'noticeboard_scripts.php'; ?>
<?php endif; ?>

<script>
	$(function() {
		setTimeout(function() {
			$('.player-bottom-tabs li:first button').trigger('click');
			$($('.player-bottom-tabs li:first button').attr('data-bs-target')).addClass('show');
		}, 300);
	});
</script>






<script>
  // Get elements
  const toggleButton = document.getElementById("summary-class-tab");
  const toggleSection = document.getElementById("toggleSection");
  const summaryIcon = document.getElementById("summary-icon");

  let isVisible = true;

  toggleButton.addEventListener("click", function () {
    isVisible = !isVisible;
    if (isVisible) {
      toggleSection.style.display = "block";
      summaryIcon.classList.remove("fa-angle-up");
      summaryIcon.classList.add("fa-angle-down");
    } else {
      toggleSection.style.display = "none";
      summaryIcon.classList.remove("fa-angle-down");
      summaryIcon.classList.add("fa-angle-up");
    }
  });

  // Optional: Hide on page load if you want the section collapsed by default
  // toggleSection.style.display = "none";
  // isVisible = false;
  
  
  
  
  
  
  
  
  
  document.addEventListener("DOMContentLoaded", function () {
  const summaryTabButton = document.getElementById("summary-class-tab");
  const summaryContent = document.getElementById("summary-class-content");

  summaryTabButton.addEventListener("click", function () {
    // Add a small delay to wait for the tab content to become visible
    setTimeout(() => {
      if (summaryContent) {
        summaryContent.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    }, 300);
  });
});


</script>





