<?php
$status_wise_courses = $this->crud_model->get_status_wise_courses();
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu left-side-menu-detached">
	<div class="leftbar-user">
		<a href="javascript: void(0);">
			<img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="user-image" height="42" class="rounded-circle shadow-sm">
			<?php
			$user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
			?>
			<span class="leftbar-user-name"><?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></span>
		</a>
	</div>

	<!--- Sidemenu -->
	<ul class="metismenu side-nav side-nav-light">

		<li class="side-nav-title side-nav-item"><?php echo get_phrase('navigation'); ?></li>
		<?php if (get_settings('allow_instructor') == 1) : ?>
			<?php if ($this->session->userdata('is_instructor')) : ?>
				<li class="side-nav-item">
					<a href="<?php echo site_url('user/dashboard'); ?>" class="side-nav-link <?php if ($page_name == 'dashboard') echo 'active'; ?>">
						<i class="dripicons-view-apps"></i>
						<span><?php echo get_phrase('dashboard'); ?></span>
					</a>
				</li>
				<li class="side-nav-item">
					<a href="<?php echo site_url('user/courses'); ?>" class="side-nav-link <?php if ($page_name == 'courses' || $page_name == 'course_add' || $page_name == 'course_edit') echo 'active'; ?>">
						<i class="dripicons-archive"></i>
						<span><?php echo get_phrase('course_manager'); ?></span>
					</a>
				</li>
				<li class="side-nav-item">
					<a href="<?php echo site_url('user/live_schedule'); ?>" class="side-nav-link <?php if ($page_name == 'live_schedule') echo 'active'; ?>">
						<i class="mdi mdi-video-vintage"></i>
						<span><?php echo get_phrase('live_schedule'); ?></span>
					</a>
				</li>

				<?php if (addon_status('bootcamp') && $this->session->userdata('is_instructor') == 1) : ?>
			        <li class="side-nav-item <?php if ($page_name == 'bootcamp/live_classes' || $page_name == 'bootcamp/bootcamp_form' || $page_name == 'bootcamp/payment_invoice') : ?> active <?php endif; ?>">
			            <a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'bootcamp/live_classes' ) : ?> active <?php endif; ?>">
			                <i class="dripicons-user-group"></i>
			                <span> <?php echo get_phrase('bootcamp'); ?> </span>
			                <span class="menu-arrow"></span>
			            </a>
			            <ul class="side-nav-second-level" aria-expanded="false">

			                <!-- live class -->
			                <li class="<?php if ($page_name == 'bootcamp/live_classes') echo 'active'; ?>">
			                    <a href="<?php echo site_url('addons/bootcamp/live_classes'); ?>"><?php echo get_phrase('live_class'); ?></a>
			                </li>

			                <!-- add bootcamp -->
			                <li class="<?php if ($page_name == 'bootcamp/bootcamp_form') echo 'active'; ?>">
			                    <a href="<?php echo site_url('addons/bootcamp/action/form'); ?>"><?php echo get_phrase('bootcamp_form'); ?></a>
			                </li>

			                <!-- payment -->
			                <li class="<?php if ($page_name == 'bootcamp/payment_report' || $page_name == 'bootcamp/payment_invoice') echo 'active'; ?>">
			                    <a href="<?php echo site_url('addons/bootcamp/payment_report'); ?>"><?php echo get_phrase('payment'); ?></a>
			                </li>
			            </ul>
			        </li>
		        <?php endif; ?>

		        <!-- team training start -->
				<?php if (addon_status('team_training')) : ?>
					<li class="side-nav-item">
						<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'team_packages' ||$page_name == 'team_package_add' || $page_name == 'team_package_edit'  || $page_name == 'team_package_purchase_history' || $page_name == 'teams-server-side' || $page_name == 'team-details-page') : ?> active <?php endif; ?>">
							<i class="dripicons-document"></i>
							<span> <?php echo get_phrase('team_training'); ?> </span>
							<span class="menu-arrow"></span>
						</a>
						<ul class="side-nav-second-level <?php if ($page_name == 'team_packages' ||$page_name == 'team_package_add' || $page_name == 'team_package_edit'  || $page_name == 'team_package_purchase_history' || $page_name == 'teams-server-side' || $page_name == 'team-details-page') echo 'in'; ?>" aria-expanded="false">
							<li class="<?php if ($page_name == 'team_packages' ) echo 'active'; ?>">
								<a href="<?php echo site_url('addons/team_training/team_packages'); ?>"><?php echo get_phrase('manage_packages'); ?></a>
							</li>
							<li class="<?php if ($page_name == 'team_package_add' ) echo 'active'; ?>">
								<a href="<?php echo site_url('addons/team_training/team_package_form/add_team_package_form'); ?>"><?php echo get_phrase('add_new_package'); ?></a>
							</li>


							<li class="<?php if ($page_name == 'team_package_purchase_history') echo 'active'; ?>">
								<a href="<?php echo site_url('addons/team_training/purchase_history'); ?>"><?php echo get_phrase('sales_report'); ?></a>
							</li>

							<li class="<?php if ($page_name == 'teams-server-side' || $page_name == 'team-details-page') echo 'active'; ?>">
								<a href="<?php echo site_url('addons/team_training/teams_list'); ?>"><?php echo get_phrase('teams'); ?></a>
							</li>

						</ul>
					</li>
				<?php endif; ?>
				<!-- team training end -->

				<?php if (addon_status('ebook')) : ?>
					<li class="side-nav-item">
						<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'all_ebooks' || $page_name == 'add_ebook' || $page_name == 'ebook_edit') : ?> active <?php endif; ?>">
							<i class="dripicons-document"></i>
							<span> <?php echo get_phrase('ebook'); ?> </span>
							<span class="menu-arrow"></span>
						</a>
						<ul class="side-nav-second-level <?php if ($page_name == 'ebook_edit') echo 'in'; ?>" aria-expanded="false">
							<li class="<?php if ($page_name == 'all_ebooks' || $page_name == 'ebook_edit') echo 'active'; ?>">
								<a href="<?php echo site_url('addons/ebook_manager/ebook'); ?>"><?php echo get_phrase('all_ebooks'); ?></a>
							</li>
							<li class="<?php if ($page_name == 'add_ebook') echo 'active'; ?>">
								<a href="<?php echo site_url('ebook_manager/add_ebook'); ?>"><?php echo get_phrase('add_ebook'); ?></a>
							</li>
							<li class="<?php if ($page_name == 'ebook_instructor_revenue') echo 'active'; ?>">
								<a href="<?php echo site_url('addons/ebook_manager/payment_history/instructor_revenue'); ?>"><?php echo get_phrase('sales_report'); ?></a>
							</li>
						</ul>
					</li>
				<?php endif; ?>


				<?php if (addon_status('tutor_booking') && $this->session->userdata('is_instructor')==1) : ?>
					<li class="side-nav-item">
					<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'tutor_inactive_booking_list' ||$page_name == 'tutor_schedule_list' || $page_name == 'tutor_inactive_schedule_list'  || $page_name == 'tutor_live_class_settings' || $page_name == 'booked_schedule_details' ||$page_name == 'tutor_caregories' || $page_name == 'add_schedule' || $page_name == 'tutor_booking_list') : ?> active <?php endif; ?>">
							<i class="dripicons-document"></i>
							<span> <?php echo get_phrase('tutor_booking'); ?> </span>
							<span class="menu-arrow"></span>
						</a>
						<ul class="side-nav-second-level <?php if ($page_name == 'tutor_inactive_booking_list' ||$page_name == 'tutor_schedule_list' || $page_name == 'tutor_inactive_schedule_list'  || $page_name == 'tutor_live_class_settings' || $page_name == 'booked_schedule_details' ||$page_name == 'tutor_caregories' || $page_name == 'add_schedule' || $page_name == 'tutor_booking_list') echo 'in'; ?>" aria-expanded="false">
						
							<li class="<?php if ($page_name == 'add_schedule') echo 'active'; ?>">
								<a href="<?php echo site_url('addons/tutor_booking/schedule'); ?>"><?php echo get_phrase('add_booking'); ?></a>
							</li>

							<li class="<?php if ($page_name == 'tutor_booking_list' || $page_name == 'tutor_inactive_booking_list' ||$page_name == 'tutor_schedule_list' || $page_name == 'tutor_inactive_schedule_list') echo 'active'; ?>">
								<a href="<?php echo site_url('addons/tutor_booking/tutor_booking_list'); ?>"><?php echo get_phrase('All Bookings'); ?></a>
							</li>

							<li class="<?php if ($page_name == 'booked_schedule_details') echo 'active'; ?>">
								<a href="<?php echo site_url('addons/tutor_booking/booked_schedules'); ?>"><?php echo get_phrase('Student bookings'); ?></a>
							</li>

						</ul>
					</li>
				<?php endif; ?>
		
				<li class="side-nav-item d-none">
					<a href="<?php echo site_url('user/sales_report'); ?>" class="side-nav-link <?php if ($page_name == 'report' || $page_name == 'invoice') echo 'active'; ?>">
						<i class="dripicons-to-do"></i>
						<span><?php echo get_phrase('sales_report'); ?></span>
					</a>
				</li>
				<li class="side-nav-item d-none">
					<a href="<?php echo site_url('user/payout_report'); ?>" class="side-nav-link <?php if ($page_name == 'payout_report' || $page_name == 'invoice') echo 'active'; ?>">
						<i class="dripicons-shopping-bag"></i>
						<span><?php echo get_phrase('payout_report'); ?></span>
					</a>
				</li>
				<li class="side-nav-item d-none">
					<a href="<?php echo site_url('user/payout_settings'); ?>" class="side-nav-link <?php if ($page_name == 'payment_settings') echo 'active'; ?>">
						<i class="dripicons-gear"></i>
						<span><?php echo get_phrase('payout_settings'); ?></span>
					</a>
				</li>
			<?php else : ?>
				<li class="side-nav-item d-none">
					<a href="<?php echo site_url('user/become_an_instructor'); ?>" class="side-nav-link <?php if ($page_name == 'become_an_instructor') echo 'active'; ?>">
						<i class="dripicons-archive"></i>
						<span><?php echo get_phrase('become_an_instructor'); ?></span>
					</a>
				</li>

			
			<?php endif; ?>
		<?php endif; ?>

		<?php if (addon_status('live-class')) : ?>
			<li class="side-nav-item <?php if ($page_name == 'zoom_live_class_settings') echo 'active'; ?>">
				<a href="<?php echo site_url('addons/liveclass/settings'); ?>" class="side-nav-link">
					<i class="mdi mdi-video-vintage"></i>
					<span><?php echo get_phrase('Zoom live settings'); ?></span>
				</a>
			</li>
		<?php endif; ?>


		<?php if (get_frontend_settings('instructors_blog_permission') && $this->session->userdata('is_instructor')) : ?>
			<li class="side-nav-item <?php if ($page_name == 'blog' || $page_name == 'blog_add' || $page_name == 'blog_edit' || $page_name == 'instructors_pending_blog') : ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'blog' || $page_name == 'blog_add' || $page_name == 'blog_edit' || $page_name == 'instructors_pending_blog') : ?> active <?php endif; ?>">
					<i class="dripicons-blog"></i>
					<span> <?php echo get_phrase('blog'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class="<?php if ($page_name == 'blog') echo 'active'; ?>">
						<a href="<?php echo site_url('user/blog'); ?>"><?php echo get_phrase('all_blogs'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'instructors_pending_blog') echo 'active'; ?>">
						<a href="<?php echo site_url('user/pending_blog'); ?>"><?php echo get_phrase('pending_blog'); ?> <span class="badge badge-danger-lighten"><?php echo $this->crud_model->get_instructors_pending_blog()->num_rows(); ?></span></a>
					</li>
				</ul>
			</li>
		<?php endif; ?>


		<?php if (addon_status('customer_support')) : ?>
			<li class="side-nav-item <?php if ($page_name == 'tickets' || $page_name == 'create_ticket') : ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link">
					<i class="dripicons-help"></i>
					<span> <?php echo get_phrase('support'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class="<?php if ($page_name == 'tickets') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/customer_support/user_tickets'); ?>"><?php echo get_phrase('ticket_list'); ?></a>
					</li>
					<li class="<?php if ($page_name == 'create_ticket') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/customer_support/create_support_ticket'); ?>"><?php echo get_phrase('create_ticket'); ?></a>
					</li>
				</ul>
			</li>
		<?php endif; ?>

		<?php //course_addon start
		if (addon_status('affiliate_course') ) :
			$CI    = &get_instance();
			$CI->load->model('addons/affiliate_course_model');
			$x = $CI->affiliate_course_model->is_affilator($this->session->userdata('user_id'));

			if ($x == 0  && get_settings('affiliate_addon_active_status')==1) : ?>

				<li class="side-nav-item">
					<a href="<?php echo site_url('addons/affiliate_course/become_an_affiliator'); ?>" class="side-nav-link <?php if ($page_name == 'become_an_affiliator') echo 'active'; ?>">
						<i class="dripicons-archive"></i>
						<span><?php echo get_phrase('become_an_affiliator'); ?></span>
					</a>
				</li>
			<?php elseif($x==1) : ?>
				<li class="side-nav-item">
					<a href="<?php echo site_url('addons/affiliate_course/become_an_affiliator'); ?>" class="side-nav-link <?php if ($page_name == 'become_an_affiliator') echo 'active'; ?>">
						<i class="dripicons-archive"></i>
						<span><?php echo get_phrase('Affiliation Status'); ?></span>
					</a>
				</li>

				<li class="side-nav-item">
					<a href="<?php echo site_url('addons/affiliate_course/affiliate_course_history '); ?>" class="side-nav-link <?php if ($page_name == 'become_an_affiliator')  ?>">
						<i class="dripicons-archive"></i>
						<span><?php echo get_phrase('Affiliation History'); ?></span>
					</a>
				</li>
				<?php elseif($x==2): ?>
					<li class="side-nav-item">
					<a href="<?php echo site_url('addons/affiliate_course/become_an_affiliator'); ?>" class="side-nav-link <?php if ($page_name == 'become_an_affiliator') echo 'active'; ?>">
						<i class="dripicons-archive"></i>
						<span><?php echo get_phrase('Affiliation Status'); ?></span>
					</a>
				</li>


			<?php endif; ?>
		<?php endif;
		//course_addon end 
		?>

		<li class="side-nav-item">
			<a href="<?php echo site_url('user/message'); ?>" class="side-nav-link">
				<i class="dripicons-mail"></i>
				<span><?php echo get_phrase('message'); ?></span>
				<?php
				$this->db->where('message_thread.receiver', $this->session->userdata('user_id'));
				$this->db->where('message.sender !=', $this->session->userdata('user_id'));
				$this->db->where('message.read_status', 0);
				$this->db->from('message_thread');
				$this->db->join('message', 'message_thread.message_thread_code = message.message_thread_code');
				$unreaded_message = $this->db->get()->num_rows();
				?>
				<?php if ($unreaded_message > 0) : ?>
					<span class="badge badge-danger-lighten float-right"><?php echo $unreaded_message; ?></span>
				<?php endif; ?>
			</a>
		</li>


		<li class="side-nav-item">
			<a href="<?php echo site_url('home/profile/user_profile'); ?>" class="side-nav-link">
				<i class="dripicons-user"></i>
				<span><?php echo get_phrase('manage_profile'); ?></span>
			</a>
		</li>


	</ul>
</div>
