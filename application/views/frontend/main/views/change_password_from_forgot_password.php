<?php
echo <<<HTML

<section class="Get-Seecos">
  <div class="main-container">
     
     <div class="Reg_Sec">
       <div class="Reg_Box">
         <div class="Reg_Box_Header">
           <h3>Change Password</h3>
           <p>Change your password to secure your account</p>
         </div>
         <form class="Reg_Form" action='$system_base_url/login/change_password/$verification_code' method=post>
           <div class="Reg_Input pass-Input">
            <input type="password" id="passwordField" name='new_password' placeholder="New Password" required>
            <span id="togglePassword">
              <img src="$system_assets_base_url/img/showPass-icon.svg" id="toggleIcon" alt="Show Password">
            </span>
          </div>
          <div class="Reg_Input d-none">
            <input type="password" id="passwordField2" name='confirm_password' placeholder="Confirm Password*" require>
          </div>
            <div class="Reg_Input">
             <input type="submit" name="" value="Log In" class="primary-background-color">
           </div>

         </form>

       </div>
     </div>
      
    </div>
</section>
HTML;
?>