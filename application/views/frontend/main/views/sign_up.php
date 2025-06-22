<?php
echo <<<HTML
<section class="Get-Seecos">
  <div class="site-container">
     <div class="Reg_Sec">
       <div class="Reg_Box">
         <div class="Reg_Box_Header">
           <h3>Sign Up to continue</h3>
         </div>
         <form class="Reg_Form" action='$system_base_url/login/register' method=post enctype="multipart/form-data">
           <div class="Reg_Input">
             <input type="text" name="first_name" placeholder="First Name*" required>
           </div>
           <div class="Reg_Input">
             <input type="text" name="last_name" placeholder="Last Name*" required>
           </div>
           <div class="Reg_Input">
             <input type="email" name="email" placeholder="Email*" required>
           </div>
           <div class="Reg_Input">
             <input type="phone" name="phone" placeholder="Phone">
           </div>
           <div class="Reg_Input pass-Input">
            <input type="password" id="passwordField" name='password' placeholder="Password*" required>
            <span id="togglePassword">
              <img src="$system_assets_base_url/img/showPass-icon.svg" id="toggleIcon" alt="Show Password">
            </span>
          </div>

          <div class="Reg_Input d-none">
            <input type="password" id="passwordField2" placeholder="Confirm Password*">
          </div>

            <div class="Reg_Input">
             <p>By clicking "Sign Up," you agree to our <a href="terms_and_condition">Terms of Use</a> and our <a href="privacy">Privacy Policy</a>.</p>
           </div>
            <div class="Reg_Input">
             <input type="submit" name="" value="Sign Up" class="primary-background-color">
           </div>

         </form>

          <div class="Reg_Box_Foot">
            <h6><span>Or</span></h6>
            <button class="google-signup-BTN d-none"> <img src="$system_assets_base_url/img/google-icon.svg" /> Sign up with Google</button>
            <p>Already have an account? <a href="$system_base_url/home/login">Log in</a></p>
          </div>
       </div>
  </div>
</div>
</section>
HTML;
?> 
