<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?> </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-3"><?php echo get_phrase('instructor_add_form'); ?></h4>

                <form class="required-form" action="<?php echo site_url('admin/instructors/add'); ?>" enctype="multipart/form-data" method="post">
                    <div id="progressbarwizard">
                        <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                            <li class="nav-item">
                                <a href="#basic_info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-face-profile mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('basic_info'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#login_credentials" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-lock mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('login_credentials'); ?></span>
                                </a>
                            </li>
                            <!--<li class="nav-item">
                                <a href="#social_information" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-wifi mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('social_information'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#payment_info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-currency-eur mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('payment_info'); ?></span>
                                </a>
                            </li>-->
                            <li class="nav-item">
                                <a href="#finish" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('finish'); ?></span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content b-0 mb-0">

                            <div id="bar" class="progress mb-3" style="height: 7px;">
                                <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                            </div>

                            <div class="tab-pane" id="basic_info">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="first_name"><?php echo get_phrase('first_name'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="last_name"><?php echo get_phrase('last_name'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3 d-none">
                                            <label class="col-md-3 col-form-label" for="linkedin_link"><?php echo get_phrase('biography'); ?></label>
                                            <div class="col-md-9">
                                                <textarea name="biography" id = "summernote-basic" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="phone"><?php echo get_phrase('Phone'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="phone" name="phone">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="country"><?php echo get_phrase('country'); ?></label>
                                            <div class="col-md-9">
                                                <select class="form-control select2" id="country" name="country" data-toggle="select2" data-allow-clear="true"  data-placeholder="<?php echo get_phrase('country'); ?> " >
                                                    <option>-- Select country --</option>
                                                    <option>Afghanistan</option>
                                                    <option>Albania</option>
                                                    <option>Algeria</option>
                                                    <option>Andorra</option>
                                                    <option>Angola</option>
                                                    <option>Antigua and Barbuda</option>
                                                    <option>Argentina</option>
                                                    <option>Armenia</option>
                                                    <option>Australia</option>
                                                    <option>Austria</option>
                                                    <option>Azerbaijan</option>
                                                    <option>Bahamas</option>
                                                    <option>Bahrain</option>
                                                    <option>Bangladesh</option>
                                                    <option>Barbados</option>
                                                    <option>Belarus</option>
                                                    <option>Belgium</option>
                                                    <option>Belize</option>
                                                    <option>Benin</option>
                                                    <option>Bhutan</option>
                                                    <option>Bolivia</option>
                                                    <option>Bosnia and Herzegovina</option>
                                                    <option>Botswana</option>
                                                    <option>Brazil</option>
                                                    <option>Brunei</option>
                                                    <option>Bulgaria</option>
                                                    <option>Burkina Faso</option>
                                                    <option>Burundi</option>
                                                    <option>Cambodia</option>
                                                    <option>Cameroon</option>
                                                    <option>Canada</option>
                                                    <option>Cape Verde</option>
                                                    <option>Central AfricanRepublic</option>
                                                    <option>Chad</option>
                                                    <option>Chile</option>
                                                    <option>China</option>
                                                    <option>Colombia</option>
                                                    <option>Comoros</option>
                                                    <option>Congo</option>
                                                    <option>Congo (DRC)</option>
                                                    <option>Costa Rica</option>
                                                    <option>Côte d'Ivoire</option>
                                                    <option>Croatia</option>
                                                    <option>Cuba</option>
                                                    <option>Cyprus</option>
                                                    <option>Czech Republic</option>
                                                    <option>Denmark</option>
                                                    <option>Djibouti</option>
                                                    <option>Dominica</option>
                                                    <option>DominicanRepublic</option>
                                                    <option>Ecuador</option>
                                                    <option>Egypt</option>
                                                    <option>El Salvador</option>
                                                    <option>Equatorial Guinea</option>
                                                    <option>Eritrea</option>
                                                    <option>Estonia</option>
                                                    <option>Ethiopia</option>
                                                    <option>Fiji</option>
                                                    <option>Finland</option>
                                                    <option>France</option>
                                                    <option>Gabon</option>
                                                    <option>Gambia</option>
                                                    <option>Georgia</option>
                                                    <option>Germany</option>
                                                    <option>Ghana</option>
                                                    <option>Greece</option>
                                                    <option>Grenada</option>
                                                    <option>Guatemala</option>
                                                    <option>Guinea</option>
                                                    <option>Guyana</option>
                                                    <option>Haiti</option>
                                                    <option>Honduras</option>
                                                    <option>Hungary</option>
                                                    <option>Iceland</option>
                                                    <option>India</option>
                                                    <option>Indonesia</option>
                                                    <option>Iran</option>
                                                    <option>Iraq</option>
                                                    <option>Ireland</option>
                                                    <option>Israel</option>
                                                    <option>Italy</option>
                                                    <option>Jamaica</option>
                                                    <option>Japan</option>
                                                    <option>Jordan</option>
                                                    <option>Kazakhstan</option>
                                                    <option>Kenya</option>
                                                    <option>Kiribati</option>
                                                    <option>Kuwait</option>
                                                    <option>Kyrgyzstan</option>
                                                    <option>Laos</option>
                                                    <option>Latvia</option>
                                                    <option>Lebanon</option>
                                                    <option>Lesotho</option>
                                                    <option>Liberia</option>
                                                    <option>Libya</option>
                                                    <option>Lithuania</option>
                                                    <option>Luxembourg</option>
                                                    <option>Madagascar</option>
                                                    <option>Malawi</option>
                                                    <option>Malaysia</option>
                                                    <option>Maldives</option>
                                                    <option>Mali</option>
                                                    <option>Malta</option>
                                                    <option>Mexico</option>
                                                    <option>Moldova</option>
                                                    <option>Monaco</option>
                                                    <option>Mongolia</option>
                                                    <option>Montenegro</option>
                                                    <option>Morocco</option>
                                                    <option>Mozambique</option>
                                                    <option>Myanmar</option>
                                                    <option>Namibia</option>
                                                    <option>Nepal</option>
                                                    <option>Netherlands</option>
                                                    <option>New Zealand</option>
                                                    <option>Nicaragua</option>
                                                    <option>Niger</option>
                                                    <option>Nigeria</option>
                                                    <option>Norway</option>
                                                    <option>Oman</option>
                                                    <option>Pakistan</option>
                                                    <option>Panama</option>
                                                    <option>Paraguay</option>
                                                    <option>Peru</option>
                                                    <option>Philippines</option>
                                                    <option>Poland</option>
                                                    <option>Portugal</option>
                                                    <option>Qatar</option>
                                                    <option>Romania</option>
                                                    <option>Russia</option>
                                                    <option>Saudi Arabia</option>
                                                    <option>Senegal</option>
                                                    <option>Singapore</option>
                                                    <option>South Africa</option>
                                                    <option>Spain</option>
                                                    <option>Sweden</option>
                                                    <option>Switzerland</option>
                                                    <option>Thailand</option>
                                                    <option>Tunisia</option>
                                                    <option>Turkey</option>
                                                    <option>Ukraine</option>
                                                    <option>United Arab Emirates</option>
                                                    <option>United Kingdom</option>
                                                    <option>United States</option>
                                                    <option>Vietnam</option>
                                                    <option>Yemen</option>
                                                    <option>Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="city"><?php echo get_phrase('city'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="city" name="city">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="post_code"><?php echo get_phrase('post_code'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="post_code" name="post_code">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="address"><?php echo get_phrase('address'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="address" name="address">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="ni_no"><?php echo get_phrase('ni_no'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="ni_no" name="ni_no">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="building_no"><?php echo get_phrase('building_no'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="building_no" name="building_no">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="off_the_job_training"><?php echo get_phrase('off_the_job_training'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="off_the_job_training" name="off_the_job_training">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="accessor"><?php echo get_phrase('accessor'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="accessor" name="accessor">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="ui_no"><?php echo get_phrase('ui_no'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="ui_no" name="ui_no">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="cohort"><?php echo get_phrase('cohort'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="cohort" name="cohort">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="employer"><?php echo get_phrase('employer'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="employer" name="employer">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="partner"><?php echo get_phrase('partner'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="partner" name="partner">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="expected_completion_date"><?php echo get_phrase('expected_completion_date'); ?></label>
                                            <div class="col-md-9">
                                                <input type="date" class="form-control" id="expected_completion_date" name="expected_completion_date">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="user_image"><?php echo get_phrase('user_image'); ?></label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="user_image" name="user_image" accept="image/*" onchange="changeTitleOfImageUploader(this)">
                                                        <label class="custom-file-label" for="user_image"><?php echo get_phrase('choose_user_image'); ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>

                            <div class="tab-pane" id="login_credentials">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="email"><?php echo get_phrase('email'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="email" id="email" name="email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="password"><?php echo get_phrase('password'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="password" id="password" name="password" class="form-control" required>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>

                            <div class="tab-pane" id="social_information">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="facebook_link"> <?php echo get_phrase('facebook'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" id="facebook_link" name="facebook_link" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="twitter_link"><?php echo get_phrase('twitter'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" id="twitter_link" name="twitter_link" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="linkedin_link"><?php echo get_phrase('linkedin'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" id="linkedin_link" name="linkedin_link" class="form-control">
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>
                            <div class="tab-pane" id="payment_info">
                                <div class="row">
                                    <div class="col-12">

                                        <?php $payment_gateways = $this->db->get('payment_gateways')->result_array();
                                            foreach($payment_gateways as $key => $payment_gateway):
                                            $keys = json_decode($payment_gateway['keys'], true);
                                            ?>
                                            <div class="<?php if($payment_gateway['status'] != 1 || !addon_status($payment_gateway['identifier']) && $payment_gateway['is_addon'] == 1) echo 'd-none'; ?>">
                                                <h4><?php echo get_phrase($payment_gateway['title']); ?></h4>
                                                <?php foreach($keys as $index => $value): ?>
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="<?php echo $payment_gateway['identifier'].$index; ?>"> <?php echo get_phrase($index); ?></label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="<?php echo $payment_gateway['identifier'].$index; ?>" name="gateways[<?php echo $payment_gateway['identifier']; ?>][<?php echo $index; ?>]" class="form-control">
                                                            <small><?php echo get_phrase("required_for_instructor"); ?></small>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                                <hr>
                                            </div>
                                        <?php endforeach; ?>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>
                            <div class="tab-pane" id="finish">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                            <h3 class="mt-0"><?php echo get_phrase('thank_you'); ?> !</h3>

                                            <p class="w-75 mb-2 mx-auto"><?php echo get_phrase('you_are_just_one_click_away'); ?></p>

                                            <div class="mb-3">
                                                <button type="button" class="btn btn-primary" onclick="checkRequiredFields()" name="button"><?php echo get_phrase('submit'); ?></button>
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

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div>
</div>
