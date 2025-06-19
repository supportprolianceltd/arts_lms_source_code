<?php
echo <<<HTML
  <header class="header-section margon-topGen">
    <div class="main-container">
      <div class="hero-sec">
        <div class="hero-banner"></div>
        <div class="hero-dlt">
          <div>
          <h1 class="big-text">Contact us</h1>
          </div>
        </div>

        <div class="hero-banner"></div>

      </div>
    
    </div>


  </header>

  <section class="SSSee-Paphe-Board">


      <div class="main-container">
        <h3 class="hhayhh-o">Let us know how we can help.</h3>
      <div class="cont_Main_SecOo">
        <div class="cont_Main_SecOo_1">
                  <form class="Reg_Form" action='$system_base_url/home/contact_us/submit' method=post>
                    <div class="Rr_D_Flex">
                 <div class="Reg_Input">
                  <label>First name</label>
                   <input type="text" name="first_name" placeholder="First name">
                 </div>
      
                  <div class="Reg_Input">
                    <label>Last name</label>
                   <input type="text" name="last_name" placeholder="Last name">
                 </div>
      
               </div>
      
                  <div class="Reg_Input">
                    <label>Email</label>
                   <input type="text" name="email" placeholder="you@company.com">
                 </div>
      
                  <div class="Reg_Input">
                    <label>Phone number</label>
                   <input type="text" name="phone" placeholder="Phone number">
                 </div>

                 <div class="Reg_Input">
                  <label>Address</label>
                  <input name="address" type="text" class="form-control" id="address" placeholder="Address">
                </div>
      
      
                   <div class="Reg_Input">
                    <label>Message</label>
                   <textarea name='message' placeholder="Leave us a message..."></textarea>
                 </div>

                 <div class="cheack-box">
                  <div class="form-check">
                      <input name="i_agree" class="form-check-input" type="checkbox" value="1" id="i_agree">
                      <label class="form-check-label" for="i_agree"> 
                          <p>I agree that my submitted data is being collected and stored.</p>
                      </label>
                    </div>                                  
                </div>
      
                  <div class="Reg_Input">
                   <input type="submit" name="submit" value="Send message" class="primary-background-color">
                 </div>
      
               </form>
        </div>
        <div class="cont_Main_SecOo_2">
          <div class="cont_Main_SecOo_2_Card">
            <div class="Ggarg_Tab">
              <i class="ti-email"></i>
              <h3>Email Address</h3>
              <span>$contact_info_email</span>
            </div>
      
               <div class="Ggarg_Tab">
                <i class="icon-phone"></i>
              <h3>Phone number</h3>
              <span>$contact_info_phone</span>
            </div>
      
               <div class="Ggarg_Tab">
                <i class="ti-location-pin"></i>
              <h3>Address</h3>
              <span>$contact_info_address</span>
            </div>
          </div>
        </div>
      </div>
      
      </div>
      
      
  </section>
HTML;
?>