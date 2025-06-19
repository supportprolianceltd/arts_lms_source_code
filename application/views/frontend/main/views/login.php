<?php
echo <<<HTML

<section class="Get-Seecos">
  <div class="main-container">
     
     <div class="Reg_Sec">
       <div class="Reg_Box">
         <div class="Reg_Box_Header">
           <h3>Welcome back</h3>
           <p>Log in to your account</p>
         </div>
         <form class="Reg_Form" action='$system_base_url/login/validate_login' method=post>
           <div class="Reg_Input">
             <input type="email" name="email" placeholder="Email" required>
           </div>
           <div class="Reg_Input pass-Input">
            <input type="password" id="passwordField" name='password' placeholder="Password" required>
            <span id="togglePassword">
              <img src="$system_assets_base_url/img/showPass-icon.svg" id="toggleIcon" alt="Show Password">
            </span>
          </div>
            <div class="Reg_Input">
             <a href="$system_base_url/login/forgot_password_request">Forgot Password?</a>
           </div>
            <div class="Reg_Input">
             <input type="submit" name="" value="Log In" class="primary-background-color">
           </div>

         </form>

          <div class="Reg_Box_Foot">
            <h6><span>Or</span></h6>
            <button class="google-signup-BTN d-none"> <img src="$system_assets_base_url/img/google-icon.svg" /> Sign in with Google</button>
            <p>Don't have an account? <a href="$system_base_url/home/sign_up">Let’s get started</a></p>
          </div>
       </div>
     </div>
      
    </div>
</section>
HTML;
?>