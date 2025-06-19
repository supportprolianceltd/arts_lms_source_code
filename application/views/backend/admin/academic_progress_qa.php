<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <!--<a href="javascript:void(0)" onclick="showAjaxModal('<?php echo site_url('modal/popup/key_activity_log_add_modal');?>','Add key activity');" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i><?php echo get_phrase('academic_progress'); ?></a>-->
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            
            <!--ajax page loader-->
            <div class="ajax_loader w-100">
                <div class="ajax_loaderBar"></div>
            </div>
            <!--end ajax page loader-->

            <div class="card-body">

                    <h4 class="mb-3 header-title"><?php echo get_phrase('student_performance'); ?></h4>
                    <form class='justify-content-center' method=get  action="<?php echo site_url('admin/academic_progress_qa/0'); ?>">

                        <div class='form-group col-md-3 d-inline-block'>
                            <select class="select2 form-control" data-toggle="select2" data-placeholder="Choose ..." name="course_id" id="course_id">
                                <option value=''><?php echo get_phrase('course'); ?></option>
                                <?php foreach ($courses as $course): ?>
                                    <option value="<?php echo $course['id'] ?>" <?php if($course['id']==$course_id) echo 'selected' ?>><?php echo $course['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class='form-group col-md-3 d-inline-block'>
                            <input type="text" name="limit" class="form-control" value='<?php echo $limit;?>' placeholder="<?php echo get_phrase('limit'); ?>">
                        </div>
                        <div class='form-group col-md-3 d-inline-block'>
                            <input type="text" name="offset" class="form-control" value='<?php echo $offset;?>' placeholder="<?php echo get_phrase('offset - optional'); ?>">
                        </div>

                        <div class='form-group col-md-3 d-inline-block'>
                            <button type="submit" class="btn btn-info" id="submit-button"> <?php echo get_phrase('sample'); ?></button>
                        </div>
                    </form>

                    <div class="mt-4" id='academic_progress'>

                    </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<script type="text/javascript">
    function student_academic_progress(course_id,limit,offset=0) {
        var academicProgressContent = $('#academic_progress').html();
        if (academicProgressContent == '' || true) {
            $('.ajax_loader').addClass('start_ajax_loading');
            $.ajax({
                url: '<?php echo site_url('admin/student_academic_progress_qa/'); ?>' + course_id+'/'+limit+'/'+offset,
                success: function(response) {
                    $('#academic_progress').html(response);
                    $('.ajax_loader').removeClass('start_ajax_loading');
                    //initDataTable(['.studentAcademicProgress']);
                    initAcademiProgressTable();
                },
                error: function(error){
                    console.log(error)
                }
            });
        }
    }

    function initAcademiProgressTable(){
        $(".studentAcademicProgress").DataTable({
        lengthChange: !1,
        dom:'Blfrtip',
        buttons: [{extend:'copy'},{extend:'pdf'},{extend:'csv',exportOptions:{columns:[2,3,4,5,6,7]}},{extend:'excel',exportOptions:{columns:[2,3,4,5,6,7]}}],
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    });
    }

window.addEventListener('load',function(){
    <?php if($course_id):?>
        student_academic_progress(<?php echo (int)$course_id; ?>,<?php echo (int)$limit; ?>,<?php echo (int)$offset; ?>);
    <?php endif;?>
});
</script>