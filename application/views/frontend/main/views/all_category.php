<?php
echo <<<HTML

  
 
    <header class="LLL-Header-Secc margon-topGen">
  <div class="site-container">
    <div class="LLL-Header-Hero">
      <div class="LLL-Header-Hero-Dlt">
        <div>
        <h1 class="large-text">$booking_text</h1>
        <p>Expert-Led Live Classes, Reserve Your Spot Today!</p>
        
        </div>
      </div>
      <div class="LLL-Header-Hero-Img">
        <img  src="$system_assets_base_url/img/ll-hero-Bnaner-AAB.png" class="ouja-aoujs" />
      </div>
    </div>
  </div>
</header>
  

  


  <section class="couseeee-Top-sec">
    <div class="main-container">
      <div class="GGF-Coursee">
        <h2 class='d-none'>Categories</h2>
        <div class='d-none$categories_list_disp'><br>There are no courses here at this moment...</div>
      </div>
      <div class="Gland-Sec $popular_category_cards_disp $categories_list_disp">
        $top_courses_category_card_td
      </div>

      
    </div>
  </section>
  
  



HTML;
?>

<style>
    .couseeee-Top-sec{
        padding-bottom:40px !important;
    }
    
    .ouja-aoujs{
        position:relative !important;
        margin-top:0px !important;
        max-width:70% !important;
    }
    
    .LLL-Header-Secc{
        padding-top:30px !important;
        padding-bottom:0px !important;
    }
</style>
