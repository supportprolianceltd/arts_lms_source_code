<?php
echo <<<HTML
    <footer class="dash-footer">
      
      <div class="dash-footer-link">
        <a href="$system_base_url/home/terms_and_condition">Terms of use</a>
        <a href="$system_base_url/home/privacy_policy">Privacy Policy</a>
      </div>

      <p>© <script>document.write(new Date().getFullYear());</script> A.R.T.S</p>
     
    </footer>
  </section>
HTML;
?>