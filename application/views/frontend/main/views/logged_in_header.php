<?php
echo <<<HTML
<body>
<link rel="stylesheet" href="$system_assets_base_url/css/dashboard.css"/>
  <nav class="left-nav-bar">
    <div class="moblie-Close-Nav">
      <button><i class="ti-close"></i></button>
    </div>
    
    <div class="Left-nav-icon-Ul fff-Ul-Ol">
      <p>Dashboard</p>
      <ul>
        <li><a href="$system_base_url/home/my_courses" class="{$__active_tab['my_courses']}"><i class="ti-layout"></i> Overview</a></li>
  
        
          <li><a href="$system_base_url/home/statistics" class="{$__active_tab['statistics']}"><i class="ti-bar-chart"></i> Statistics</a></li>
          
                <li>
        <a href="$system_base_url/home/notifications" class="{$__active_tab['notifications']}" id="lkklla-Hide"><i class="icon-bell"></i>Notifications</a></li>
        
        <li>
        <a href="$system_base_url/home/my_messages" class="{$__active_tab['my_messages']}"><i class="ti-comment-alt"></i>My Messages<span class='badge badge-info bg-info rounded ook-daggafa'>$no_of_unreaded_message</span></a></li>
        
      </ul>
    </div>
  
    <div class="Left-nav-icon-Ul">
      <p>Courses</p>
      <ul>
        <li><a href="$system_base_url/home/choose_course"><i class="ti-layout-grid2"></i> All Courses</a></li>
        <li><a href="$system_base_url/home/all_courses" class="{$__active_tab['all_courses']}"><i class="ti-agenda"></i> Your Courses</a></li>
        <li><a href="$system_base_url/home/completed_courses" class="{$__active_tab['completed_courses']}"><i class="ti-check-box"></i> Completed Courses</a></li>
      </ul>
    </div>
  
    <div class="Left-nav-icon-Ul">
      <p>My Classes</p>
      <ul>
      <li><a href="$system_base_url/home/all_schedules" class="{$__active_tab['all_schedules']}"><i class="icon-graduation"></i> All Classes</a></li> 
        <li><a href="$system_base_url/home/ongoing_schedules" class="{$__active_tab['ongoing_schedules']}"><i class="icon-camrecorder"></i> Ongoing Classes</a></li> 
        <li><a href="$system_base_url/home/upcoming_schedules" class="{$__active_tab['upcoming_schedules']}"><i class="icon-graph"></i> Upcoming Classes</a></li> 
        <li><a href="$system_base_url/home/elapsed_schedules" class="{$__active_tab['elapsed_schedules']}"><i class="icon-check"></i> Completed Classes</a></li> 
      </ul>
    </div>
  
    <div class="Left-nav-icon-Ul d-none">
      <p>Assignments</p>
      <ul>
        <li><a href="$system_base_url/home/all_assignments" class="{$__active_tab['all_assignments']}"><i class="icon-note"></i>All Assignments</a></li>
        <li><a href="$system_base_url/home/pending_assignments" class="{$__active_tab['pending_assignments']}"><i class="icon-pie-chart"></i>Pending Assignments</a></li>
        <li><a href="$system_base_url/home/active_assignments" class="{$__active_tab['active_assignments']}"><i class="icon-pencil"></i>Active Assignments</a></li>
        <li class="hide"><a href="$system_base_url/home/elapsed_assignments" class="{$__active_tab['elapsed_assignments']}"><i class="icon-check"></i>Elapsed Assignments</a></li>
      </ul>
    </div>
  
    <div class="Left-nav-icon-Ul d-none">
      <p>Certificates</p>
      <ul>
        <li><a href="$system_base_url/home/certificates" class="{$__active_tab['certificates']}"><i class="icon-badge"></i> Certificates</a></li>
      </ul>
    </div>
  
    <div class="Left-nav-icon-Ul">
      <p>Profile</p>
      <ul>
        <li><a href="$system_base_url/home/profile/user_profile" class="{$__active_tab['user_profile']}"><i class="icon-settings"></i> Profile Settings</a></li>
      </ul>
    </div>

    <div class="Left-nav-icon-Ul">
      <p>Billing</p>
      <ul>
        <li><a href="$system_base_url/home/purchase_history" class="{$__active_tab['purchase_history']}"><i class="icon-wallet"></i> Payment History</a></li>
      </ul>
    </div>


  </nav>
  
  <nav class="Dash-Top-Nav">
    <div class="Dash-Top-Nav-Main">
      <div class="Dash-Top-Nav-Main-1">
        <button class="mobile-nav-toggler"><i class="icon-menu"></i></button>
        <a href="$system_base_url/home" class="Dash-Nav-Logo">
          <img src="$system_frontend_base_url/{$system_frontend_settings['dark_logo']}" />
          <span>LMS</span>
        </a>
  
        <div class="Dash-Top-Search d-none">
          <input type="text" placeholder="Search for anything here..." />
          <button><i class="ti-search"></i></button>
        </div>
      </div>
  
      <div class="Dash-Top-Nav-Main-2">
        <button class="Mobile-search-button"><i class="ti-search"></i></button>
        
         <button class="diary-dddop" onclick="openModal()"><i class="ti-calendar"></i></button>
         
        <a href="$system_base_url/home/notifications" class="Notice-Icons-Ahrf"><i class="icon-bell"></i>$number_of_unread_notification_text</a>
        
        <div class="Profile-Top-Nav-Prev">
          <button>
            <span class="d-none">{$user_details['first_name'][0]}</span>
            <img src="$user_profile_photo" />
            <i class="ti-angle-down"></i>
          </button>
  
          <div class="Profile-GG-Dropdown">
            <div class="Profile-GG-Dropdown-Box">
              <div class="Profile-GG-Img">
                <img src="$user_profile_photo" />
                <a href="$system_base_url/home/profile/user_profile">Profile Settings</a>
              </div>
              <h2>{$user_details['first_name']} {$user_details['last_name']}</h2>
              <h3>A.R.T.S ID: $id</h3>
  
              <div class="Profile-GG-Dropdown-Box-Btns">
                <button class="logout-btn" onclick="location='$system_base_url/login/logout'">Log out</button>
                <button class="delete-btn d-none">Delete account</button>
              </div>
  
            </div>
  
          </div>
        </div>
      </div>
    </div>
    
  <div class="search-dropdown-sec d-none">
    <div class="site-container">
      <h3>What are you looking for? <button><i class="ti-close"></i></button></h3>
      <div class="search-box">
        <input type="text" name="" placeholder="Search for anything here..." />
        <button><i class="ti-search"></i></button>
      </div>
    </div>
  </div>
  
 
  
</nav>

    <div class="modal-overlay" id="modalOverlay">
    <div class="ooomodal" style='width:60%;'>
      <span class="close-btn" onclick="closeModal()"><i class="ti-close"></i></span>
      <!-- Modal content can go here -->
      $td_diary
    </div>
  </div>
  
  

   
        
  
  
HTML;
?>


<style>
    .Profile-Top-Nav-Prev button img{
    position: relative;
    width: 33px;
    height: 33px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    object-fit:cover;
    object-position:center;
}

@media screen and (max-width: 1100px) {
      .Profile-Top-Nav-Prev button img{
        width: 25px !important;
        height: 25px !important;
        font-size: 12px !important;
    }
}

.Profile-Top-Nav-Prev button i {
     font-size:10px;
 }


.ook-daggafa{
    background:rgba(255,255,255,0.2) !important;
}

</style>




