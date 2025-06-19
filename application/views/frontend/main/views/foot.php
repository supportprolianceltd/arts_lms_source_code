<?php
echo <<<HTML
<!-- JavaScript Files (Deferred for Performance) -->

<script src="$system_assets_base_url/js/jquery-3.3.1.min.js"></script>
<script src="$system_assets_base_url/js/bootstrap.min.js"></script>
<script src="$system_assets_base_url/js/jquery.easing.1.3.js"></script>
<script src="$system_assets_base_url/js/aos.js"></script>
<script src="$system_assets_base_url/js/owl.carousel.min.js"></script>



<!-- main site .js -->
<script src="$system_assets_base_url/js/main.js"></script>
<script src="$system_assets_base_url/js/dashboard.js"></script>

<!-- notifier.js -->
<script src="$system_assets_base_url/js/notifier.js"></script>
<script src="$system_base_url/assets/global/plyr/plyr.js"></script>
<script src="$system_assets_base_url/js/list.min.js"></script>

<script>
    //window.addEventListener('load',function(){
    //console.log('sex');
      var monkeyList = new List('jlist', {
        page: 10,
        pagination: true
      });
      //});
</script>


<script>
      
      document.querySelector(".Reg_Input_HRef").addEventListener("click", function () {
        let container = document.querySelector(".Sub-Sells-Booked-cssa"); // Change to the actual container class
        let span = this.querySelector("span");
        let icon = this.querySelector("i");
      
        // Toggle class
        container.classList.toggle("show-Sub-Sells-Booked-cssa");
      
        // Change text and icon
        if (container.classList.contains("show-Sub-Sells-Booked-cssa")) {
            span.innerHTML = 'Hide courses <i class="ti-angle-up"></i>';
        } else {
            span.innerHTML = 'Show courses <i class="ti-angle-down"></i>';
        }
      });
      
      
      document.querySelector(".back-btn").addEventListener("click", function() {
          window.history.back();
      });
      
      
      
          </script>











  <script type="text/javascript">
    norm_loop="$norm_loop";
    slider=$('.courses-owl');
    var _no_item= parseInt(slider.find('.item').length);
   $('.courses-owl').owlCarousel({
      items: 3,
        loop: norm_loop?_no_item>=3:true,
        margin: 0,
        autoplay: false,
        nav: true,
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

  </script>

    <script>
    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', function() {
            let content = this.nextElementSibling;
            let isActive = content.style.display === 'block';
            
            document.querySelectorAll('.accordion-content').forEach(c => c.style.display = 'none');
            document.querySelectorAll('.accordion-header').forEach(h => h.classList.remove('active'));
            document.querySelectorAll('.accordion-header span').forEach(s => s.classList.remove('ti-angle-up'));
            
            if (!isActive) {
                content.style.display = 'block';
                this.classList.add('active');
                this.querySelector('span').classList.add('ti-angle-up');
            }
        });
    });
</script>

<script>
    const togglePassword = document.getElementById('togglePassword');
const passwordField = document.getElementById('passwordField');
const toggleIcon = document.getElementById('toggleIcon');

togglePassword.addEventListener('click', () => {
  if (passwordField.type === 'password') {
    passwordField.type = 'text';
    toggleIcon.src = '$system_assets_base_url/img/hidePass-icon.svg';
    toggleIcon.alt = 'Hide Password';
  } else {
    passwordField.type = 'password';
    toggleIcon.src = '$system_assets_base_url/img/showPass-icon.svg';
    toggleIcon.alt = 'Show Password';
  }
});
  </script>


<script>
    items=document.querySelectorAll('.rating').forEach((item)=>{
        _item_average_rating=item.getAttribute('_average_rate');
        if(!isNaN(_item_average_rating)){
            load_rating(_item_average_rating,item);
        }
    });

    function load_rating(rate,item=null){
        reactive=item==null||item==undefined?false:item.getAttribute('reactive')=='reactive';
        var num_rating=5;
        if(isNaN(rate)) rate=0;
        var star_src="$system_assets_base_url/img/rated-star.svg";
        var ri='';
        for(i=0;i<num_rating;i++){
            if(i==rate) star_src="$system_assets_base_url/img/unrated-star.svg";
            index=i+1;
            ri+="<img src='"+star_src+"'";
            if(reactive) ri+=" onclick='set_rating("+index+","+item.id+")'"
            ri+="/>";
        }
        //console.log(rate);
        if(item!=null) item.innerHTML=ri;
        else document.getElementById('stars').innerHTML=ri;
    }
</script>

<script>
    document.getElementById('showRateButton').addEventListener('click', function() {
        document.getElementById('rateContainer').classList.add('show-rate-dropdown');
    });

    document.getElementById('hideRateButton').addEventListener('click', function() {
        document.getElementById('rateContainer').classList.remove('show-rate-dropdown');
    });
</script>

<script type="text/javascript">
  function resend_new_device_verification_code() {
    $("#resend_mail_loader").html('<img loading="lazy" src="$system_base_url/assets/global/gif/page-loader-3.gif" style="width: 25px;">');
    $.ajax({
      type: 'post',
      url: '$system_base_url/login/new_login_confirmation/resend',
      success: function(response){
        notifier('mail successfully sent to your inbox','success');
        $("#resend_mail_loader").html('');
      }
    });
  }
</script>

<script type="text/javascript">
function continue_verify() {
    var email = '$register_email';
    var verification_code = $('#verification_code').val();
    $.ajax({
        type: 'post',
        url: '$system_base_url/login/verify_email_address/',
        data: {verification_code : verification_code, email : email},
        success: function(response){
            if(response){
                window.location.replace('$system_base_url/login');
            }else{
                location.reload();
            }
        }
    });
}

function resend_verification_code() {
    $("#resend_mail_loader").html('<img loading="lazy" src="$system_base_url/assets/global/gif/page-loader-3.gif" style="width: 19px;">');
    var email = '$register_email';
    $.ajax({
        type: 'post',
        url: '$system_base_url/login/resend_verification_code/',
        data: {email : email},
        success: function(response){
            notifier('Mail successfully sent to your inbox','success');
            $("#resend_mail_loader").html('');
        }
    });
}
</script>

<script>
function publishCourseRating(course_id) {
    var review = $('#course_review_input').val();
    var starRating = 0;
    starRating = $('#course_star_rating_input').val();
    if (starRating > 0) {
        document.getElementById('rateContainer').classList.remove('show-rate-dropdown');
        $.ajax({
            type : 'POST',
            url  : '$system_base_url/home/rate_course',
            data : {course_id : course_id, review : review, starRating : starRating},
            success : function(response) {
                if(response){
                    try{
                        response_ob=JSON.parse(response);
                        if(response_ob.error) notifier(response_ob.error,'error');
                        //else location.reload();
                    }
                    catch(e){

                    }
                }
            }
        });
        location.reload();
    }else{

    }
}
</script>

<!-- SHOW TOASTR NOTIFIVATION -->

<script type="text/javascript">
    flash_message='$system_flash_message';
    error_message='$system_error_message';
    info_message='$system_info_message';

    if(flash_message) notifier(flash_message,'success');

    if(error_message) notifier(error_message,'error');

    if(info_message) notifier(info_message,'info');
</script>

<script>
    window.addEventListener('load', function() {
        //console.log(window['player']);
        var player = window['player']?new Plyr('#player'):undefined;
    });
</script>















 <script>
    function openModal() {
      document.getElementById("modalOverlay").style.display = "flex";
    }

    function closeModal() {
      document.getElementById("modalOverlay").style.display = "none";
    }

    // Optional: close modal when clicking outside the modal
    document.getElementById("modalOverlay").addEventListener("click", function(e) {
      if (e.target === this) closeModal();
    });
  </script>



<script>


 $(document).ready(function(){
    $('.message-togler-11').click(function(){
      $('.toggle-messageCont-1').addClass('showMessage-div');
      $('.m-container-2').addClass('showMessage-div');
    });
  });


       $(document).ready(function(){
    $('.m-container-body').click(function(){
      $('.toggle-messageCont').removeClass('showMessage-div');
      $('.m-container-1').removeClass('showMessage-div');
      $('.m-container-2').removeClass('showMessage-div');
    });
  });

          $(document).ready(function(){
    $('.close-m-container').click(function(){
      $('.toggle-messageCont').removeClass('showMessage-div');
     $('.m-container-1').removeClass('showMessage-div');
     $('.m-container-2').removeClass('showMessage-div');
    });
  });
  
  
</script>


















<script>
    document.querySelectorAll('.accordion-header').forEach(header => {
        let content = header.nextElementSibling;
        let isActive = header.classList.contains('active');
        
        if (isActive) {
            content.style.display = 'block';
            header.querySelector('span').classList.remove('ti-angle-down');
            header.querySelector('span').classList.add('ti-angle-up');
        } else {
            content.style.display = 'none';
        }
        
        header.addEventListener('click', function () {
            let isActive = this.classList.contains('active');
            
            document.querySelectorAll('.accordion-content').forEach(c => c.style.display = 'none');
            document.querySelectorAll('.accordion-header').forEach(h => {
                h.classList.remove('active');
                h.querySelector('span').classList.remove('ti-angle-up');
                h.querySelector('span').classList.add('ti-angle-down');
            });
            
            if (!isActive) {
                content.style.display = 'block';
                this.classList.add('active');
                this.querySelector('span').classList.remove('ti-angle-down');
                this.querySelector('span').classList.add('ti-angle-up');
            }
        });
    });






        document.getElementById('showRateButton').addEventListener('click', function() {
            document.getElementById('rateContainer').classList.add('show-rate-dropdown');
        });

        document.getElementById('hideRateButton').addEventListener('click', function() {
            document.getElementById('rateContainer').classList.remove('show-rate-dropdown');
        });
    </script>













</body>
</html>
HTML;
?>
