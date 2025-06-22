<!-- Script -->
<script src="<?php echo site_url('assets/playing-page/') ?>js/jquery.min.js"></script>
<script src="<?php echo site_url('assets/playing-page/') ?>js/bootstrap.bundle.min.js"></script>
<script src="<?php echo site_url('assets/playing-page/') ?>js/script.js"></script>
<script src="<?php echo base_url() . 'assets/global/jquery-form/jquery.form.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/global/toastr/toastr.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/global/summernote-0.8.20-dist/summernote-lite.min.js'; ?>"></script>


<?php if(addon_status('certificate')): ?>
	<script src="<?php echo base_url() . 'assets/global/jquery-form/jQuery-plugin-progressbar.js'; ?>"></script>
<?php endif; ?>

<script>
function publishCourseRating(course_id) {
    var review = $('#course_review_input').val();
    var starRating = 0;
    starRating = $('#course_star_rating_input').val();
    if (starRating > 0) {
        document.getElementById('rateContainer').classList.remove('show-rate-dropdown');
        $.ajax({
            type : 'POST',
            url  : '<?php echo base_url() ."home/rate_course";?>',
            data : {course_id : course_id, review : review, starRating : starRating},
            success : function(response) {
                if(response){
                    try{
                        response_ob=JSON.parse(response);
                        if(response_ob.error) toastr.error(response_ob.error);
						else if(response_ob.success) toastr.success(response_ob.success);
                        //else location.reload();
                    }
                    catch(e){

                    }
                }
            }
        });
        //location.reload();
    }else{
		toastr.error('choose rating!');
    }
}
</script>




<script>



        document.getElementById('showRateButton').addEventListener('click', function() {
            document.getElementById('rateContainer').classList.add('show-rate-dropdown');
        });

        document.getElementById('hideRateButton').addEventListener('click', function() {
            document.getElementById('rateContainer').classList.remove('show-rate-dropdown');
        });
    </script>

