<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <a href="<?php echo site_url('admin/instructor_form/add_instructor_form'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('add_instructor'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
  <div class="col-lg-12">
      <div class="card">
        <div class="card-body" data-collapsed="0">
          <h4 class="mb-3 header-title"><?php echo get_phrase('instructor'); ?></h4>
          <div class="table-responsive mt-4">
          <table class="table table-striped table-centered w-100" id="basic-datatable">
            <thead>
              <tr>
                <th>#</th>
                <th><?php echo get_phrase('photo'); ?></th>
                <th><?php echo get_phrase('name'); ?></th>
                <th><?php echo get_phrase('email'); ?></th>
                <th><?php echo get_phrase('Phone'); ?></th>
                <th><?php echo get_phrase('enrolled_courses'); ?></th>
                <th><?php echo get_phrase('actions'); ?></th>
              </tr>
            </thead>
            <tbody>
            <?php
                                    foreach ($instructors as $key => $instructor) : ?>
                                        <tr id='user_all_<?php echo $instructor['id'];?>'>
                                            <td><?php echo $key + 1; ?></td>
                                            <td>
                                                <img src="<?php echo $this->user_model->get_user_image_url($instructor['id']); ?>" alt="" height="50" width="50" class="img-fluid rounded-circle img-thumbnail">
                                            </td>
                                            
                                            <td>
                                                <?php echo $instructor['first_name'].' '.$instructor['last_name']; ?>
                                            </td>
                                            <td><?php echo $instructor['email']; ?></td>
                                            <td><?php echo $instructor['phone']; ?></td>

                                            <td>
                                                <?php echo $this->user_model->get_number_of_active_courses_of_instructor($instructor['id']) . ' ' . strtolower(get_phrase('active_courses')); ?>
                                            </td>
                                            <td>
                                                <div class="dropright dropright">
                                                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="<?php echo site_url('admin/courses_qa?selected_instructor_id=' . $instructor['id'] . '&price=all') ?>"><?php echo get_phrase('view_courses'); ?></a></li>
                                                        <?php if (has_permission('iqa')) : ?>
                                                          <li><a class="dropdown-item" href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/mail_user_modal/' . $instructor['id']); ?>','<?php echo get_phrase('mail_user');?>');"><?php echo get_phrase('mail_user'); ?></a></li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
            </tbody>
          </table>
          </div>
      </div>
    </div>
  </div><!-- end col-->
</div>
