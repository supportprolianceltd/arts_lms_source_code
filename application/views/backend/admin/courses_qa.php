<?php if(has_permission('course') || has_permission('iqa') || has_permission('eqa') ):?>
    <div class="row <?=$courses_qa_title_disp?>">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('courses').' Q/A'; ?>
                    <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo site_url('modal/popup/report_qa_add_modal');?>','Add report');" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_report'); ?></a>
                        <!--<a href="<?php echo site_url('admin/course_form/add_course'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_new_course'); ?></a>-->
                    </h4>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <?php
    $qa_courses_map=get_settings('qa_courses_map_json',true);
    if(!has_permission('course') ){
        $courses=[];
        foreach($qa_courses_map as $course_id=>$bool){
            $row=$this->crud_model->get_course_by_id($course_id)->row_array();
            if($row['status']=='active') $courses[]=$row;
        }
    }
    ?>
    <?php if(has_permission('course') && false):?>
    <div class="row">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        <div class="col-sm-6 col-xl-3">
                            <a href="<?php echo site_url('admin/courses_qa?selected_category_id=all&selected_status=active&selected_instructor_id=all&selected_price=all&button='); ?>" class="text-secondary">
                                <div class="card shadow-none m-0">
                                    <div class="card-body text-center">
                                        <i class="dripicons-link text-muted" style="font-size: 24px;"></i>
                                        <h3><span><?php echo $status_wise_courses['active']->num_rows(); ?></span></h3>
                                        <p class="text-muted font-15 mb-0"><?php echo get_phrase('active_courses'); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <a href="<?php echo site_url('admin/courses_qa?selected_category_id=all&selected_status=pending&selected_instructor_id=all&selected_price=all&button='); ?>" class="text-secondary">
                                <div class="card shadow-none m-0 border-left">
                                    <div class="card-body text-center">
                                        <i class="dripicons-link-broken text-muted" style="font-size: 24px;"></i>
                                        <h3><span><?php echo $status_wise_courses['pending']->num_rows(); ?></span></h3>
                                        <p class="text-muted font-15 mb-0"><?php echo get_phrase('pending_courses'); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <a href="<?php echo site_url('admin/courses_qa?selected_category_id=all&selected_status=all&selected_instructor_id=all&selected_price=free&button='); ?>" class="text-secondary">
                                <div class="card shadow-none m-0 border-left">
                                    <div class="card-body text-center">
                                        <i class="dripicons-star text-muted" style="font-size: 24px;"></i>
                                        <h3><span><?php echo $this->crud_model->get_free_and_paid_courses('free')->num_rows(); ?></span></h3>
                                        <p class="text-muted font-15 mb-0"><?php echo get_phrase('free_courses'); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <a href="<?php echo site_url('admin/courses_qa?selected_category_id=all&selected_status=all&selected_instructor_id=all&selected_price=paid&button='); ?>" class="text-secondary">
                                <div class="card shadow-none m-0 border-left">
                                    <div class="card-body text-center">
                                        <i class="dripicons-tags text-muted" style="font-size: 24px;"></i>
                                        <h3><span><?php echo $this->crud_model->get_free_and_paid_courses('paid')->num_rows(); ?></span></h3>
                                        <p class="text-muted font-15 mb-0"><?php echo get_phrase('paid_courses'); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col-->
    </div>
    <?php endif;?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3 header-title"><?php echo get_phrase('course_list'); ?></h4>
                    <?php if(has_permission('course') && false):?>
                    <form class="row justify-content-center" action="<?php echo site_url('admin/courses_qa'); ?>" method="get">
                        <!-- Course Categories -->
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="category_id"><?php echo get_phrase('categories'); ?></label>
                                <select class="form-control select2" data-toggle="select2" name="selected_category_id" id="category_id">
                                    <option value="<?php echo 'all'; ?>" <?php if ($selected_category_id == 'all') echo 'selected'; ?>><?php echo get_phrase('all'); ?></option>
                                    <?php foreach ($categories->result_array() as $category) : ?>
                                        <optgroup label="<?php echo $category['name']; ?>">
                                            <?php $sub_categories = $this->crud_model->get_sub_categories($category['id']);
                                            foreach ($sub_categories as $sub_category) : ?>
                                                <option value="<?php echo $sub_category['id']; ?>" <?php if ($selected_category_id == $sub_category['id']) echo 'selected'; ?>><?php echo $sub_category['name']; ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Course Status -->
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="status"><?php echo get_phrase('status'); ?></label>
                                <select class="form-control select2" data-toggle="select2" name="selected_status" id='status'>
                                    <option value="all" <?php if ($selected_status == 'all') echo 'selected'; ?>><?php echo get_phrase('all'); ?></option>
                                    <option value="active" <?php if ($selected_status == 'active') echo 'selected'; ?>><?php echo get_phrase('active'); ?></option>
                                    <option value="pending" <?php if ($selected_status == 'pending') echo 'selected'; ?>><?php echo get_phrase('pending'); ?></option>
                                </select>
                            </div>
                        </div>

                        <!-- Course Instructors -->
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="instructor_id"><?php echo get_phrase('instructor'); ?></label>
                                <select class="form-control select2" data-toggle="select2" name="selected_instructor_id" id='instructor_id'>
                                    <option value="all" <?php if ($selected_instructor_id == 'all') echo 'selected'; ?>><?php echo get_phrase('all'); ?></option>
                                    <?php foreach ($instructors as $instructor) : ?>
                                        <option value="<?php echo $instructor['id']; ?>" <?php if ($selected_instructor_id == $instructor['id']) echo 'selected'; ?>><?php echo $instructor['first_name'] . ' ' . $instructor['last_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Course Price -->
                        <div class="col-xl-2">
                            <div class="form-group">
                                <label for="price"><?php echo get_phrase('price'); ?></label>
                                <select class="form-control select2" data-toggle="select2" name="selected_price" id='price'>
                                    <option value="all" <?php if ($selected_price == 'all') echo 'selected'; ?>><?php echo get_phrase('all'); ?></option>
                                    <option value="free" <?php if ($selected_price == 'free') echo 'selected'; ?>><?php echo get_phrase('free'); ?></option>
                                    <option value="paid" <?php if ($selected_price == 'paid') echo 'selected'; ?>><?php echo get_phrase('paid'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-2">
                            <label for=".." class="text-white">..</label>
                            <button type="submit" class="btn btn-primary btn-block" name="button"><?php echo get_phrase('filter'); ?></button>
                        </div>
                    </form>
                    <?php endif;?>

                    <div class="table-responsive mt-4">
                        <?php if (count((array)$courses) > 0) : ?>
                            <table id="<?php if(has_permission('course')):?>selection-datatable<?php endif;?>" class="<?php if(!has_permission('user')):?>datatable-user-data-buttons<?php endif;?> table table-striped dt-responsivei nowrap" width="100%" data-page-length='25'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo get_phrase('title'); ?></th>
                                        <th><?php echo get_phrase('category'); ?></th>
                                        <th><?php echo get_phrase('lesson_and_section'); ?></th>
                                        <th><?php echo get_phrase('enrolled_student'); ?></th>
                                        <!--<th><?php echo get_phrase('status'); ?></th>
                                        <th><?php echo get_phrase('price'); ?></th>-->
                                        <th><?php echo get_phrase('actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($courses as $key => $course) :
                                        $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();
                                        $category_details = $this->crud_model->get_category_details_by_id($course['sub_category_id'])->row_array();
                                        $sections = $this->crud_model->get_section('course', $course['id']);
                                        $lessons = $this->crud_model->get_lessons('course', $course['id']);
                                        $enroll_history = $this->crud_model->enrol_history($course['id']);
                                        if ($course['status'] == 'draft') {
                                            continue;
                                        }
                                    ?>
                                        <tr course_id='<?=$course['id'];?>' class='<?php if(has_permission('course') && $qa_courses_map[$course['id']]):?>selected<?php endif;?>'>
                                            <td><?php echo ++$key; ?></td>
                                            <td>
                                                <?php if(has_permission('course')):?>
                                                    <strong><a href="<?php echo site_url('admin/course_form/course_edit/' . $course['id']); ?>"><?php echo ellipsis($course['title']); ?></a></strong><br>
                                                <?php else:?>
                                                    <strong><a href="#"><?php echo ellipsis($course['title']); ?></a></strong><br>
                                                <?php endif;?>
                                                <small class="text-muted"><?php echo get_phrase('instructor') . ': <b>' . $instructor_details['first_name'] . ' ' . $instructor_details['last_name'] . '</b>'; ?></small>
                                            </td>
                                            <td>
                                                <span class="badge badge-dark-lighten"><?php echo $category_details['name']; ?></span>
                                            </td>
                                            <td>
                                                    
                                                <?php if ($course['course_type'] == 'general') : ?>
                                                    <small class="text-muted"><?php echo '<b>' . get_phrase('total_section') . '</b>: ' . $sections->num_rows(); ?></small><br>
                                                    <small class="text-muted"><?php echo '<b>' . get_phrase('total_lesson') . '</b>: ' . $lessons->num_rows(); ?></small>
                                                <?php else: ?>
                                                    <span class="badge badge-info-lighten"><?= $course['course_type']; ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small class="text-muted"><?php echo '<b>' . get_phrase('total_enrolment') . '</b>: ' . $enroll_history->num_rows(); ?></small>
                                            </td>
                                            <!--<td class="text-center">
                                                <?php if ($course['status'] == 'pending') : ?>
                                                    <i class="mdi mdi-circle" style="color: #FFC107; font-size: 19px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase($course['status']); ?>"></i>
                                                <?php elseif ($course['status'] == 'active') : ?>
                                                    <i class="mdi mdi-circle" style="color: #4CAF50; font-size: 19px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase($course['status']); ?>"></i>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($course['is_free_course'] == null) : ?>
                                                    <?php if ($course['discount_flag'] == 1) : ?>
                                                        <span class="badge badge-dark-lighten"><?php echo currency($course['discounted_price']); ?></span>
                                                    <?php else : ?>
                                                        <span class="badge badge-dark-lighten"><?php echo currency($course['price']); ?></span>
                                                    <?php endif; ?>
                                                <?php elseif ($course['is_free_course'] == 1) : ?>
                                                    <span class="badge badge-success-lighten"><?php echo get_phrase('free'); ?></span>
                                                <?php endif; ?>
                                            </td>
                                                -->
                                            <td>
                                                <div class="dropright dropright">
                                                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="<?php echo site_url('admin/preview/' . $course['id']); ?>" target="_blank"><?php echo get_phrase('view_course_on_frontend'); ?></a></li>
                                                        <li><a class="dropdown-item" href="<?php echo site_url('home/course/' . slugify($course['title']).'/'.$course['id']); ?>" target="_blank"><?php echo get_phrase('view_course_details'); ?></a></li>
                                                        <li><a class="dropdown-item" href="<?php echo site_url('admin/academic_progress_qa/' . $course['id']); ?>" target="_blank"><?php echo get_phrase('student_performance'); ?></a></li>

                                                        <!--<li><a class="dropdown-item" href="<?php echo site_url('home/course/' . slugify($course['title']) . '/' . $course['id']); ?>" target="_blank"><?php echo get_phrase('view_course_on_frontend'); ?></a></li>
                                                        <li><a class="dropdown-item" href="<?php echo site_url('admin/course_form/course_edit/' . $course['id']); ?>"><?php echo get_phrase('edit_this_course'); ?></a></li>
                                                        <?php if ($course['course_type'] == 'general') : ?>
                                                            <li><a class="dropdown-item" href="<?php echo site_url('admin/course_form/course_edit/' . $course['id']); ?>"><?php echo get_phrase('section_and_lesson'); ?></a></li>
                                                        <?php endif; ?>
                                                        <li>
                                                            <?php if ($course['status'] == 'active') : ?>
                                                                <?php if ($course['user_id'] != $this->session->userdata('user_id')) : ?>
                                                                    <a class="dropdown-item" href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/mail_on_course_status_changing_modal/pending/<?php echo $course['id']; ?>/<?php echo $selected_category_id; ?>/<?php echo $selected_instructor_id; ?>/<?php echo $selected_price; ?>/<?php echo $selected_status; ?>', '<?php echo get_phrase('inform_instructor'); ?>');">
                                                                        <?php echo get_phrase('mark_as_pending'); ?>
                                                                    </a>
                                                                <?php else : ?>
                                                                    <a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url(); ?>admin/change_course_status_for_admin/pending/<?php echo $course['id']; ?>/<?php echo $selected_category_id; ?>/<?php echo $selected_instructor_id; ?>/<?php echo $selected_price; ?>/<?php echo $selected_status; ?>', '<?php echo get_phrase('inform_instructor'); ?>');">
                                                                        <?php echo get_phrase('mark_as_pending'); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                <?php if ($course['user_id'] != $this->session->userdata('user_id')) : ?>
                                                                    <a class="dropdown-item" href="#" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/mail_on_course_status_changing_modal/active/<?php echo $course['id']; ?>/<?php echo $selected_category_id; ?>/<?php echo $selected_instructor_id; ?>/<?php echo $selected_price; ?>/<?php echo $selected_status; ?>', '<?php echo get_phrase('inform_instructor'); ?>');">
                                                                        <?php echo get_phrase('mark_as_active'); ?>
                                                                    </a>
                                                                <?php else : ?>
                                                                    <a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url(); ?>admin/change_course_status_for_admin/active/<?php echo $course['id']; ?>/<?php echo $selected_category_id; ?>/<?php echo $selected_instructor_id; ?>/<?php echo $selected_price; ?>/<?php echo $selected_status; ?>', '<?php echo get_phrase('inform_instructor'); ?>');">
                                                                        <?php echo get_phrase('mark_as_active'); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('admin/course_actions/delete/' . $course['id']); ?>');"><?php echo get_phrase('delete'); ?></a></li>
                                                                -->
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <?php if(has_permission('course')):?>
                                        <tr><td><button id='selectAll' type="button" class="btn btn-primary" name="button"><?php echo get_phrase('select_all'); ?></button></td><td><button id='submitSelected' type="button" class="btn btn-primary" name="button"  disabled>Update QA Courses</button></td></tr>
                                    <?php endif;?>
                                </tfoot>
                            </table>
                        <?php endif; ?>
                        <?php if (count((array)$courses) == 0) : ?>
                            <div class="img-fluid w-100 text-center">
                                <img style="opacity: 1; width: 100px;" src="<?php echo base_url('assets/backend/images/file-search.svg'); ?>"><br>
                                <?php echo get_phrase('no_data_found'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(has_permission('user')):?>
    <script>
    $(window).on('load',function() {
        setTimeout(function(){
            $('#selection-datatable tbody tr.selected').each(function() {
        var table=$("#selection-datatable").DataTable();//$('#selection-datatable').DataTable();
        table.row(this).select();
    });
        },500);
    // 1. Add row selection capability
    $('#selection-datatable tbody').on('click', 'tr', function() {
        $(this).toggleClass('selected');
        updateSubmitState();
    });

    // 2. Handle select all
    $('#selectAll').click(function() {
        $('#selection-datatable tbody tr').addClass('selected');
        updateSubmitState();
    });

    // 3. Submit handler
    $('#submitSelected').click(function() {
        if(!$('#submitSelected').prop('disabled')){
            const selectedIds = [];
            $('#selection-datatable tr.selected').each(function() {
            const courseId = $(this).attr('course_id');
            if (courseId) selectedIds.push(courseId);
            });
            console.log('Selected IDs:', selectedIds);
            // Add your AJAX submission logic here
            upload_qa_courses_api(selectedIds);
        }
    });

    // 4. Update submit button state
    function updateSubmitState() {
        $('#submitSelected').prop('disabled', $('#selection-datatable tr.selected').length === 0 && false);
    }
    //updateSubmitState();
    });

    function upload_qa_courses_api(selectedIds){
        $.ajax({
        url: '<?php echo site_url('admin/courses_qa/update_api'); ?>', // your PHP endpoint
        method: 'POST',
        data: { qa_courses_array: selectedIds },
        success: function(response) {
            distributeServerResponse(response);
            $('#submitSelected').prop('disabled',true);
        },
        error: function() {
        distributeServerResponse(response);
        $('#submitSelected').prop('disabled',true);
        }
    });
    }
    </script>
    <?php endif;?>
<?php endif;?>