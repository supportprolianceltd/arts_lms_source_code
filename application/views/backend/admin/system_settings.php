<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('system_settings'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-3 header-title"><?php echo get_phrase('system_settings');?></h4>

                    <form class="required-form" action="<?php echo site_url('admin/system_settings/system_update'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="system_name"><?php echo get_phrase('website_name'); ?><span class="required">*</span></label>
                            <input type="text" name = "system_name" id = "system_name" class="form-control" value="<?php echo get_settings('system_name');  ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="system_title"><?php echo get_phrase('website_title'); ?><span class="required">*</span></label>
                            <input type="text" name = "system_title" id = "system_title" class="form-control" value="<?php echo get_settings('system_title');  ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="website_keywords"><?php echo get_phrase('website_keywords'); ?></label>
                            <input type="text" class="form-control bootstrap-tag-input" id = "website_keywords" name="website_keywords" data-role="tagsinput" style="width: 100%;" value="<?php echo get_settings('website_keywords');  ?>"/>
                        </div>

                        <div class="form-group">
                            <label for="website_description"><?php echo get_phrase('website_description'); ?></label>
                            <textarea name="website_description" id = "website_description" class="form-control" rows="5"><?php echo get_settings('website_description');  ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="author"><?php echo get_phrase('author'); ?></label>
                            <input type="text" name = "author" id = "author" class="form-control" value="<?php echo get_settings('author');  ?>">
                        </div>

                        <div class="form-group">
                            <label for="slogan"><?php echo get_phrase('slogan'); ?><span class="required">*</span></label>
                            <input type="text" name = "slogan" id = "slogan" class="form-control" value="<?php echo get_settings('slogan');  ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="system_email"><?php echo get_phrase('system_email'); ?><span class="required">*</span></label>
                            <input type="text" name = "system_email" id = "system_email" class="form-control" value="<?php echo get_settings('system_email');  ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="address"><?php echo get_phrase('address'); ?></label>
                            <textarea name="address" id = "address" class="form-control" rows="5"><?php echo get_settings('address');  ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="phone"><?php echo get_phrase('phone'); ?></label>
                            <input type="text" name = "phone" id = "phone" class="form-control" value="<?php echo get_settings('phone');  ?>">
                        </div>

                        <div class="form-group">
                            <label for="youtube_api_key"><?php echo get_phrase('youtube_API_key'); ?><span class="required">*</span> &nbsp; <a href = "https://developers.google.com/youtube/v3/getting-started" target = "_blank" style="color: #a7a4a4">(<?php echo get_phrase('get_YouTube_API_key'); ?> <i class="mdi mdi-open-in-new"></i>)</a></label>
                            <input type="text" name = "youtube_api_key" id = "youtube_api_key" class="form-control" value="<?php echo get_settings('youtube_api_key');  ?>" required>
                            <a href="https://support.google.com/googleapi/answer/6158841" target="_blank">
                                <small class="badge badge-light">
                                    <?php echo get_phrase('If you want to use Google Drive video, you need to enable the Google Drive service in this API'); ?>
                                    <i class="mdi mdi-open-in-new"></i>
                                </small>
                            </a>
                        </div>

                        <div class="form-group">
                            <label for="vimeo_api_key"><?php echo get_phrase('vimeo_API_key'); ?><span class="required">*</span> &nbsp; <a href = "https://www.youtube.com/watch?v=Wwy9aibAd54" target = "_blank" style="color: #a7a4a4">(<?php echo get_phrase('get_Vimeo_API_key'); ?> <i class="mdi mdi-open-in-new"></i>)</a></label>
                            <input type="text" name = "vimeo_api_key" id = "vimeo_api_key" class="form-control" value="<?php echo get_settings('vimeo_api_key');  ?>" required>
                        </div>

                        <div class="form-group d-none">
                            <label for="purchase_code"><?php echo get_phrase('purchase_code'); ?><span class="required">*</span></label>
                            <input type="text" name = "purchase_code" id = "purchase_code" class="form-control" value="<?php echo get_settings('purchase_code');  ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="language"><?php echo get_phrase('system_language'); ?></label>
                            <select class="form-control select2" data-toggle="select2" name="language" id="language">
                                <?php foreach ($languages as $language): ?>
                                    <option value="<?php echo $language; ?>" <?php if(get_settings('language') == $language) echo 'selected'; ?>><?php echo ucfirst($language); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="language"><?php echo get_phrase('student_email_verification'); ?></label>
                            <select class="form-control select2" data-toggle="select2" name="student_email_verification" id="student_email_verification">
                                <option value="enable" <?php if(get_settings('student_email_verification') == "enable") echo 'selected'; ?>><?php echo get_phrase('enable'); ?></option>
                                <option value="disable" <?php if(get_settings('student_email_verification') == "disable") echo 'selected'; ?>><?php echo get_phrase('disable'); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="language"><?php echo get_phrase('course_accessibility'); ?></label>
                            <select class="form-control select2" data-toggle="select2" name="course_accessibility" id="course_accessibility">
                                <option value="publicly" <?php if(get_settings('course_accessibility') == "publicly") echo 'selected'; ?>><?php echo get_phrase('publicly'); ?></option>
                                <option value="only_logged_in_users" <?php if(get_settings('course_accessibility') == "only_logged_in_users") echo 'selected'; ?>><?php echo get_phrase('only_logged_in_users'); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="allowed_device_number_of_loging"><?php echo get_phrase('number_of_authorized_devices'); ?><span class="required">*</span></label>
                            <select class="form-control select2" data-toggle="select2" name="allowed_device_number_of_loging" id="allowed_device_number_of_loging">
                                <option value="1" <?php if(get_settings('allowed_device_number_of_loging') == '1') echo 'selected'; ?>><?php echo get_phrase('1_device'); ?></option>
                                <option value="2" <?php if(get_settings('allowed_device_number_of_loging') == '2') echo 'selected'; ?>><?php echo get_phrase('2_devices'); ?></option>
                                <option value="3" <?php if(get_settings('allowed_device_number_of_loging') == '3') echo 'selected'; ?>><?php echo get_phrase('3_devices'); ?></option>
                                <option value="4" <?php if(get_settings('allowed_device_number_of_loging') == '4') echo 'selected'; ?>><?php echo get_phrase('4_devices'); ?></option>
                                <option value="5" <?php if(get_settings('allowed_device_number_of_loging') == '5') echo 'selected'; ?>><?php echo get_phrase('5_devices'); ?></option>
                                <option value="6" <?php if(get_settings('allowed_device_number_of_loging') == '6') echo 'selected'; ?>><?php echo get_phrase('6_devices'); ?></option>
                                <option value="7" <?php if(get_settings('allowed_device_number_of_loging') == '7') echo 'selected'; ?>><?php echo get_phrase('7_devices'); ?></option>
                                <option value="8" <?php if(get_settings('allowed_device_number_of_loging') == '8') echo 'selected'; ?>><?php echo get_phrase('8_devices'); ?></option>
                                <option value="9" <?php if(get_settings('allowed_device_number_of_loging') == '9') echo 'selected'; ?>><?php echo get_phrase('9_devices'); ?></option>
                                <option value="10" <?php if(get_settings('allowed_device_number_of_loging') == '10') echo 'selected'; ?>><?php echo get_phrase('10_devices'); ?></option>
                                <option value="11" <?php if(get_settings('allowed_device_number_of_loging') == '11') echo 'selected'; ?>><?php echo get_phrase('11_devices'); ?></option>
                                <option value="0" <?php if(get_settings('allowed_device_number_of_loging') == '0') echo 'selected'; ?>><?php echo get_phrase('unlimited_device'); ?></option>
                                <option value="-1" <?php if(get_settings('allowed_device_number_of_loging') == '-1') echo 'selected'; ?>><?php echo get_phrase('turn_off'); ?></option>
                            </select>
                            <!--<input type="number" name = "allowed_device_number_of_loging" id = "allowed_device_number_of_loging" class="form-control" value="<?php echo get_settings('allowed_device_number_of_loging');  ?>" min="0" step=1 required>-->
                            <small><?php echo get_phrase('how_many_devices_do_you_want_to_allow_for_logging_in_using_a_single_account'); ?>?</small>
                        </div>

                        <div class="form-group toggleMinimumWatchField">
                            <label for="course_selling_tax"><?php echo get_phrase('course_selling_tax'); ?> (%) <span class="required">*</span></label>
                            <div class="input-group">
                                <input type="number" value="<?php echo get_settings('course_selling_tax'); ?>" min="0" max="100" id="course_selling_tax" name="course_selling_tax" class="form-control" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <small><?php echo get_phrase('enter_0_if_you_want_to_disable_the_tax_option') ?></small>
                        </div>

                        <div class="form-group">
                            <label for="google_analytics_id"><?php echo get_phrase('google_analytics_id'); ?></label>
                            <input type="text" name = "google_analytics_id" id = "google_analytics_id" class="form-control" value="<?php echo get_settings('google_analytics_id');  ?>">
                            <small><?php echo get_phrase('keep_it_blank_if_you_want_to_disable_it') ?></small>
                        </div>

                        <div class="form-group">
                            <label for="meta_pixel_id"><?php echo get_phrase('meta_pixel_id'); ?></label>
                            <input type="text" name = "meta_pixel_id" id = "meta_pixel_id" class="form-control" value="<?php echo get_settings('meta_pixel_id');  ?>">
                            <small><?php echo get_phrase('keep_it_blank_if_you_want_to_disable_it') ?></small>
                        </div>

                        <div class="form-group">
                            <label for="footer_text"><?php echo get_phrase('footer_text'); ?></label>
                            <input type="text" name = "footer_text" id = "footer_text" class="form-control" value="<?php echo get_settings('footer_text');  ?>">
                        </div>

                        <div class="form-group">
                            <label for="footer_link"><?php echo get_phrase('banner_link'); ?></label>
                            <input type="text" name = "footer_link" id = "footer_link" class="form-control" value="<?php echo get_settings('footer_link');  ?>">
                        </div>

                        <div class="form-group">
                            <label for="timezone"><?php echo get_phrase('Timezone'); ?></label>
                            <select class="form-control select2" data-toggle="select2" name="timezone" id="timezone">
                                <?php $timezones =  DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?>
                                <?php foreach ($timezones as $timezone): ?>
                                    <option value="<?php echo $timezone; ?>" <?php if(get_settings('timezone') == $timezone) echo 'selected'; ?>><?php echo $timezone; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="language"><?php echo get_phrase('public_signup'); ?></label>
                            <select class="form-control select2" data-toggle="select2" name="public_signup" id="public_signup">
                                <option value="enable" <?php if(get_settings('public_signup') == "enable") echo 'selected'; ?>><?php echo get_phrase('enable'); ?></option>
                                <option value="disable" <?php if(get_settings('public_signup') == "disable") echo 'selected'; ?>><?php echo get_phrase('disable'); ?></option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label><?php echo get_phrase('Can students disable their own accounts?'); ?></label><br>
                            <input type="radio" id="account_disable_yes" value="1" name="account_disable" <?php if(get_settings('account_disable') == 1) echo 'checked'; ?>> <label for="account_disable_yes"><?php echo get_phrase('Yes'); ?></label>
                            &nbsp;&nbsp;
                            <input type="radio" id="account_disable_no" value="0" name="account_disable" <?php if(get_settings('account_disable') == 0) echo 'checked'; ?>> <label for="account_disable_no"><?php echo get_phrase('No'); ?></label>
                        </div>


                        <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase('save'); ?></button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
    <div class="col-xl-5 d-none">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-3 header-title"><?php echo get_phrase('update_product');?></h4>

                    <form action="<?php echo site_url('updater/update'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-2">
                            <label><?php echo get_phrase('file'); ?></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_name" name="file_name" required onchange="changeTitleOfImageUploader(this)">
                                    <label class="custom-file-label" for="file_name"><?php echo get_phrase('update_product'); ?></label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><?php echo get_phrase('update'); ?></button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div>
    </div>
</div>
