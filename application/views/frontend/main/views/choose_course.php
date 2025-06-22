<?php
echo <<<HTML

<body class="white-header-bg">

  <section class="couseeee-Top-sec uoija-ooa">
    <div class="main-container">
      <div class="GGF-Coursee">
        <h2>{$category['name']}</h2>
        <p class='d-none'>{$category['about']}</p>

      </div>
      <div class="GGF-Coursee-btns d-none">
        $categories_td
      </div>

      
    </div>
  </section>

    <div class="site-container auhsuiaop-opaoa">
$category_top_courses_td

</div>
  
  


      
HTML;
?>

<style>
    .auhsuiaop-opaoa{
        margin-bottom:70px !important;
    }
</style>
