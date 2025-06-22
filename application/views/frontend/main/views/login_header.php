<?php
echo <<<HTML
<body class="white-header-bg">
  <link rel="stylesheet" href="$system_assets_base_url/css/main.css"/>
  <link rel="stylesheet" href="$system_assets_base_url/css/style.css"/>
  <nav class="custom-navbar reg-nav">
    <div class="site-container nav-content">
      <button class="back-btn d-none" onclick="history.back()"><i class="ti-arrow-left"></i>Go back</button>
      <a href="$system_base_url/home" class="nav-brand">
        <img src="$system_frontend_base_url/{$system_frontend_settings['dark_logo']}" class="logo-2" />
      </a>
    </div>
  </nav>
HTML;
?>