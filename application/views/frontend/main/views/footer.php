<?php
echo <<<HTML
<footer class="site-footer">

<div class="wave-Div d-none">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,64L120,80C240,96,480,128,720,133.3C960,139,1200,117,1320,106.7L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
</div>
<div class="Sub-Footer">
<div class="site-container">
  <div class="Sub-Footer-Content">
    <div class="hhag-footer">
    <a href="$system_base_url/home" class="footer-logo-icon">
      <img src="$system_frontend_base_url/{$system_frontend_settings['light_logo']}" />
    </a>
    <ul>

      <li><a href="$system_base_url/home/about_us">About us</a></li>
      <li><a href="$system_base_url/home/contact_us">Contact us</a></li>
      <li><a href="$system_base_url/home/terms_and_condition">Terms and Condition</a></li>
      <li><a href="$system_base_url/home/privacy_policy">Privacy Policy</a></li>
      <li class='d-none'><a href="$system_base_url/home/refund_policy">Refund Policy</a></li>
      <li><a href="$system_base_url/home/consent_information">ARTS Consent Information</a></li>
      <li><a href="$system_base_url/home/modern_slavery_statement">ARTS Modern Slavery Statement</a></li>
    </ul>
  </div>

    <div class="kaj-sec">

      <div class="social-icons">
        <a href='{$system_settings['linkedin']}' target='_blank' rel='noopener noreferrer'>
          <svg viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg" width="30" height="30" class="SocialMediaLinks_m-social-media-links__icon__aLbPt"><path d="M7.734 27V9.48H2.285V27h5.45zM4.98 7.137c1.758 0 3.165-1.465 3.165-3.223C8.145 2.214 6.738.81 4.98.81a3.126 3.126 0 00-3.105 3.105c0 1.758 1.406 3.223 3.105 3.223zM28.066 27h.059v-9.61c0-4.687-1.055-8.32-6.563-8.32-2.636 0-4.394 1.465-5.156 2.813h-.058V9.48h-5.215V27h5.449v-8.672c0-2.285.41-4.453 3.223-4.453 2.812 0 2.87 2.578 2.87 4.629V27h5.391z" fill="currentColor"></path></svg>
        </a>
        <a href='{$system_settings['twitter']}' target='_blank' rel='noopener noreferrer'>
          <svg viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" width="30" height="30" class="SocialMediaLinks_m-social-media-links__icon__aLbPt"><path d="M4.054 4l8.493 12.136L4 26h1.924l7.483-8.637L19.455 26H26l-8.972-12.817L24.984 4H23.06l-6.891 7.953L10.599 4H4.055zm2.829 1.514H9.89l13.28 18.971h-3.007L6.883 5.515z" fill="currentColor"></path></svg>
        </a>
        <a href='{$system_settings['facebook']}' target='_blank' rel='noopener noreferrer'>
          <svg viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg" width="30" height="30" class="SocialMediaLinks_m-social-media-links__icon__aLbPt"><path d="M21.973 17.625l.82-5.39h-5.215V8.718c0-1.524.703-2.93 3.047-2.93h2.402V1.16S20.86.75 18.81.75c-4.278 0-7.09 2.637-7.09 7.324v4.16H6.914v5.391h4.805V30.75h5.86V17.625h4.394z" fill="currentColor"></path></svg>
        </a>
       
    </div>
    <div class="kaj-TXT">
    <p>© <script>document.write(new Date().getFullYear());</script> A.R.T.S</p>
    <span>Designed by<a href="https://prolianceltd.com/"> Proliance LTD</a></span>
    </div>
  </div>

  </div>
</div>
</div>

</footer>
HTML;
?> 
