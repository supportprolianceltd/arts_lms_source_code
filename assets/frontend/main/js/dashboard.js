
// <!-- Start of LiveChat (www.livechat.com) code -->
  window.__lc = window.__lc || {};
  window.__lc.license = 19056530;
  window.__lc.integration_name = "manual_onboarding";
  window.__lc.product_name = "livechat";
  ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))








    document.addEventListener("DOMContentLoaded", function () {
      const profilePrev = document.querySelector(".Profile-Top-Nav-Prev");
  
      profilePrev.addEventListener("click", function (event) {
          event.stopPropagation(); // Prevents closing when clicking inside
          this.classList.toggle("Show-DropDown-OO");
      });
  
      document.addEventListener("click", function () {
          profilePrev.classList.remove("Show-DropDown-OO");
      });
  });
  








  document.addEventListener("DOMContentLoaded", function () {
    const mobileNavToggler = document.querySelector(".mobile-nav-toggler");
    const closeNavButton = document.querySelector(".moblie-Close-Nav button");
    const leftNavBar = document.querySelector(".left-nav-bar");
    const navLinks = document.querySelectorAll(".left-nav-bar a");

    // Function to show navbar
    mobileNavToggler.addEventListener("click", function () {
        leftNavBar.classList.add("Show-mobile-left-nav");
    });

    // Function to hide navbar
    function hideNavbar() {
        leftNavBar.classList.remove("Show-mobile-left-nav");
    }

    // Close button click
    closeNavButton.addEventListener("click", hideNavbar);

    // Click on any navbar link
    navLinks.forEach(link => {
        link.addEventListener("click", hideNavbar);
    });

    // Click outside the navbar
    document.addEventListener("click", function (event) {
        if (!leftNavBar.contains(event.target) && !mobileNavToggler.contains(event.target)) {
            hideNavbar();
        }
    });
});

















$(document).ready(function(){
  $(".Mobile-search-button").click(function(){
      $(".search-dropdown-sec").css("display", "block").animate({ opacity: 1 }, 300);
  });

  $(".search-dropdown-sec h3 button").click(function(){
      $(".search-dropdown-sec").animate({ opacity: 0 }, 300, function(){
          $(this).css("display", "none");
      });
  });
});
