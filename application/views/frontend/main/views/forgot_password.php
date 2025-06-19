<?php
echo <<<HTML
<section class="Get-Seecos">
  <div class="main-container">
     
    <div class="Reg_Sec">
      <div class="Reg_Box">
        <div class="Reg_Box_Header">
          <h3>Forgot Password?</h3>
          <p>Enter Registered email address</p>
        </div>
        <form class="Reg_Form" action='$system_base_url/login/forgot_password/frontend' method=post>
          <div class="Reg_Input">
            <input type="email" name="email" placeholder="Email" required>
          </div>
           
           <div class="Reg_Input">
            <input type="submit" name="" value="Continue" class="primary-background-color">
          </div>

        </form>

      </div>
    </div>
      
    </div>
</section>
HTML;
?>