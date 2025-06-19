<?php
    $user_data = $this->db->get_where('users', array('id' => $user_id))->row_array();
    $social_links = json_decode($user_data['social_links'], true);
    $payment_keys = json_decode($user_data['payment_keys'], true);
    $paypal_keys = $payment_keys['paypal'];
    $stripe_keys = $payment_keys['stripe'];
    $razorpay_keys = $payment_keys['razorpay'];

    $user_data_country_selected[$user_data['country']]='selected';
?>
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

                <h4 class="header-title mb-3"><?php echo get_phrase('student_edit_form'); ?></h4>

                <form class="required-form" action="<?php echo site_url('admin/users/edit/'.$user_id); ?>" enctype="multipart/form-data" method="post">
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
                                            <label class="col-md-3 col-form-label" for="first_name"><?php echo get_phrase('first_name'); ?> <span class="required">*</span> </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user_data['first_name']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="last_name"><?php echo get_phrase('last_name'); ?> <span class="required">*</span> </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user_data['last_name']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3 d-none">
                                            <label class="col-md-3 col-form-label" for="linkedin_link"><?php echo get_phrase('biography'); ?></label>
                                            <div class="col-md-9">
                                                <textarea name="biography" id = "summernote-basic" class="form-control"><?php echo $user_data['biography']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="phone"><?php echo get_phrase('Phone'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="<?php echo $user_data['phone']; ?>" id="phone" name="phone">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="country"><?php echo get_phrase('country'); ?></label>
                                            <div class="col-md-9">
                                                <select class="form-control select2" id="country" name="country" data-toggle="select2" data-allow-clear="true"  data-placeholder="<?php echo get_phrase('country'); ?> " >
                                                    <option >-- Select country --</option>
                                                    <option <?php echo $user_data_country_selected['Afghanistan'];?>>Afghanistan</option>
                                                    <option <?php echo $user_data_country_selected['Albania'];?>>Albania</option>
                                                    <option <?php echo $user_data_country_selected['Algeria'];?>>Algeria</option>
                                                    <option <?php echo $user_data_country_selected['Andorra'];?>>Andorra</option>
                                                    <option <?php echo $user_data_country_selected['Angola'];?>>Angola</option>
                                                    <option <?php echo $user_data_country_selected['Antigua and Barbuda'];?>>Antigua and Barbuda</option>
                                                    <option <?php echo $user_data_country_selected['Argentina'];?>>Argentina</option>
                                                    <option <?php echo $user_data_country_selected['Armenia'];?>>Armenia</option>
                                                    <option <?php echo $user_data_country_selected['Australia'];?>>Australia</option>
                                                    <option <?php echo $user_data_country_selected['Austria'];?>>Austria</option>
                                                    <option <?php echo $user_data_country_selected['Azerbaijan'];?>>Azerbaijan</option>
                                                    <option <?php echo $user_data_country_selected['Bahamas'];?>>Bahamas</option>
                                                    <option <?php echo $user_data_country_selected['Bahrain'];?>>Bahrain</option>
                                                    <option <?php echo $user_data_country_selected['Bangladesh'];?>>Bangladesh</option>
                                                    <option <?php echo $user_data_country_selected['Barbados'];?>>Barbados</option>
                                                    <option <?php echo $user_data_country_selected['Belarus'];?>>Belarus</option>
                                                    <option <?php echo $user_data_country_selected['Belgium'];?>>Belgium</option>
                                                    <option <?php echo $user_data_country_selected['Belize'];?>>Belize</option>
                                                    <option <?php echo $user_data_country_selected['Benin'];?>>Benin</option>
                                                    <option <?php echo $user_data_country_selected['Bhutan'];?>>Bhutan</option>
                                                    <option <?php echo $user_data_country_selected['Bolivia'];?>>Bolivia</option>
                                                    <option <?php echo $user_data_country_selected['Bosnia and Herzegovina'];?>>Bosnia and Herzegovina</option>
                                                    <option <?php echo $user_data_country_selected['Botswana'];?>>Botswana</option>
                                                    <option <?php echo $user_data_country_selected['Brazil'];?>>Brazil</option>
                                                    <option <?php echo $user_data_country_selected['Brunei'];?>>Brunei</option>
                                                    <option <?php echo $user_data_country_selected['Bulgaria'];?>>Bulgaria</option>
                                                    <option <?php echo $user_data_country_selected['Burkina'];?>>Burkina Faso</option>
                                                    <option <?php echo $user_data_country_selected['Burundi'];?>>Burundi</option>
                                                    <option <?php echo $user_data_country_selected['Cambodia'];?>>Cambodia</option>
                                                    <option <?php echo $user_data_country_selected['Cameroon'];?>>Cameroon</option>
                                                    <option <?php echo $user_data_country_selected['Canada'];?>>Canada</option>
                                                    <option <?php echo $user_data_country_selected['Cape Verde'];?>>Cape Verde</option>
                                                    <option <?php echo $user_data_country_selected['Central African Republic'];?>>Central African Republic</option>
                                                    <option <?php echo $user_data_country_selected['Chad'];?>>Chad</option>
                                                    <option <?php echo $user_data_country_selected['Chile'];?>>Chile</option>
                                                    <option <?php echo $user_data_country_selected['China'];?>>China</option>
                                                    <option <?php echo $user_data_country_selected['Colombia'];?>>Colombia</option>
                                                    <option <?php echo $user_data_country_selected['Comoros'];?>>Comoros</option>
                                                    <option <?php echo $user_data_country_selected['Congo'];?>>Congo</option>
                                                    <option <?php echo $user_data_country_selected['Congo (DRC)'];?>>Congo (DRC)</option>
                                                    <option <?php echo $user_data_country_selected['Costa Rica'];?>>Costa Rica</option>
                                                    <option <?php echo $user_data_country_selected["Côte d'Ivoire"];?>>Côte d'Ivoire</option>
                                                    <option <?php echo $user_data_country_selected['Croatia'];?>>Croatia</option>
                                                    <option <?php echo $user_data_country_selected['Cuba'];?>>Cuba</option>
                                                    <option <?php echo $user_data_country_selected['Cyprus'];?>>Cyprus</option>
                                                    <option <?php echo $user_data_country_selected['Czech Republic'];?>>Czech Republic</option>
                                                    <option <?php echo $user_data_country_selected['Denmark'];?>>Denmark</option>
                                                    <option <?php echo $user_data_country_selected['Djibouti'];?>>Djibouti</option>
                                                    <option <?php echo $user_data_country_selected['Dominica'];?>>Dominica</option>
                                                    <option <?php echo $user_data_country_selected['Dominican Republic'];?>>Dominican Republic</option>
                                                    <option <?php echo $user_data_country_selected['Ecuador'];?>>Ecuador</option>
                                                    <option <?php echo $user_data_country_selected['Egypt'];?>>Egypt</option>
                                                    <option <?php echo $user_data_country_selected['El Salvador'];?>>El Salvador</option>
                                                    <option <?php echo $user_data_country_selected['Equatorial Guinea'];?>>Equatorial Guinea</option>
                                                    <option <?php echo $user_data_country_selected['Eritrea'];?>>Eritrea</option>
                                                    <option <?php echo $user_data_country_selected['Estonia'];?>>Estonia</option>
                                                    <option <?php echo $user_data_country_selected['Ethiopia'];?>>Ethiopia</option>
                                                    <option <?php echo $user_data_country_selected['Fiji'];?>>Fiji</option>
                                                    <option <?php echo $user_data_country_selected['Finland'];?>>Finland</option>
                                                    <option <?php echo $user_data_country_selected['France'];?>>France</option>
                                                    <option <?php echo $user_data_country_selected['Gabon'];?>>Gabon</option>
                                                    <option <?php echo $user_data_country_selected['Gambia'];?>>Gambia</option>
                                                    <option <?php echo $user_data_country_selected['Georgia'];?>>Georgia</option>
                                                    <option <?php echo $user_data_country_selected['Germany'];?>>Germany</option>
                                                    <option <?php echo $user_data_country_selected['Ghana'];?>>Ghana</option>
                                                    <option <?php echo $user_data_country_selected['Greece'];?>>Greece</option>
                                                    <option <?php echo $user_data_country_selected['Grenada'];?>>Grenada</option>
                                                    <option <?php echo $user_data_country_selected['Guatemala'];?>>Guatemala</option>
                                                    <option <?php echo $user_data_country_selected['Guinea'];?>>Guinea</option>
                                                    <option <?php echo $user_data_country_selected['Guyana'];?>>Guyana</option>
                                                    <option <?php echo $user_data_country_selected['Haiti'];?>>Haiti</option>
                                                    <option <?php echo $user_data_country_selected['Honduras'];?>>Honduras</option>
                                                    <option <?php echo $user_data_country_selected['Hungary'];?>>Hungary</option>
                                                    <option <?php echo $user_data_country_selected['Iceland'];?>>Iceland</option>
                                                    <option <?php echo $user_data_country_selected['India'];?>>India</option>
                                                    <option <?php echo $user_data_country_selected['Indonesia'];?>>Indonesia</option>
                                                    <option <?php echo $user_data_country_selected['Iran'];?>>Iran</option>
                                                    <option <?php echo $user_data_country_selected['Iraq'];?>>Iraq</option>
                                                    <option <?php echo $user_data_country_selected['Ireland'];?>>Ireland</option>
                                                    <option <?php echo $user_data_country_selected['Israel'];?>>Israel</option>
                                                    <option <?php echo $user_data_country_selected['Italy'];?>>Italy</option>
                                                    <option <?php echo $user_data_country_selected['Jamaica'];?>>Jamaica</option>
                                                    <option <?php echo $user_data_country_selected['Japan'];?>>Japan</option>
                                                    <option <?php echo $user_data_country_selected['Jordan'];?>>Jordan</option>
                                                    <option <?php echo $user_data_country_selected['Kazakhstan'];?>>Kazakhstan</option>
                                                    <option <?php echo $user_data_country_selected['Kenya'];?>>Kenya</option>
                                                    <option <?php echo $user_data_country_selected['Kiribati'];?>>Kiribati</option>
                                                    <option <?php echo $user_data_country_selected['Kuwait'];?>>Kuwait</option>
                                                    <option <?php echo $user_data_country_selected['Kyrgyzstan'];?>>Kyrgyzstan</option>
                                                    <option <?php echo $user_data_country_selected['Laos'];?>>Laos</option>
                                                    <option <?php echo $user_data_country_selected['Latvia'];?>>Latvia</option>
                                                    <option <?php echo $user_data_country_selected['Lebanon'];?>>Lebanon</option>
                                                    <option <?php echo $user_data_country_selected['Lesotho'];?>>Lesotho</option>
                                                    <option <?php echo $user_data_country_selected['Liberia'];?>>Liberia</option>
                                                    <option <?php echo $user_data_country_selected['Libya'];?>>Libya</option>
                                                    <option <?php echo $user_data_country_selected['Lithuania'];?>>Lithuania</option>
                                                    <option <?php echo $user_data_country_selected['Luxembourg'];?>>Luxembourg</option>
                                                    <option <?php echo $user_data_country_selected['Madagascar'];?>>Madagascar</option>
                                                    <option <?php echo $user_data_country_selected['Malawi'];?>>Malawi</option>
                                                    <option <?php echo $user_data_country_selected['Malaysia'];?>>Malaysia</option>
                                                    <option <?php echo $user_data_country_selected['Maldives'];?>>Maldives</option>
                                                    <option <?php echo $user_data_country_selected['Mali'];?>>Mali</option>
                                                    <option <?php echo $user_data_country_selected['Malta'];?>>Malta</option>
                                                    <option <?php echo $user_data_country_selected['Mexico'];?>>Mexico</option>
                                                    <option <?php echo $user_data_country_selected['Moldova'];?>>Moldova</option>
                                                    <option <?php echo $user_data_country_selected['Monaco'];?>>Monaco</option>
                                                    <option <?php echo $user_data_country_selected['Mongolia'];?>>Mongolia</option>
                                                    <option <?php echo $user_data_country_selected['Montenegro'];?>>Montenegro</option>
                                                    <option <?php echo $user_data_country_selected['Morocco'];?>>Morocco</option>
                                                    <option <?php echo $user_data_country_selected['Mozambique'];?>>Mozambique</option>
                                                    <option <?php echo $user_data_country_selected['Myanmar'];?>>Myanmar</option>
                                                    <option <?php echo $user_data_country_selected['Namibia'];?>>Namibia</option>
                                                    <option <?php echo $user_data_country_selected['Nepal'];?>>Nepal</option>
                                                    <option <?php echo $user_data_country_selected['Netherlands'];?>>Netherlands</option>
                                                    <option <?php echo $user_data_country_selected['New Zealand'];?>>New Zealand</option>
                                                    <option <?php echo $user_data_country_selected['Nicaragua'];?>>Nicaragua</option>
                                                    <option <?php echo $user_data_country_selected['Niger'];?>>Niger</option>
                                                    <option <?php echo $user_data_country_selected['Nigeria'];?>>Nigeria</option>
                                                    <option <?php echo $user_data_country_selected['Norway'];?>>Norway</option>
                                                    <option <?php echo $user_data_country_selected['Oman'];?>>Oman</option>
                                                    <option <?php echo $user_data_country_selected['Pakistan'];?>>Pakistan</option>
                                                    <option <?php echo $user_data_country_selected['Panama'];?>>Panama</option>
                                                    <option <?php echo $user_data_country_selected['Paraguay'];?>>Paraguay</option>
                                                    <option <?php echo $user_data_country_selected['Peru'];?>>Peru</option>
                                                    <option <?php echo $user_data_country_selected['Philippines'];?>>Philippines</option>
                                                    <option <?php echo $user_data_country_selected['Poland'];?>>Poland</option>
                                                    <option <?php echo $user_data_country_selected['Portugal'];?>>Portugal</option>
                                                    <option <?php echo $user_data_country_selected['Qatar'];?>>Qatar</option>
                                                    <option <?php echo $user_data_country_selected['Romania'];?>>Romania</option>
                                                    <option <?php echo $user_data_country_selected['Russia'];?>>Russia</option>
                                                    <option <?php echo $user_data_country_selected['Saudi Arabia'];?>>Saudi Arabia</option>
                                                    <option <?php echo $user_data_country_selected['Senegal'];?>>Senegal</option>
                                                    <option <?php echo $user_data_country_selected['Singapore'];?>>Singapore</option>
                                                    <option <?php echo $user_data_country_selected['South Africa'];?>>South Africa</option>
                                                    <option <?php echo $user_data_country_selected['Spain'];?>>Spain</option>
                                                    <option <?php echo $user_data_country_selected['Sweden'];?>>Sweden</option>
                                                    <option <?php echo $user_data_country_selected['Switzerland'];?>>Switzerland</option>
                                                    <option <?php echo $user_data_country_selected['Thailand'];?>>Thailand</option>
                                                    <option <?php echo $user_data_country_selected['Tunisia'];?>>Tunisia</option>
                                                    <option <?php echo $user_data_country_selected['Turkey'];?>>Turkey</option>
                                                    <option <?php echo $user_data_country_selected['Ukraine'];?>>Ukraine</option>
                                                    <option <?php echo $user_data_country_selected['United Arab Emirates'];?>>United Arab Emirates</option>
                                                    <option <?php echo $user_data_country_selected['United Kingdom'];?>>United Kingdom</option>
                                                    <option <?php echo $user_data_country_selected['United States'];?>>United States</option>
                                                    <option <?php echo $user_data_country_selected['Vietnam'];?>>Vietnam</option>
                                                    <option <?php echo $user_data_country_selected['Yemen'];?>>Yemen</option>
                                                    <option <?php echo $user_data_country_selected['Zimbabwe'];?>>Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="city"><?php echo get_phrase('city'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="<?php echo $user_data['city']; ?>" id="city" name="city">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="post_code"><?php echo get_phrase('post_code'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="<?php echo $user_data['post_code']; ?>" id="post_code" name="post_code">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="address"><?php echo get_phrase('address'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="<?php echo $user_data['address']; ?>" id="address" name="address">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="ni_no"><?php echo get_phrase('ni_no'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="ni_no" name="ni_no" value="<?php echo $user_data['ni_no']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="building_no"><?php echo get_phrase('building_no'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="building_no" name="building_no" value="<?php echo $user_data['building_no']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="off_the_job_training"><?php echo get_phrase('off_the_job_training'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="off_the_job_training" name="off_the_job_training" value="<?php echo $user_data['off_the_job_training']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="accessor"><?php echo get_phrase('accessor'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="accessor" name="accessor" value="<?php echo $user_data['accessor']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="ui_no"><?php echo get_phrase('ui_no'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="ui_no" name="ui_no" value="<?php echo $user_data['ui_no']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="cohort"><?php echo get_phrase('cohort'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="cohort" name="cohort" value="<?php echo $user_data['cohort']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="employer"><?php echo get_phrase('employer'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="employer" name="employer" value="<?php echo $user_data['employer']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="partner"><?php echo get_phrase('partner'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="partner" name="partner" value="<?php echo $user_data['partner']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="expected_completion_date"><?php echo get_phrase('expected_completion_date'); ?></label>
                                            <div class="col-md-9">
                                                <input type="date" class="form-control" id="expected_completion_date" name="expected_completion_date" value="<?php echo $user_data['expected_completion_date']; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="user_image"><?php echo get_phrase('user_image'); ?></label>
                                            <div class="col-md-9">
                                                <div class="d-flex">
                                                  <div class="">
                                                      <img class = "rounded-circle img-thumbnail" src="<?php echo $this->user_model->get_user_image_url($user_data['id']);?>" alt="" style="height: 50px; width: 50px;">
                                                  </div>
                                                  <div class="flex-grow-1 mt-1 pl-3">
                                                      <div class="input-group">
                                                          <div class="custom-file">
                                                              <input type="file" class="custom-file-input" name = "user_image" id="user_image" onchange="changeTitleOfImageUploader(this)" accept="image/*">
                                                              <label class="custom-file-label ellipsis" for="user_image"><?php echo get_phrase('choose_user_image'); ?></label>
                                                          </div>
                                                      </div>
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
                                            <label class="col-md-3 col-form-label" for="email"> <?php echo get_phrase('email'); ?> <span class="required">*</span> </label>
                                            <div class="col-md-9">
                                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $user_data['email']; ?>" required>
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
                                                <input type="text" id="facebook_link" name="facebook_link" class="form-control" value="<?php echo $social_links['facebook']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="twitter_link"><?php echo get_phrase('twitter'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" id="twitter_link" name="twitter_link" class="form-control" value="<?php echo $social_links['twitter']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="linkedin_link"><?php echo get_phrase('linkedin'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" id="linkedin_link" name="linkedin_link" class="form-control" value="<?php echo $social_links['linkedin']; ?>">
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
                                            $user_keys = json_decode($user_data['payment_keys'], true);
                                            ?>
                                            <div class="<?php if($payment_gateway['status'] != 1 || !addon_status($payment_gateway['identifier']) && $payment_gateway['is_addon'] == 1) echo 'd-none'; ?>">
                                                <h4><?php echo get_phrase($payment_gateway['title']); ?></h4>
                                                <?php foreach($keys as $index => $value):
                                                    if(array_key_exists($payment_gateway['identifier'], $user_keys)){
                                                        if(array_key_exists($index, $user_keys[$payment_gateway['identifier']])){
                                                            $value = $user_keys[$payment_gateway['identifier']][$index];
                                                        }else{
                                                            $value = '';
                                                        }
                                                    }else{
                                                        $value = '';
                                                    }
                                                    ?>

                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-3 col-form-label" for="<?php echo $payment_gateway['identifier'].$index; ?>"> <?php echo get_phrase($index); ?></label>
                                                        <div class="col-md-9">
                                                            <input type="text" id="<?php echo $payment_gateway['identifier'].$index; ?>" name="gateways[<?php echo $payment_gateway['identifier']; ?>][<?php echo $index; ?>]" value="<?php echo $value; ?>" class="form-control">
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

                            <ul class="list-inline mb-0 wizard">
                                <li class="previous list-inline-item">
                                    <a href="javascript:;" class="btn btn-info">Previous</a>
                                </li>
                                <li class="next list-inline-item float-right">
                                    <a href="javascript:;" class="btn btn-info">Next</a>
                                </li>
                            </ul>

                        </div> <!-- tab-content -->
                    </div> <!-- end #progressbarwizard-->
                </form>

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div>
</div>
