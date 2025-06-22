<?php
echo <<<HTML
<section class="Get-Seecos">
  <div class="main-container">
     
    <div class="Reg_Sec">
      <div class="Reg_Box">
        <div class="Reg_Box_Header">
          <h3>Email Verification</h3>
          <p>Enter your verification code here</p>
        </div>
        <form class="Reg_Form" action='$system_base_url/login/verify_email_address' method=post>
          <div class="Reg_Input">
            <input type="text" name="verification_code" id='verification_code' placeholder="Enter your verification code" required>
          </div>
          <a href="javascript:;" class="text-14px fw-500 text-muted" id="resend_mail_button" onclick="resend_verification_code()">
              <div class="float-start trfs_emah">Resend mail</div>
              <div id="resend_mail_loader" class="float-start ps-1"></div>
          </a>
           
           <div class="Reg_Input">
            <input type="button" name="" value="Continue" class="primary-background-color"  onclick="continue_verify()">
          </div>

        </form>

      </div>
    </div>
      
    </div>
</section>
HTML;
?>


<style>
    .trfs_emah{
        color:#3F8AEF !important;
        margin-top:8px !important;
    }
    
    .Reg_Input input[type="button"] {
    cursor: pointer;
    font-size: 15px;
    background-color: #3F8AEF;
    border-color: #3F8AEF;
    color: #fff;
    transition: all 0.3s ease-in-out;
}

</style>