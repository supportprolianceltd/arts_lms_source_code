<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('add_new_course'); ?></h4>
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

                <div class="row">
                    <div class="col-md-6">
                        <h4 class="header-title my-1"><?php echo get_phrase('course_adding_form'); ?></h4>
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo site_url('user/courses'); ?>" class="alignToTitle btn btn-outline-secondary btn-rounded btn-sm my-1"> <i class=" mdi mdi-keyboard-backspace"></i> <?php echo get_phrase('back_to_course_list'); ?></a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <form class="required-form" action="<?php echo site_url('user/course_actions/add'); ?>" method="post" enctype="multipart/form-data">
                            <div class="scrollable-tab-section" id="basicwizard">

                                <button type="button" class="scrollable-tab-btn-left" ><i class="mdi mdi-arrow-left"></i></button>

                                <div class="scrollable-tab">
                                    <ul class="nav nav-pills nav-justified form-wizard-header">
                                        <li class="nav-item">
                                            <a href="#basic" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-fountain-pen-tip"></i>
                                                <span class=""><?php echo get_phrase('basic'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-information-outline"></i>
                                                <span class=""><?php echo get_phrase('info'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#pricing" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-currency-cny"></i>
                                                <span class=""><?php echo get_phrase('pricing'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#media" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-library-video"></i>
                                                <span class=""><?php echo get_phrase('media'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#seo" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-tag-multiple"></i>
                                                <span class=""><?php echo get_phrase('seo'); ?></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#finish" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                                                <span class=""><?php echo get_phrase('finish'); ?></span>
                                            </a>
                                        </li>
                                        <li class="w-100 bg-white pb-3">
                                             <!--ajax page loader-->
                                            <div class="ajax_loader w-100">
                                              <div class="ajax_loaderBar"></div>
                                            </div>
                                            <!--end ajax page loader-->
                                        </li>
                                    </ul>
                                </div>

                                <button type="button" class="scrollable-tab-btn-right" ><i class="mdi mdi-arrow-right"></i></button>

                                <div class="tab-content b-0 mb-0">
                                    <div class="tab-pane" id="basic">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-8">
                                                <?php if(addon_status('scorm_course') || addon_status('h5p')): ?>
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-2 col-form-label" for="course_type"><?php echo get_phrase('course_type'); ?></label>
                                                        <div class="col-md-10">
                                                            <select class="form-control select2" data-toggle="select2" name="course_type" id="course_type">
                                                                <option value="general"><?php echo get_phrase('general'); ?></option>
                                                                <?php if(addon_status('scorm_course')){ ?>
                                                                    <option value="scorm"><?php echo get_phrase('scorm'); ?></option>
                                                                 <?php }?>
                                                                <?php if(addon_status('h5p')){?>
                                                                    <option value="h5p"><?php echo get_phrase('H5P');?>
                                                                 <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <input type="hidden" name = "course_type" value="general">
                                                <?php endif; ?>
                                                
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="course_title"><?php echo get_phrase('course_title'); ?> <span class="required">*</span> </label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" id="course_title" name = "title" placeholder="<?php echo get_phrase('enter_course_title'); ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="short_description"><?php echo get_phrase('short_description'); ?></label>
                                                    <div class="col-md-10">
                                                        <textarea name="short_description" id = "short_description" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="description"><?php echo get_phrase('description'); ?></label>
                                                    <div class="col-md-10">
                                                        <textarea name="description" id = "description" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="sub_category_id"><?php echo get_phrase('category'); ?><span class="required">*</span></label>
                                                    <div class="col-md-10">
                                                        <select class="form-control select2" data-toggle="select2" name="sub_category_id" id="sub_category_id" required>
                                                            <option value=""><?php echo get_phrase('select_a_category'); ?></option>
                                                            <?php foreach ($categories->result_array() as $category): ?>
                                                                <optgroup label="<?php echo $category['name']; ?>">
                                                                    <?php $sub_categories = $this->crud_model->get_sub_categories($category['id']);
                                                                    foreach ($sub_categories as $sub_category): ?>
                                                                    <option value="<?php echo $sub_category['id']; ?>"><?php echo $sub_category['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <small class="text-muted"><?php echo get_phrase('select_sub_category'); ?></small>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 col-form-label" for="level"><?php echo get_phrase('badge'); ?></label>
                                                <div class="col-md-10">
                                                    <select class="form-control select2" data-toggle="select2" name="level" id="level">
                                                        <option value="beginner"><?php echo get_phrase('beginner'); ?></option>
                                                        <option value="advanced"><?php echo get_phrase('advanced'); ?></option>
                                                        <option value="intermediate"><?php echo get_phrase('intermediate'); ?></option>
                                                        <option value="mandatory"><?php echo get_phrase('mandatory'); ?></option>
                                                        <option value="qualifications"><?php echo get_phrase('qualifications'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 col-form-label" for="language_made_in"><?php echo get_phrase('language_made_in'); ?></label>
                                                <div class="col-md-10">
                                                    <select class="form-control select2" data-toggle="select2" name="language_made_in" id="language_made_in">
                                                        <?php foreach ($languages as $language): ?>
                                                            <option value="<?php echo $language; ?>"><?php echo ucfirst($language); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 col-form-label" for="enable_drip_content"><?php echo get_phrase('enable_drip_content'); ?></label>
                                                <div class="col-md-10 pt-2">
                                                    <input type="checkbox" name="enable_drip_content" value="1" id="enable_drip_content" data-switch="primary">
                                                    <label for="enable_drip_content" data-on-label="On" data-off-label="Off"></label>
                                                </div>
                                            </div>

                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div> <!-- end tab pane -->

                                <div class="tab-pane" id="info">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 col-form-label" for="faq"><?php echo get_phrase('course_faq'); ?></label>
                                                <div class="col-md-10">
                                                    <div id = "faq_area">
                                                        <div class="d-flex mt-2">
                                                            <div class="flex-grow-1 px-3">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="faqs[]" id="faqs" placeholder="<?php echo get_phrase('faq_question'); ?>">
                                                                    <textarea name="faq_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendFaq()"> <i class="fa fa-plus"></i> </button>
                                                            </div>
                                                        </div>
                                                        <div id = "blank_faq_field">
                                                            <div class="d-flex mt-2">
                                                                <div class="flex-grow-1 px-3">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="faqs[]" id="faqs" placeholder="<?php echo get_phrase('faq_question'); ?>">
                                                                        <textarea name="faq_descriptions[]" class="form-control mt-2" placeholder="<?php echo get_phrase('answer'); ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeFaq(this)"> <i class="fa fa-minus"></i> </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3 pt-2">
                                                <label class="col-md-2 col-form-label" for="requirements"><?php echo get_phrase('requirements'); ?></label>
                                                <div class="col-md-10">
                                                    <div id = "requirement_area">
                                                        <div class="d-flex mt-2">
                                                            <div class="flex-grow-1 px-3">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="requirements[]" id="requirements" placeholder="<?php echo get_phrase('provide_requirements'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <button type="button" class="btn btn-success btn-sm" style="" name="button" onclick="appendRequirement()"> <i class="fa fa-plus"></i> </button>
                                                            </div>
                                                        </div>
                                                        <div id = "blank_requirement_field">
                                                            <div class="d-flex mt-2">
                                                                <div class="flex-grow-1 px-3">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="requirements[]" id="requirements" placeholder="<?php echo get_phrase('provide_requirements'); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeRequirement(this)"> <i class="fa fa-minus"></i> </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3 pt-2">
                                                <label class="col-md-2 col-form-label" for="outcomes"><?php echo get_phrase('outcomes'); ?></label>
                                                <div class="col-md-10">
                                                    <div id = "outcomes_area">
                                                        <div class="d-flex mt-2">
                                                            <div class="flex-grow-1 px-3">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="outcomes[]" id="outcomes" placeholder="<?php echo get_phrase('provide_outcomes'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="">
                                                                <button type="button" class="btn btn-success btn-sm" name="button" onclick="appendOutcome()"> <i class="fa fa-plus"></i> </button>
                                                            </div>
                                                        </div>
                                                        <div id = "blank_outcome_field">
                                                            <div class="d-flex mt-2">
                                                                <div class="flex-grow-1 px-3">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="outcomes[]" id="outcomes" placeholder="<?php echo get_phrase('provide_outcomes'); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top: 0px;" name="button" onclick="removeOutcome(this)"> <i class="fa fa-minus"></i> </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="pricing">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mb-3">
                                                <div class="offset-md-2 col-md-10">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="is_free_course" id="is_free_course" value="1" onclick="togglePriceFields(this.id)">
                                                        <label class="custom-control-label" for="is_free_course"><?php echo get_phrase('check_if_this_is_a_free_course'); ?></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="paid-course-stuffs">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="price"><?php echo get_phrase('course_price').' ('.currency_code_and_symbol().')'; ?></label>
                                                    <div class="col-md-10">
                                                        <input type="number" class="form-control" id="price" name = "price" placeholder="<?php echo get_phrase('enter_course_course_price'); ?>" min="0">
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <div class="offset-md-2 col-md-10">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="discount_flag" id="discount_flag" value="1">
                                                            <label class="custom-control-label" for="discount_flag"><?php echo get_phrase('check_if_this_course_has_discount'); ?></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-3">
                                                    <label class="col-md-2 col-form-label" for="discounted_price"><?php echo get_phrase('discounted_price').' ('.currency_code_and_symbol().')'; ?></label>
                                                    <div class="col-md-10">
                                                        <input type="number" class="form-control" name="discounted_price" id="discounted_price" onkeyup="calculateDiscountPercentage(this.value)" min="0">
                                                        <small class="text-muted"><?php echo get_phrase('this_course_has'); ?> <span id = "discounted_percentage" class="text-danger">0%</span> <?php echo get_phrase('discount'); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row mb-3 d-none">
                                                <label class="col-md-2 col-form-label"><?php echo get_phrase('Expiry period'); ?></label>
                                                <div class="col-md-10 pt-2 d-flex">
                                                    <div class="custom-control custom-radio mr-2">
                                                        <input type="radio" id="lifetime_expiry_period" name="expiry_period" class="custom-control-input" value="lifetime" onchange="checkExpiryPeriod(this)" checked>
                                                        <label class="custom-control-label" for="lifetime_expiry_period"><?php echo get_phrase('Lifetime'); ?></label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="limited_expiry_period" name="expiry_period" class="custom-control-input" value="limited_time" onchange="checkExpiryPeriod(this)">
                                                        <label class="custom-control-label" for="limited_expiry_period"><?php echo get_phrase('Limited time'); ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3" id="number_of_month" style="display: none">
                                                <label class="col-md-2 col-form-label"><?php echo get_phrase('Number of month'); ?></label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="number" name="number_of_month" min="1">
                                                    <small class="badge badge-light"><?php echo get_phrase('After purchase, students can access the course until your selected time.'); ?></small>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div> <!-- end tab-pane -->
                                <div class="tab-pane" id="media">
                                    <div class="row justify-content-center">

                                        <div class="col-xl-8 d-none">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 col-form-label" for="course_overview_provider"><?php echo get_phrase('course_overview_provider'); ?></label>
                                                <div class="col-md-10">
                                                    <select class="form-control select2" data-toggle="select2" name="course_overview_provider" id="course_overview_provider" onchange="course_overview_provider_input(this,course_overview_url)">
                                                        <option value="youtube"><?php echo get_phrase('youtube'); ?></option>
                                                        <option value="vimeo"><?php echo get_phrase('vimeo'); ?></option>
                                                        <option value="html5"><?php echo get_phrase('HTML5'); ?></option>
                                                        <option value="system"><?php echo get_phrase('video_file'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-xl-8 d-none">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 col-form-label" for="course_overview_url"><?php echo get_phrase('course_overview_url'); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="course_overview_url" id="course_overview_url" placeholder="E.g: https://www.youtube.com/watch?v=oBtf8Yglw2w">
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                        <!-- this portion will be generated theme wise from the theme-config.json file Starts-->
                                        <?php include 'course_media_add.php'; ?>
                                        <!-- this portion will be generated theme wise from the theme-config.json file Ends-->

                                    </div> <!-- end row -->
                                </div>
                                <div class="tab-pane" id="seo">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-8">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 col-form-label" for="website_keywords"><?php echo get_phrase('meta_keywords'); ?></label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control bootstrap-tag-input" id = "meta_keywords" name="meta_keywords" data-role="tagsinput" style="width: 100%;" placeholder="<?php echo get_phrase('write_a_keyword_and_then_press_enter_button'); ?>"./>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-xl-8">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-2 col-form-label" for="meta_description"><?php echo get_phrase('meta_description'); ?></label>
                                                <div class="col-md-10">
                                                    <textarea name="meta_description" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div>
                                <div class="tab-pane" id="finish">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                                <h3 class="mt-0"><?php echo get_phrase("thank_you"); ?> !</h3>

                                                <p class="w-75 mb-2 mx-auto"><?php echo get_phrase('you_are_just_one_click_away'); ?></p>

                                                <div class="mb-3 mt-3">
                                                    <button type="button" class="btn btn-primary text-center" onclick="checkRequiredFields()"><?php echo get_phrase('submit'); ?></button>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div>

                                <ul class="list-inline mb-0 wizard text-center">
                                    <li class="previous list-inline-item">
                                        <a href="javascript:;" class="btn btn-info"> <i class="mdi mdi-arrow-left-bold"></i> </a>
                                    </li>
                                    <li class="next list-inline-item">
                                        <a href="javascript:;" class="btn btn-info"> <i class="mdi mdi-arrow-right-bold"></i> </a>
                                    </li>
                                </ul>

                            </div> <!-- tab-content -->
                        </div> <!-- end #progressbarwizard-->
                    </form>
                </div>
            </div><!-- end row-->
        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    initSummerNote(['#description']);
  });
</script>

<script type="text/javascript">
var blank_faq = jQuery('#blank_faq_field').html();
var blank_outcome = jQuery('#blank_outcome_field').html();
var blank_requirement = jQuery('#blank_requirement_field').html();
jQuery(document).ready(function() {
  jQuery('#blank_faq_field').hide();
  jQuery('#blank_outcome_field').hide();
  jQuery('#blank_requirement_field').hide();
});

function appendFaq() {
  jQuery('#faq_area').append(blank_faq);
}
function removeFaq(faqElem) {
  jQuery(faqElem).parent().parent().remove();
}

function appendOutcome() {
  jQuery('#outcomes_area').append(blank_outcome);
}
function removeOutcome(outcomeElem) {
  jQuery(outcomeElem).parent().parent().remove();
}

function appendRequirement() {
  jQuery('#requirement_area').append(blank_requirement);
}
function removeRequirement(requirementElem) {
  jQuery(requirementElem).parent().parent().remove();
}

function priceChecked(elem){
  if (jQuery('#discountCheckbox').is(':checked')) {

    jQuery('#discountCheckbox').prop( "checked", false );
  }else {

    jQuery('#discountCheckbox').prop( "checked", true );
  }
}

function topCourseChecked(elem){
  if (jQuery('#isTopCourseCheckbox').is(':checked')) {

    jQuery('#isTopCourseCheckbox').prop( "checked", false );
  }else {

    jQuery('#isTopCourseCheckbox').prop( "checked", true );
  }
}

function isFreeCourseChecked(elem) {

  if (jQuery('#'+elem.id).is(':checked')) {
    $('#price').prop('required',false);
  }else {
    $('#price').prop('required',true);
  }
}

function calculateDiscountPercentage(discounted_price) {
  if (discounted_price > 0) {
    var actualPrice = jQuery('#price').val();
    if ( actualPrice > 0) {
      var reducedPrice = actualPrice - discounted_price;
      var discountedPercentage = (reducedPrice / actualPrice) * 100;
      if (discountedPercentage > 0) {
        jQuery('#discounted_percentage').text(discountedPercentage.toFixed(2)+'%');

      }else {
        jQuery('#discounted_percentage').text('<?php echo '0%'; ?>');
      }
    }
  }
}
</script>

<script>
    function course_overview_provider_input(selected,input_tag){
        if(selected.value=='system') input_tag.type='file';
        else input_tag.type='text';
    }
</script>

<style media="screen">
body {
  overflow-x: hidden;
}
</style>
