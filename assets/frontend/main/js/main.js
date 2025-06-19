
AOS.init({
  duration: 1000,
 easing: 'slide',
 once: true
});




document.addEventListener("DOMContentLoaded", function () {
    // Functionality to change the image on hover for each dropdown menu
    document.querySelectorAll(".nav-drop-down-box").forEach(dropdown => {
      const imageElement = dropdown.querySelector(".nav-drop-down-left img");
      if (!imageElement) return;
      
      const defaultImage = imageElement.src;
      dropdown.querySelectorAll(".dropdown-navid-main a").forEach(link => {
        link.addEventListener("mouseenter", function () {
          const newImage = this.getAttribute("data-image");
          if (newImage) {
            imageElement.src = newImage;
          }
        });
  
        link.addEventListener("mouseleave", function () {
          imageElement.src = defaultImage;
        });
      });
    });
  
    // Functionality to toggle between Mandatory and Accredited courses for each dropdown
    document.querySelectorAll(".nav-drop-down-box").forEach(dropdown => {
      const mandatoryBtn = dropdown.querySelector(".drop-top-navi button:nth-child(1)");
      const accreditedBtn = dropdown.querySelector(".drop-top-navi button:nth-child(2)");
      const mandatoryCourses = dropdown.querySelector(".dropdown-navid.mandatory-courses-drop");
      const accreditedCourses = dropdown.querySelector(".dropdown-navid.accredited");
  
      if (!mandatoryBtn || !accreditedBtn || !mandatoryCourses || !accreditedCourses) return;
  
      // Hide accredited courses by default
      accreditedCourses.style.display = "none";
  
      mandatoryBtn.addEventListener("click", function () {
        mandatoryCourses.style.display = "block";
        accreditedCourses.style.display = "none";
  
        mandatoryBtn.classList.add("active-btn");
        accreditedBtn.classList.remove("active-btn");
      });
  
      accreditedBtn.addEventListener("click", function () {
        accreditedCourses.style.display = "block";
        mandatoryCourses.style.display = "none";
  
        accreditedBtn.classList.add("active-btn");
        mandatoryBtn.classList.remove("active-btn");
      });
    });
  
    // Dropdown show/hide functionality with active class toggle
const dropdownTriggers = document.querySelectorAll(".nav-icons > ul > li > span");
const dropdowns = document.querySelectorAll(".nav-drop-down-box");

// Remove the show class from all dropdowns on page load
dropdowns.forEach(dropdown => dropdown.classList.remove("show-nav-drop-down-box"));

dropdownTriggers.forEach(trigger => {
    trigger.addEventListener("click", function (event) {
        event.stopPropagation();
        const dropdown = this.nextElementSibling;

        // Remove active class from all spans and hide other dropdowns
        dropdownTriggers.forEach(span => span.classList.remove("active"));
        dropdowns.forEach(d => {
            if (d !== dropdown) d.classList.remove("show-nav-drop-down-box");
        });

        // Toggle active class and show/hide dropdown
        if (dropdown.classList.contains("show-nav-drop-down-box")) {
            dropdown.classList.remove("show-nav-drop-down-box");
            this.classList.remove("active");
        } else {
            dropdown.classList.add("show-nav-drop-down-box");
            this.classList.add("active");
        }
    });
});

// Hide dropdown when clicking outside
document.addEventListener("click", () => {
    dropdowns.forEach(dropdown => dropdown.classList.remove("show-nav-drop-down-box"));
    dropdownTriggers.forEach(span => span.classList.remove("active"));
});

  
    document.addEventListener("click", function () {
      dropdowns.forEach(dropdown => dropdown.style.display = "none");
      dropdownTriggers.forEach(span => span.classList.remove("active"));
    });
  
    dropdowns.forEach(dropdown => {
      dropdown.addEventListener("click", function (event) {
        event.stopPropagation();
      });
    });
  });
  
  









  document.addEventListener("DOMContentLoaded", function () {
    const mobileToggleNav = document.querySelector(".mobile-toggle-nav");
    const navBar = document.querySelector(".custom-navbar");
    const closeButton = document.querySelector(".mobil-topss button");

    if (mobileToggleNav && navBar && closeButton) {
        // Add class when clicking the mobile toggle button
        mobileToggleNav.addEventListener("click", function () {
            navBar.classList.add("mobile-togle-navbar");
        });

        // Remove class when clicking the close button
        closeButton.addEventListener("click", function () {
            navBar.classList.remove("mobile-togle-navbar");
        });
    }
});



















$(document).ready(function(){
  $(".search-button").click(function(){
      $(".search-dropdown-sec").css("display", "block").animate({ opacity: 1 }, 300);
  });

  $(".search-dropdown-sec h3 button").click(function(){
      $(".search-dropdown-sec").animate({ opacity: 0 }, 300, function(){
          $(this).css("display", "none");
      });
  });
});



















$(document).ready(function () {
  $(window).on("scroll", function () {
      if ($(this).scrollTop() > 10) {
          $(".custom-navbar").addClass("nav-scrolled");
      } else {
          $(".custom-navbar").removeClass("nav-scrolled");
      }
  });
});










































$('.courses-owl').owlCarousel({
  items: 5,
    loop: true,
    margin: 20,
    autoplay: false,
    nav: true,
    dots: false,
    navText: ['<span class="ti-angle-left">', '<span class="ti-angle-right">'],
    smartSpeed: 1000,
     responsive: {
          0: {
            items: 1,
        },
          380: {
            items: 2,
        },
         780: {
            items: 3,
        },
        1300: {
            items: 5,
        }
    }
});


$('.reviews-owl').owlCarousel({
  items: 3,
    loop: true,
    margin: 0,
    autoplay: true,
    nav: false,
    dots: false,
    navText: ['<span class="ti-angle-left">', '<span class="ti-angle-right">'],
    smartSpeed: 1000,
     responsive: {
          0: {
            items: 1,
        },
         780: {
            items: 2,
        },
        1300: {
            items: 3,
        }
    }
});























document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".courses-header-btns button");
  const coursesSections = document.querySelectorAll(".courses-main");

  buttons.forEach((button, index) => {
    button.addEventListener("click", function () {
      // Remove active class from all buttons
      buttons.forEach((btn) => btn.classList.remove("active-courses-btn"));
      this.classList.add("active-courses-btn");

      // Hide all courses-main sections
      coursesSections.forEach((section) => section.style.display = "block");

      // Show the selected section based on index
      coursesSections[index].style.display = "block";
    });
  });

  // Ensure only the first category is visible initially
  coursesSections.forEach((section, idx) => {
    section.style.display = idx === 0 ? "block" : "block";
  });
});























document.addEventListener("DOMContentLoaded", function() {
  let advertPopup = document.getElementById("advertPopup");
  let closeAdvertBtn = document.getElementById("closeAdvertBtn");

  // Remove stored data on refresh to make the advert reappear
  sessionStorage.removeItem("advertClosed");

  // Show advert on scroll only if not closed before
  window.addEventListener("scroll", function() {
      if (window.scrollY >= 100 && !sessionStorage.getItem("advertClosed")) {
          advertPopup.classList.add("show-advertpop");
      }
  });

  // Close button click event
  closeAdvertBtn.addEventListener("click", function() {
      advertPopup.classList.remove("show-advertpop");
      sessionStorage.setItem("advertClosed", "true"); // Store in sessionStorage
  });
});





















































// <!-- Start of LiveChat (www.livechat.com) code -->
  window.__lc = window.__lc || {};
  window.__lc.license = 19056530;
  window.__lc.integration_name = "manual_onboarding";
  window.__lc.product_name = "livechat";
  ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))




























    document.addEventListener("DOMContentLoaded", function () {
      const buttons = document.querySelectorAll(".GGF-Coursee-btns button");
      const sections = document.querySelectorAll(".Gen-courses-main");
  
      // Hide all sections except the "all" section by default
      sections.forEach(section => {
          if (!section.classList.contains("all")) {
              section.style.display = "none";
          }
      });
  
      buttons.forEach(button => {
          button.addEventListener("click", function () {
              // Remove active class from all buttons
              buttons.forEach(btn => btn.classList.remove("active-GGF-btn"));
              
              // Add active class to the clicked button
              this.classList.add("active-GGF-btn");
              
              // Get the category from the button text
              const category = this.textContent.toLowerCase();
  
              // Show/hide relevant sections
              sections.forEach(section => {
                  if (section.classList.contains(category)) {
                      section.style.display = "block";
                  } else {
                      section.style.display = "none";
                  }
              });
          });
      });
  });
  






























  const togglePassword = document.getElementById('togglePassword');
  const passwordField = document.getElementById('passwordField');
  const toggleIcon = document.getElementById('toggleIcon');
  
  togglePassword.addEventListener('click', () => {
    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      toggleIcon.src = '/assets/frontend/main/img/hidePass-icon.svg';
      toggleIcon.alt = 'Hide Password';
    } else {
      passwordField.type = 'password';
      toggleIcon.src = '/assets/frontend/main/img/showPass-icon.svg';
      toggleIcon.alt = 'Show Password';
    }
  });























