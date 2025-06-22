<?php
echo <<<HTML

<section class="Get-Seecos">
  <div class="site-container">
     <div class="Reg_Sec">
       <div class="Reg_Box">
         <div class="Reg_Box_Header">
           <h3>Reset Password</h3>
         </div>
         <form class="Reg_Form">
          
           <div class="Reg_Input pass-Input">
            <input type="password" id="passwordField" placeholder="Password">
            <span id="togglePassword">
              <img src="$system_assets_base_url/img/showPass-icon.svg" id="toggleIcon" alt="Show Password">
            </span>
          </div>

          <div class="Reg_Input">
            <input type="password" id="passwordField" placeholder="Confirm Password">
          </div>

          
            <div class="Reg_Input">
             <input type="submit" name="" value="Sign Up" class="primary-background-color">
           </div>

         </form>

       </div>
  </div>
</div>
</section>
HTML;
?> 