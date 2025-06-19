<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="mb-3 mt-4 header-title"><?php echo get_phrase('ratings'); ?></h4>
                <div class="table-responsive mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('user'); ?></th>
                                <th><?php echo get_phrase('course'); ?></th>
                                <th><?php echo get_phrase('rating'); ?></th>
                                <th><?php echo get_phrase('review'); ?></th>
                                <th><?php echo get_phrase('status'); ?></th>
                                <th><?php echo get_phrase('created'); ?></th>
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($ratings as $key=>$rating) : ?>
                                <tr id='tr_<?php echo $key + 1; ?>'>
                                    <td><?php echo $key + 1; ?></td>



                                    <?php
        $rating_user_details = $this->user_model->get_user($rating['user_id'])->row_array();
        $course=$this->crud_model->get_course_by_id($rating['ratable_id'])->row_array();
        $rating_date=date('d-M-Y', $rating['date_added']);
?>


                                    <td><?php echo $rating_user_details['first_name'].' '.$rating_user_details['last_name'].'('.$rating_user_details['email'].')';?></td>
                                    <td><?php echo $course['title'];?></td>
                                    <td><?php echo "<span class='rating' _average_rate='{$rating['rating']}'></span>";?></td>
                                    <td><?php echo $rating['review'];?></td>
                                    <td><?php if ($rating['status']):?> <i class="mdi mdi-circle" style="color: #4CAF50; font-size: 19px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase($course['status']); ?>"></i> <?php else:?> <i class="mdi mdi-circle" style="color: #FFC107; font-size: 19px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase($course['status']); ?>"></i> <?php endif;?> </td>
                                    <td><?php echo $rating_date; ?></td>
                                    <td>
                                        <div class="dropright dropright">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <?php if ($rating['status']) : ?>
                                                <li><a class="dropdown-item" href="#" onclick="ajax_confirm_modal('<?php echo site_url('admin/rating/update_status_api/' . $rating['id'].'/0'); ?>');"><?php echo get_phrase('disapprove'); ?></a></li>
                                            <?php else:?>
                                                <li><a class="dropdown-item" href="#" onclick="ajax_confirm_modal('<?php echo site_url('admin/rating/update_status_api/' . $rating['id'].'/1'); ?>');"><?php echo get_phrase('approve'); ?></a></li>
                                            <?php endif;?>
                                                <li><a class="dropdown-item" href="#" onclick="ajax_confirm_modal('<?php echo site_url('admin/rating/delete_api/' . $rating['id']); ?>','tr_<?php echo $key + 1; ?>');"><?php echo get_phrase('delete'); ?></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>