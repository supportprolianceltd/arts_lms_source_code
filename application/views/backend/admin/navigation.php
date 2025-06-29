<?php
$status_wise_courses = $this->crud_model->get_status_wise_courses();
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu left-side-menu-detached">
	<div class="leftbar-user">
		<a href="javascript: void(0);">
			<img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="user-image" height="42" class="rounded-circle shadow-sm">
			<?php
			$admin_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
			?>
			<span class="leftbar-user-name"><?php echo $admin_details['first_name'] . ' ' . $admin_details['last_name']; ?></span>
		</a>
	</div>

	<!--- Sidemenu -->
	<ul class="metismenu side-nav side-nav-light">

		<li class="side-nav-title side-nav-item"><?php echo get_phrase('navigation'); ?></li>

		<li class="side-nav-item <?php if ($page_name == 'dashboard') echo 'active'; ?>">
			<a href="<?php echo site_url('admin/dashboard'); ?>" class="side-nav-link">
				<i class="dripicons-view-apps"></i>
				<span><?php echo get_phrase('dashboard'); ?></span>
			</a>
		</li>

		<?php if (has_permission('course')) : ?>
			<li class="side-nav-item <?php if ($page_name == 'courses' || $page_name == 'course_add' || $page_name == 'course_edit' || $page_name == 'categories' || $page_name == 'category_add' || $page_name == 'category_edit' || $page_name == 'coupons' || $page_name == 'coupon_add' || $page_name == 'coupon_edit' || $page_name == 'add_bundle' || $page_name == 'manage_course_bundle' || $page_name == 'edit_bundle' || $page_name == 'active_bundle_subscription_report' || $page_name == 'expire_bundle_subscription_report' || $page_name == 'bundle_invoice') echo 'active'; ?>">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'courses' || $page_name == 'course_add' || $page_name == 'course_edit' || $page_name == 'categories' || $page_name == 'category_add' || $page_name == 'category_edit' || $page_name == 'coupons' || $page_name == 'coupon_add' || $page_name == 'coupon_edit') : ?> active <?php endif; ?>">
					<i class="dripicons-archive"></i>
					<span> <?php echo get_phrase('courses'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<?php if (has_permission('course')) : ?>
						<li class="<?php if ($page_name == 'courses' || $page_name == 'course_edit') echo 'active'; ?>">
							<a href="<?php echo site_url('admin/courses'); ?>"><?php echo get_phrase('manage_courses'); ?></a>
						</li>
					<?php endif; ?>

					<?php if (has_permission('course')) : ?>
						<li class="<?php if ($page_name == 'course_add') echo 'active'; ?>">
							<a href="<?php echo site_url('admin/course_form/add_course'); ?>"><?php echo get_phrase('add_new_course'); ?></a>
						</li>
									<li class="<?php if ($page_name == 'rating') echo 'active'; ?>">
										<a href="<?php echo site_url('admin/rating'); ?>" class="">
											<?php echo get_phrase('rating'); ?>
										</a>
									</li>
					<?php endif; ?>

					<?php if (has_permission('category')) : ?>
						<li class="<?php if ($page_name == 'categories' || $page_name == 'category_add' || $page_name == 'category_edit') echo 'active'; ?>">
							<a href="<?php echo site_url('admin/categories'); ?>"><?php echo get_phrase('course_category'); ?></a>
						</li>
					<?php endif; ?>
					<?php if (1==0 && has_permission('coupon')) : ?>
						<li class="<?php if ($page_name == 'coupons' || $page_name == 'coupon_add' || $page_name == 'coupon_edit') echo 'active'; ?>">
							<a href="<?php echo site_url('admin/coupons'); ?>">
								<?php echo get_phrase('coupons'); ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if (addon_status('course_bundle')) : ?>
						<li class="side-nav-item">
							<a href="javascript: void(0);" aria-expanded="false"><?php echo get_phrase('course_bundle'); ?>
								<span class="menu-arrow"></span>
							</a>
							<ul class="side-nav-third-level" aria-expanded="false">
								<li class="<?php if ($page_name == 'add_bundle') echo 'active'; ?>">
									<a href="<?php echo site_url('addons/bundle/add_bundle_form'); ?>"><?php echo get_phrase('add_new_bundle'); ?></a>
								</li>
								<li class="<?php if ($page_name == 'manage_course_bundle') echo 'active'; ?>">
									<a href="<?php echo site_url('addons/bundle/manage_bundle'); ?>"><?php echo get_phrase('manage_bundle'); ?></a>
								</li>
								<li class="<?php if ($page_name == 'active_bundle_subscription_report' || $page_name == 'expire_bundle_subscription_report' || $page_name == 'bundle_invoice') echo 'active'; ?>">
									<a href="<?php echo site_url('addons/bundle/subscription_report/active'); ?>"><?php echo get_phrase('subscription_report'); ?></a>
								</li>
							</ul>
						</li>
					<?php endif; ?>
				</ul>
			</li>
		<?php endif; ?>

		<!-- bootcamp addon -->
		<?php if (addon_status('bootcamp')) : ?>
			<li class="side-nav-item <?php if ($page_name == 'bootcamp_list' || $page_name == 'bootcamp_form' || $page_name == 'bootcamp_payment_invoice') : ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'bootcamp_form' || $page_name == 'bootcamp_list' || $page_name == 'bootcamp_payment_invoice') : ?> active <?php endif; ?>">
					<i class="dripicons-user-group"></i>
					<span> <?php echo get_phrase('bootcamp'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">

					<!-- live class -->
					<li class="<?php if ($page_name == 'bootcamp_live_classes') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/bootcamp/list'); ?>"><?php echo get_phrase('bootcamp_list'); ?></a>
					</li>

					<!-- add bootcamp -->
					<li class="<?php if ($page_name == 'bootcamp_bootcamp_form') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/bootcamp/action/form'); ?>"><?php echo get_phrase('add_bootcamp'); ?></a>
					</li>

					<!-- category -->
					<li class="<?php if ($page_name == 'category') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/bootcamp/category'); ?>"><?php echo get_phrase('category'); ?></a>
					</li>

					<!-- payment -->
					<li class="<?php if ($page_name == 'bootcamp_payment_report' || $page_name == 'bootcamp_payment_invoice') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/bootcamp/payment_report'); ?>"><?php echo get_phrase('payment'); ?></a>
					</li>
				</ul>
			</li>
		<?php endif; ?>

		<!-- team training start -->
		<?php if (addon_status('team_training')) : ?>
			<li class="side-nav-item">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'team_packages' || $page_name == 'team_package_add' || $page_name == 'team_package_edit'  || $page_name == 'team_package_purchase_history' || $page_name == 'teams-server-side' || $page_name == 'team-details-page') : ?> active <?php endif; ?>">
					<i class="dripicons-document"></i>
					<span> <?php echo get_phrase('team_training'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level <?php if ($page_name == 'team_packages' || $page_name == 'team_package_add' || $page_name == 'team_package_edit'  || $page_name == 'team_package_purchase_history' || $page_name == 'teams-server-side' || $page_name == 'team-details-page') echo 'in'; ?>" aria-expanded="false">
					<li class="<?php if ($page_name == 'team_packages') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/team_training/team_packages'); ?>"><?php echo get_phrase('manage_packages'); ?></a>
					</li>
					<li class="<?php if ($page_name == 'team_package_add') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/team_training/team_package_form/add_team_package_form'); ?>"><?php echo get_phrase('add_new_package'); ?></a>
					</li>


					<li class="<?php if ($page_name == 'team_package_purchase_history') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/team_training/purchase_history'); ?>"><?php echo get_phrase('purchase_history'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'teams-server-side' || $page_name == 'team-details-page') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/team_training/teams_list'); ?>"><?php echo get_phrase('teams'); ?></a>
					</li>

				</ul>
			</li>
		<?php endif; ?>
		<!-- team training end -->

		<?php if (addon_status('tutor_booking')) : ?>
			<li class="side-nav-item">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'tutor_inactive_booking_list' || $page_name == 'tutor_schedule_list' || $page_name == 'tutor_inactive_schedule_list'  || $page_name == 'tutor_live_class_settings' || $page_name == 'booked_schedule_details' || $page_name == 'tutor_caregories' || $page_name == 'add_schedule' || $page_name == 'tutor_booking_list') : ?> active <?php endif; ?>">
					<i class="dripicons-document"></i>
					<span> <?php echo get_phrase('tutor_booking'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level <?php if ($page_name == 'tutor_inactive_booking_list' || $page_name == 'tutor_schedule_list' || $page_name == 'tutor_inactive_schedule_list'  || $page_name == 'tutor_live_class_settings' || $page_name == 'booked_schedule_details' || $page_name == 'tutor_caregories' || $page_name == 'add_schedule' || $page_name == 'tutor_booking_list') echo 'in'; ?>" aria-expanded="false">
					<li class="<?php if ($page_name == 'tutor_caregories') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/tutor_booking/tutor_categories'); ?>"><?php echo get_phrase('subject_category'); ?></a>
					</li>
					<li class="<?php if ($page_name == 'add_schedule') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/tutor_booking/schedule'); ?>"><?php echo get_phrase('add_booking'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'tutor_booking_list' || $page_name == 'tutor_inactive_booking_list' || $page_name == 'tutor_schedule_list' || $page_name == 'tutor_inactive_schedule_list') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/tutor_booking/tutor_booking_list'); ?>"><?php echo get_phrase('all bookings'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'booked_schedule_details') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/tutor_booking/booked_schedules'); ?>"><?php echo get_phrase('Booked Schedules'); ?></a>
					</li>
				</ul>
			</li>
		<?php endif; ?>

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
					<li class="<?php if ($page_name == 'ebook_payment_history') echo 'active'; ?>">
						<a href="javascript: void(0);" class="<?php if ($page_name == 'admin_revenue' || $page_name == 'instructor_revenue') : ?> active <?php endif; ?>" aria-expanded="false"><?php echo get_phrase('payment_history'); ?>
							<span class="menu-arrow"></span>
						</a>

						<ul class="side-nav-third-level" aria-expanded="false">
							<li class="<?php if ($page_name == 'admin_revenue') : ?> active <?php endif; ?>">
								<a href="<?php echo site_url('addons/ebook_manager/payment_history/admin_revenue'); ?>"><?php echo get_phrase('admin_revenue'); ?></a>
							</li>
							<li class="<?php if ($page_name == 'instructor_revenue') echo 'active'; ?>">
								<a href="<?php echo site_url('addons/ebook_manager/payment_history/instructor_revenue'); ?>"><?php echo get_phrase('instructor_revenue'); ?></a>
							</li>
						</ul>
					</li>

					<li class="<?php if ($page_name == 'ebook_category') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/ebook_manager/ebook_category'); ?>"><?php echo get_phrase('category'); ?></a>
					</li>
				</ul>
			</li>
		<?php endif; ?>

		<?php if (has_permission('enrolment')) : ?>
			<li class="side-nav-item <?php if ($page_name == 'enrol_history' || $page_name == 'enrol_student') : ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'enrol_history' || $page_name == 'enrol_student') : ?> active <?php endif; ?>">
					<i class="dripicons-network-3"></i>
					<span> <?php echo get_phrase('Enrollments'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class="<?php if ($page_name == 'enrol_student') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/enrol_student'); ?>"><?php echo get_phrase('course_enrollment'); ?></a>
					</li>
					<li class="<?php if ($page_name == 'enrol_history') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/enrol_history'); ?>"><?php echo get_phrase('enrol_history'); ?></a>
					</li>
				</ul>
			</li>
		<?php endif; ?>

		<?php if (has_permission('revenue')) : ?>
			<li class="side-nav-item">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'admin_revenue' || $page_name == 'instructor_revenue' || $page_name == 'purchase_history' || $page_name == 'invoice') : ?> active <?php endif; ?>">
					<i class="dripicons-box"></i>
					<span> <?php echo get_phrase('report'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class="<?php if ($page_name == 'admin_revenue') echo 'active'; ?>"> <a href="<?php echo site_url('admin/admin_revenue'); ?>"><?php echo get_phrase('admin_revenue'); ?></a> </li>
					<?php if (1==0 && get_settings('allow_instructor') == 1) : ?>
						<li class="<?php if ($page_name == 'instructor_revenue') echo 'active'; ?>">
							<a href="<?php echo site_url('admin/instructor_revenue'); ?>">
								<?php echo get_phrase('instructor_revenue'); ?>
							</a>
						</li>
					<?php endif; ?>
					<li class="<?php if ($page_name == 'purchase_history') echo 'active'; ?>"> <a href="<?php echo site_url('admin/purchase_history'); ?>"><?php echo get_phrase('purchase_history'); ?></a> </li>
				</ul>
			</li>
		<?php endif; ?>


		<?php if (has_permission('audit')) : ?>
			<li class="side-nav-item">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'activity_log' || $page_name == 'key_activity_log') : ?> active <?php endif; ?>">
					<i class="dripicons-lightbulb"></i>
					<span> <?php echo get_phrase('audit'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class="<?php if ($page_name == 'activity_log') echo 'active'; ?>"> <a href="<?php echo site_url('admin/activity_log'); ?>"><?php echo get_phrase('site_activity'); ?></a> </li>
					<li class="<?php if ($page_name == 'key_activity_log') echo 'active'; ?>"> <a href="<?php echo site_url('admin/key_activity_log'); ?>"><?php echo get_phrase('key_activity'); ?></a> </li>
				</ul>
			</li>
		<?php endif; ?>

		<?php if (has_permission('iqa')||has_permission('eqa')) : ?>
			<li class="side-nav-item">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'report_qa') : ?> active <?php endif; ?>">
					<i class="dripicons-graduation"></i>
					<span> <?php echo get_phrase('q').'A'; ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class=""> <a href="<?php echo site_url('admin/courses_qa'); ?>"><?php echo get_phrase('courses'); ?></a> </li>
					<li class="<?php if ($page_name == 'report_qa') echo 'active'; ?>"> <a href="<?php echo site_url('admin/report_qa'); ?>"><?php echo get_phrase('reports'); ?></a> </li>
				</ul>
			</li>
		<?php endif; ?>



		<?php if (addon_status('affiliate_course')) :
			$CI    = &get_instance();
			$CI->load->model('addons/affiliate_course_model');

		?>
			<li class="side-nav-item <?php if ($page_name == 'active_affiliator' || $page_name == 'suspend_affiliator' || $page_name == 'pending_affiliator' || $page_name == 'course_affiliation_history' || $page_name == 'affiliation_course_payouts' || $page_name == 'affiliator_add' || $page_name == 'affiliate_addon_settings') : ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'active_affiliator' || $page_name == 'suspend_affiliator' || $page_name == 'pending_affiliator' || $page_name == 'course_affiliation_history' || $page_name == 'affiliation_course_payouts' || $page_name == 'affiliator_add' || $page_name == 'affiliate_addon_settings') : ?> active <?php endif; ?>">
					<i class="dripicons-box"></i>
					<span> <?php echo get_phrase('Affiliate'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">



					<li class="<?php if ($page_name == 'active_affiliator' || $page_name == 'suspend_affiliator' || $page_name == 'pending_affiliator') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/affiliate_course/active_affiliator'); ?>">
							<?php echo get_phrase('affliliator_list'); ?>
							<span class="badge badge-danger-lighten">

								<?php
								echo $CI->affiliate_course_model->get_pending_affiliator_application()->num_rows();
								?></span>

						</a>
					</li>

					<li class="<?php if ($page_name == 'course_affiliation_history') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/affiliate_course/course_affiliation_history'); ?>">
							<?php echo get_phrase('affiliation_history'); ?>
							<span class="badge badge-danger-lighten"></span>
						</a>
					</li>

					<li class="<?php if ($page_name == 'affiliation_course_payouts') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/affiliate_course/affiliation_course_payouts'); ?>">
							<?php echo get_phrase('Payouts'); ?>
							<span class="badge badge-danger-lighten">

								<?php
								echo $CI->affiliate_course_model->get_table_pending_course_amount_info_from_course_affiliation_payouts()->num_rows();
								?></span>
						</a>
					</li>





					<li class="<?php if ($page_name == 'affiliator_add') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/affiliate_course/affiliator_form'); ?>">
							<?php echo get_phrase('Create_affiliator'); ?>

						</a>
					</li>

					<li class="<?php if ($page_name == 'affiliate_addon_settings') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/affiliate_course/affiliate_addon_settings'); ?>">
							<?php echo get_phrase('affiliation_settings'); ?>
							<span class="badge badge-danger-lighten"></span>
						</a>
					</li>





				</ul>
			</li>
		<?php endif; ?>

		<?php if (has_permission('user')) : ?>
			<li class="side-nav-item <?php if ($page_name == 'admins' || $page_name == 'admin_add' || $page_name == 'admin_edit' || $page_name == 'admin_permission' || $page_name == 'instructors' || $page_name == 'instructor_add' || $page_name == 'instructor_edit' || $page_name == 'instructor_payout' || $page_name == 'instructor_settings' || $page_name == 'application_list' || $page_name == 'users' || $page_name == 'user_add' || $page_name == 'user_edit') : ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'admins' || $page_name == 'admin_add' || $page_name == 'admin_edit' || $page_name == 'admin_permission' || $page_name == 'instructors' || $page_name == 'instructor_add' || $page_name == 'instructor_edit' || $page_name == 'instructor_payout' || $page_name == 'instructor_settings' || $page_name == 'application_list' || $page_name == 'users' || $page_name == 'user_add' || $page_name == 'user_edit') : ?> active <?php endif; ?>">
					<i class="dripicons-user-group"></i>
					<span> <?php echo get_phrase('users'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<?php if (has_permission('admin')) : ?>
						<li class="side-nav-item <?php if ($page_name == 'admins' || $page_name == 'admin_add' || $page_name == 'admin_edit' || $page_name == 'admin_permission') : ?> active <?php endif; ?>">
							<a href="javascript: void(0);" class="<?php if ($page_name == 'admins' || $page_name == 'admin_add' || $page_name == 'admin_edit' || $page_name == 'admin_permission') : ?> active <?php endif; ?>" aria-expanded="false"><?php echo get_phrase('admins'); ?>
								<span class="menu-arrow"></span>
							</a>
							<ul class="side-nav-third-level" aria-expanded="false">
								<li class="<?php if ($page_name == 'admins' || $page_name == 'admin_edit' || $page_name == 'admin_permission') : ?> active <?php endif; ?>">
									<a href="<?php echo site_url('admin/admins'); ?>" class="<?php if ($page_name == 'admins' || $page_name == 'admin_edit' || $page_name == 'admin_permission') : ?> active <?php endif; ?>"><?php echo get_phrase('manage_admins'); ?></a>
								</li>
								<li class="<?php if ($page_name == 'admin_add') echo 'active'; ?>">
									<a href="<?php echo site_url('admin/admin_form/add_admin_form'); ?>"><?php echo get_phrase('add_new_admin'); ?></a>
								</li>
							</ul>
						</li>
					<?php endif; ?>

					<?php if (has_permission('instructor')) : ?>
						<li class="side-nav-item <?php if ($page_name == 'instructors' || $page_name == 'instructor_edit') : ?> active <?php endif; ?>">
							<a href="javascript: void(0);" aria-expanded="false" class="<?php if ($page_name == 'instructors' || $page_name == 'instructor_edit') : ?> active <?php endif; ?>">
								<?php echo get_phrase('instructors'); ?>
								<span class="menu-arrow"></span>
							</a>
							<ul class="side-nav-third-level" aria-expanded="false">
								<li class="<?php if ($page_name == 'instructors' || $page_name == 'instructor_edit') echo 'active'; ?>">
									<a href="<?php echo site_url('admin/instructors'); ?>"><?php echo get_phrase('manage_instructors'); ?></a>
								</li>
								<li class="<?php if ($page_name == 'instructor_add') echo 'active'; ?>">
									<a href="<?php echo site_url('admin/instructor_form/add_instructor_form'); ?>"><?php echo get_phrase('add_new_instructor'); ?></a>
								</li>
							<!--
								<li class="<?php if ($page_name == 'instructor_payout') echo 'active'; ?>">
									<a href="<?php echo site_url('admin/instructor_payout'); ?>">
										<?php echo get_phrase('instructor_payout'); ?>
										<span class="badge badge-danger-lighten"><?php echo $this->crud_model->get_pending_payouts()->num_rows(); ?></span>
									</a>
								</li>
								<li class="<?php if ($page_name == 'instructor_settings') echo 'active'; ?>">
									<a href="<?php echo site_url('admin/instructor_settings'); ?>"><?php echo get_phrase('instructor_settings'); ?></a>
								</li>
								<li class="<?php if ($page_name == 'application_list') echo 'active'; ?>">
									<a href="<?php echo site_url('admin/instructor_application'); ?>">
										<?php echo get_phrase('applications'); ?>
										<span class="badge badge-danger-lighten"><?php echo $this->user_model->get_pending_applications()->num_rows(); ?></span>
									</a>
								</li>
							-->
							</ul>
						</li>
					<?php endif; ?>

					<?php if (has_permission('student')) : ?>
						<li class="side-nav-item <?php if ($page_name == 'users' || $page_name == 'user_add' || $page_name == 'user_edit') : ?> active <?php endif; ?>">
							<a href="javascript: void(0);" aria-expanded="false" class="<?php if ($page_name == 'users' || $page_name == 'user_add' || $page_name == 'user_edit') : ?> active <?php endif; ?>"><?php echo get_phrase('students'); ?>
								<span class="menu-arrow"></span>
							</a>
							<ul class="side-nav-third-level" aria-expanded="false">
								<li class="<?php if ($page_name == 'users' || $page_name == 'user_edit') echo 'active'; ?>">
									<a href="<?php echo site_url('admin/users'); ?>"><?php echo get_phrase('manage_students'); ?></a>
								</li>
								<li class="<?php if ($page_name == 'user_add') echo 'active'; ?>">
									<a href="<?php echo site_url('admin/user_form/add_user_form'); ?>"><?php echo get_phrase('add_new_student'); ?></a>
								</li>
							</ul>
						</li>
					<?php endif; ?>
				</ul>
			</li>
		<?php endif; ?>

		<?php if (addon_status('offline_payment')) : ?>
			<li class="side-nav-item">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'offline_payment_pending' || $page_name == 'offline_payment_approve' || $page_name == 'offline_payment_suspended') : ?> active <?php endif; ?>">
					<i class="dripicons-box"></i>
					<span> <?php echo get_phrase('offline_payment'); ?></span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class="<?php if ($page_name == 'offline_payment_pending') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/offline_payment/pending'); ?>">
							<?php echo get_phrase('pending_request'); ?>
							<span class="badge badge-danger-lighten badge-pill float-right"><?php echo get_pending_offline_payment(); ?></span></span>
						</a>
					</li>
					<li class="<?php if ($page_name == 'offline_payment_approve') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/offline_payment/approve'); ?>"><?php echo get_phrase('accepted_request'); ?></a>
					</li>
					<li class="<?php if ($page_name == 'offline_payment_suspended') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/offline_payment/suspended'); ?>"><?php echo get_phrase('suspended_request'); ?></a>
					</li>
					<li class="<?php if ($page_name == 'offline_payment_settings') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/offline_payment/settings'); ?>"><?php echo get_phrase('offline_payment_settings'); ?></a>
					</li>
				</ul>
			</li>
		<?php endif; ?>

		<?php if (has_permission('schedule')) : ?>
			<li class="side-nav-item">
				<a href="<?php echo site_url('admin/live_schedule'); ?>" class="side-nav-link <?php if ($page_name == 'live_schedule') echo 'active'; ?>">
					<i class="dripicons-alarm"></i>
					<span><?php echo get_phrase('live_schedule'); ?></span>
				</a>
			</li>
		<?php endif; ?>

		<?php if (has_permission('messaging')) : ?>
			<li class="side-nav-item">
				<a href="<?php echo site_url('admin/message'); ?>" class="side-nav-link <?php if ($page_name == 'message' || $page_name == 'message_new' || $page_name == 'message_read') echo 'active'; ?>">
					<i class="dripicons-message"></i>
					<span><?php echo get_phrase('message'); ?></span>
					<?php
					$this->db->where('receiver', $this->session->userdata('user_id'));
					$this->db->where('read_status !=', 1);
					$unreaded_message = $this->db->get('message')->num_rows();
					?>
					<?php if ($unreaded_message > 0) : ?>
						<span class="badge badge-danger-lighten float-right"><?php echo $unreaded_message; ?></span>
					<?php endif; ?>
				</a>
			</li>
		<?php endif; ?>


		<?php if (1==0 && has_permission('newsletter')) : ?>
			<li class="side-nav-item <?php if ($page_name == 'subscribed_user' || $page_name == 'newsletters' || $page_name == 'newsletter_history') : ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'subscribed_user' || $page_name == 'newsletters') : ?> active <?php endif; ?>">
					<i class="far fa-envelope-open"></i>
					<span> <?php echo get_phrase('Newsletter'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class="<?php if ($page_name == 'newsletters') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/newsletters'); ?>"><?php echo get_phrase('All newsletter'); ?></a>
					</li>
					<li class="<?php if ($page_name == 'subscribed_user') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/subscribed_user'); ?>"><?php echo get_phrase('Subscribed user'); ?></a>
					</li>
				</ul>
			</li>
		<?php endif; ?>


		<?php if (has_permission('contact')) : ?>
			<li class="side-nav-item">
				<a href="<?php echo site_url('admin/contact'); ?>" class="side-nav-link <?php if ($page_name == 'contact') : ?> active <?php endif; ?>">
					<i class="dripicons-user-id"></i>
					<span><?php echo get_phrase('Contact'); ?></span>
					<?php $unread_contact = $this->db->where('has_read', null)->get('contact')->num_rows(); ?>
					<?php if ($unread_contact > 0) : ?>
						<span class="badge badge-danger float-right"><?php echo $unread_contact; ?></span>
					<?php endif; ?>
				</a>
			</li>
		<?php endif; ?>


		<?php if (1==0 && has_permission('blog')) : ?>
			<li class="side-nav-item <?php if ($page_name == 'blog' || $page_name == 'blog_add' || $page_name == 'blog_edit' || $page_name == 'blog_category' || $page_name == 'blog_settings') : ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'blog' || $page_name == 'blog_add' || $page_name == 'blog_edit' || $page_name == 'blog_category' || $page_name == 'blog_settings' || $page_name == 'instructors_pending_blog') : ?> active <?php endif; ?>">
					<i class="dripicons-blog"></i>
					<span> <?php echo get_phrase('blog'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class="<?php if ($page_name == 'blog') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/blog'); ?>"><?php echo get_phrase('all_blogs'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'instructors_pending_blog') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/instructors_pending_blog'); ?>"><?php echo get_phrase('pending_blog'); ?> <span class="badge badge-danger-lighten"><?php echo $this->crud_model->get_instructors_pending_blog()->num_rows(); ?></span></a>
					</li>

					<li class="<?php if ($page_name == 'blog_category') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/blog_category'); ?>"><?php echo get_phrase('blog_category'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'blog_settings') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/blog_settings'); ?>"><?php echo get_phrase('blog_settings'); ?></a>
					</li>
				</ul>
			</li>
		<?php endif; ?>


		<?php if (addon_status('customer_support')) : ?>
			<li class="side-nav-item <?php if ($page_name == 'tickets' || $page_name == 'support_category' || $page_name == 'support_macro' || $page_name == 'create_ticket') : ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link">
					<i class="dripicons-help"></i>
					<span> <?php echo get_phrase('customer_support'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class="<?php if ($page_name == 'tickets') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/customer_support/tickets/opened'); ?>"><?php echo get_phrase('ticket_list'); ?></a>
					</li>
					<li class="<?php if ($page_name == 'support_category') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/customer_support/get_support_categories'); ?>"><?php echo get_phrase('support_category'); ?></a>
					</li>
					<li class="<?php if ($page_name == 'support_macro') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/customer_support/get_support_macros'); ?>"><?php echo get_phrase('macro'); ?></a>
					</li>
					<li class="<?php if ($page_name == 'create_ticket') echo 'active'; ?>">
						<a href="<?php echo site_url('addons/customer_support/create_support_ticket'); ?>"><?php echo get_phrase('create_ticket'); ?></a>
					</li>
				</ul>
			</li>
		<?php endif; ?>

		<?php if (1==0 && has_permission('addon')) : ?>
			<li class="side-nav-item">
				<a href="<?php echo site_url('admin/addon'); ?>" class="side-nav-link <?php if ($page_name == 'addons' || $page_name == 'addon_add' || $page_name == 'available_addons') : ?> active <?php endif; ?>">
					<i class="dripicons-graph-pie"></i>
					<span><?php echo get_phrase('addons'); ?></span>
				</a>
			</li>
		<?php endif; ?>

		<?php if (1==0 && has_permission('theme')) : ?>
			<li class="side-nav-item">
				<a href="<?php echo site_url('admin/theme_settings'); ?>" class="side-nav-link <?php if ($page_name == 'theme_settings') echo 'active'; ?>">
					<i class="dripicons-brush"></i>
					<span><?php echo get_phrase('themes'); ?></span>
				</a>
			</li>
		<?php endif; ?>


		<?php if (has_permission('settings')) : ?>
			<li class="side-nav-item  <?php if ($page_name == 'system_settings' || $page_name == 'frontend_settings' || $page_name == 'payment_settings' || $page_name == 'manage_language' || $page_name == 'about' || $page_name == 'themes' || $page_name == 'custom_page' || $page_name == 'data_center' || $page_name == 'notification_settings' || $page_name == 'jitsi_live_class_settings') : ?> active <?php endif; ?>">
				<a href="javascript: void(0);" class="side-nav-link">
					<i class="dripicons-toggles"></i>
					<span> <?php echo get_phrase('settings'); ?> </span>
					<span class="menu-arrow"></span>
				</a>
				<ul class="side-nav-second-level" aria-expanded="false">
					<li class="<?php if ($page_name == 'system_settings') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/system_settings'); ?>"><?php echo get_phrase('system_settings'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'frontend_settings') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/frontend_settings'); ?>"><?php echo get_phrase('website_settings'); ?></a>
					</li>

					<!-- <li class="<?php if ($page_name == 'academy_cloud') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/academy_cloud'); ?>"><?php echo get_phrase('academy_cloud'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'drip_content_settings') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/drip_content_settings'); ?>"><?php echo get_phrase('drip_content_settings'); ?></a>
					</li>
					-->
					<li class="<?php if ($page_name == 'notification_settings') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/notification_settings'); ?>?tab=email-template"><?php echo get_phrase('Notification settings'); ?></a>
					</li>

					<?php if (addon_status('certificate')) : ?>
						<li class="<?php if ($page_name == 'certificate_settings') echo 'active'; ?>">
							<a href="<?php echo site_url('addons/certificate/settings'); ?>"><?php echo get_phrase('certificate_settings'); ?></a>
						</li>
					<?php endif; ?>

					<?php if (addon_status('amazon-s3')) : ?>
						<li class="<?php if ($page_name == 's3_settings') echo 'active'; ?>">
							<a href="<?php echo site_url('addons/amazons3/settings'); ?>"><?php echo get_phrase('s3_settings'); ?></a>
						</li>
					<?php endif; ?>

					<?php if (addon_status('course_ai')) : ?>
						<li class="<?php if ($page_name == 'open_ai_settings') echo 'active'; ?>">
							<a href="<?php echo site_url('admin/open_ai_settings'); ?>"><?php echo get_phrase('Open_AI_settings'); ?></a>
						</li>
					<?php endif; ?>

					<?php if (addon_status('live-class')) : ?>
						<li class="<?php if ($page_name == 'zoom_live_class_settings') echo 'active'; ?>">
							<a href="<?php echo site_url('addons/liveclass/settings'); ?>"><?php echo get_phrase('Zoom live class settings'); ?></a>
						</li>
					<?php endif; ?>

					<?php if (addon_status('jitsi-live-class')) : ?>
						<li class="<?php if ($page_name == 'jitsi_live_class_settings') echo 'active'; ?>">
							<a href="<?php echo site_url('addons/jitsi_liveclass/settings'); ?>"><?php echo get_phrase('Jitsi live class settings'); ?></a>
						</li>
					<?php endif; ?>

					<li class="<?php if ($page_name == 'payment_settings') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/payment_settings'); ?>"><?php echo get_phrase('payment_settings'); ?></a>
					</li>

				<!--
					<li class="<?php if ($page_name == 'wasabi_settings') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/wasabi_settings'); ?>"><?php echo get_phrase('Wasabi Storage Settings'); ?></a>
					</li>


					<li class="<?php if ($page_name == 'bbb_live_class_settings') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/bbb_live_class_settings'); ?>"><?php echo get_phrase('BBB live class settings'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'manage_language') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/manage_language'); ?>"><?php echo get_phrase('language_settings'); ?></a>
					</li>
					<li class="<?php if ($page_name == 'social_login') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/social_login_settings'); ?>"><?php echo get_phrase('social_login'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'custom_page') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/custom_page'); ?>"><?php echo get_phrase('custom_page_builder'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'data_center') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/data_center'); ?>"><?php echo get_phrase('data_center'); ?></a>
					</li>

					<li class="<?php if ($page_name == 'about') echo 'active'; ?>">
						<a href="<?php echo site_url('admin/about'); ?>"><?php echo get_phrase('about'); ?></a>
					</li>
				-->
				</ul>
			</li>
		<?php endif; ?>

		<li class="side-nav-item <?php if ($page_name == 'manage_profile') echo 'active'; ?>">
			<a href="<?php echo site_url(strtolower($this->session->userdata('role')) . '/manage_profile'); ?>" class="side-nav-link">
				<i class="dripicons-user"></i>
				<span><?php echo get_phrase('manage_profile'); ?></span>
			</a>
		</li>
	</ul>
</div>
