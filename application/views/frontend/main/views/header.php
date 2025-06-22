 <?php
 echo <<<HTML
<body>
<link rel="stylesheet" href="$system_assets_base_url/css/main.css"/>
<link rel="stylesheet" href="$system_assets_base_url/css/style.css"/>

  
  <nav class="LLL_NavBar">
  <div class="LLLnav_Container">
    <div class="main_LL_Nav_Coint">
      <a href="$system_base_url/home" class="LLL_NAv_LOgols">
        <img src="$system_frontend_base_url/{$system_frontend_settings['dark_logo']}" />
      </a>
      <div class="oayujs-Colaiks">
        <div class="oayujs-Colaiks-0 oo1-oila">
          <ul>
            <li class="explore-Lii"><a href="$system_base_url/home/choose_course" class="explore-btn">Explore <i class="ti-angle-down"></i></a>
            
            <div class="Gent-Coursess-Drop-Downn">
                $top_courses_category_card_td
            </div>
            </li>
          </ul>
 
           
               <form action='$system_base_url/home/courses' id='search_form' class="oayujs-Colaiks-Search">

          <button onclick='search_form.submit()'><i class="ti-search"></i></button>
            <input type="text" name="search_string" placeholder="What do you want to learn today?" />
        </form>
        
        
        </div>
        <div class="oayujs-Colaiks-0">
          <ul>
            <li class="mobilw-Li-Hide-PC"><a href="$system_base_url/home/choose_course">Explore Courses <i class="ti-angle-right"></i></a></li>
            <li><a href="https://cmvp.net/verification/4b832a6e-bba1-4e15-b7d5-6da5657512f0/ARTS/">Verify Certificate</a></li>
            <li><a href="$system_base_url/home/book_class">Book a Class </a></li>
            <li class="genn-Li-Cart"><a href="$system_base_url/home/shopping_cart"><img src="$system_assets_base_url/img/shopping-cart.svg"  class="unhover-img" /><img src="$system_assets_base_url/img/shopping-cart1.svg" class="hovered-img" /> <span class='cartItemsCounter'>$num_cart_items</span> </a></li>
           

   
        <span class='$__hide_elem_class_if_logged_in' id="Span-oamnw">
            
             <li><a href="$system_base_url/home/login" class="LL-Btn-Bordered bolded-600 Gen-Btn-A">Log in</a></li>
            <li><a href="$system_base_url/home/sign_up" class="LL-btn-Bg bolded-600 Gen-Btn-A">Sign up</a></li>
       
        </span>
        <span class='$__hide_elem_class_if_user' id="Span-oamnw">
  
            <li><a href="$system_base_url/home/my_courses" class="LL-btn-Bg bolded-600 Gen-Btn-A">Dashboard</a></li>
    
        </span>
        <span class='$__show_elem_class_if_user' id="Span-oamnw">
   
            <li><a href="$system_base_url/user/" class="LL-btn-Bg bolded-600 Gen-Btn-A">Dashboard</a></li>
        
        </span>
        

          </ul>
          
        </div>
      </div>


       <div class="LL-mobille-Gland">
      <button class="LL-search-button search-button"><i class="ti-search"></i></button>
      <a class="genn-Li-Cart"><a href="$system_base_url/home/shopping_cart" class="mobb-Ahf"><img src="$system_assets_base_url/img/shopping-cart.svg"  class="unhover-img" /><img src="$system_assets_base_url/img/shopping-cart1.svg" class="hovered-img" /> <span class='cartItemsCounter'>$num_cart_items</span> </a>
      <div class="LL-mobile-toggle-nav">
        <span></span>
      </div>
    </div>


    </div>
  </div>
  
  <div class="search-dropdown-sec">
      <div class="site-container">
        <h3>What do you want to learn today? <button><i class="ti-close"></i></button></h3>
        <form action='$system_base_url/home/courses' id='search_form'>
          <div class="search-box">
            <input type="text" name="search_string" placeholder="What do you want to learn today?" />
            <button onclick='search_form.submit()'><i class="ti-search"></i></button>
          </div>
        </form>
      </div>
    </div>
    
</nav>
  
  
  
  
  
HTML;
?>


<style>
  @media screen and (min-width:1200px){
    #Span-oamnw{
        position:relative;
        display:inline-flex;
        align-items:center;
        gap:10px;
    }

    }
    
    .search-dropdown-sec{
        z-index:3000 !important;
    }
</style>
