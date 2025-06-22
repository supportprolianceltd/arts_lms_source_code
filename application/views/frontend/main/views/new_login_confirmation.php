<?php
echo <<<HTML
<section class="Get-Seecos">
  <div class="main-container">
     
    <div class="Reg_Sec">
      <div class="Reg_Box">
        <div class="Reg_Box_Header">
          <h3>Login Confirmation</h3>
          <p>Let us know that this email address belongs to you. Enter the code from the email sent to <b>$new_device_user_email</b></p>
        </div>
        <form class="Reg_Form" action="$system_base_url/login/new_login_confirmation/submit" method=post id="email_verification">
          <div class="Reg_Input">
            <input type="text" name="new_device_verification_code" id='new_device_verification_code' placeholder="Enter the verification code" required>
          </div>
          <a href="javascript:;" class="text-14px fw-500 text-muted hgayhsg" id="resend_mail_button" onclick="resend_new_device_verification_code()">
            <div class="float-start">Resend verification code</div>
            <div id="resend_mail_loader" class="float-start ps-1"></div>
          </a>
           
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

<style>
    
    .hgayhsg{
        color:#5199f8 !important;
        margin-top:5px !important;
        display:inline-flex !important;
    }
    
    .hgayhsg:hover{
        text-decoration:underline !important;
    }
    
</style>