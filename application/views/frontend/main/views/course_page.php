<?php
echo <<<HTML
<body class="white-header-bg">
  <section class="course-OO-Dlts-Secs" class="white-header-bg">
    <div class="main-container">
      <div class='d-none$course_disp'><br>Not available...</div>
      <div class="course-OO-Dlts-Main $course_disp">
        <div class="course-OO-Dlts-1">
          <div class="course-Dlt-Top">
            <h4>
              <a href="$system_base_url/home">Home</a>
              <i class="ti-angle-right"></i>
              <a href="$system_base_url/home/category/$course_category_name_slug/{$course_details['category_id']}">{$course_category['name']}</a>
              <i class="ti-angle-right"></i>
              <a href="./"><span>{$course_details['title']}</span></a>
            </h4>
           
             <h2>{$course_details['title']}</h2>

              <!--$player_provider_ui-->
              <img src="$course_img_url" />


             <h3>About this courses</h3>
              {$course_details['description']}
          </div>

          <div class="oBj-Sec $course_requirement_disp">
            <h3>Course requirements</h3>
            <ul>
              $course_requirement_td
            </ul>
          </div>

          <div class="oBj-Sec$course_outcome_disp">
            <h3>In This Course, you will learn how to</h3>
            <ul>
              $course_outcome_td
            </ul>
          </div>
          
         
         
         
         
         
         
         
         
         
        <div class="accordion $course_faq_disp">
            <div class="aaaa-header">
              <h2>Frequently Asked Questions</h2>
            </div>
              $course_faq_td
            
        </div>
        
        
        
        
        
        <div class="comments-sec $course_rating_disp">
            <div class="comments-sec-head">
                <h3>Reviews</h3>
            </div>
            <div class="comments-sec-main">
              $course_rating_td
            </div>
        </div>
                                
                                





        </div>
        <div class="course-OO-Dlts-2">
          <div class="payment-box">
            <h2>
              <span>Charge today</span>
              <span>$course_final_price_currency</span>
            </h2>
            <ul>
              <li><i class="ti-check"></i> Assess to course materials</li>
              <li><i class="ti-check"></i> Assess to assessments</li>
              <li><i class="ti-check"></i> Course certificate</li>
              <li><i class="ti-check"></i> Assess to student management Portal</li>
            </ul>
            
            <div class="likah-Dsim">

            <div class="payment-box-btns">
              $course_details_action
            </div>
             
             </div>


            <h6><i class="fa fa-info-circle"></i>Transactions are 100% Safe and Secure</h6>


          </div>
        </div>
      </div>
    </div>
  </section>
  
  </body>
HTML;
?>


<style>
    .likah-Dsim{
        display:flex !important;
        position:relative;
        width:100%;
        height:auto;
        gap:5px;
        align-items:center;
        margin-top:20px;
    }
    .AddTo-CartBtn {
    position: relative;
    width: 70px;
    border-radius: 8px;
    background-color:#EEF5FF;
    transition: all 0.3s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    height:50px;
}
    .AddTo-CartBtn img{
        width:17px;
    }
    
    .AddTo-CartBtn:hover{
      background:#e3edfc;  
    }
    
    .payment-box-btns{
        margin-top:0px !important;
    }
    .payment-box-btns a{
        height:50px !important;
    }

</style>

<style>
   .payment-box h2 span:last-child span{
       color:#54616C !important;
       font-size:13px !important;
       font-weight:400 !important;
       text-decoration: line-through !important;
   }
   
   
   
   
   
   
   
   
   
   
   
   
   


.accordion {
    position: relative;
    width: 100%;
    height: auto;
    margin-top: 20px;
}
.accordion-item {
    position: relative;
    width: 100%;
    height: auto;
    margin-top: 10px;
    border:1px solid #DADADA;
    border-radius: 5px;
    overflow: hidden;
}
.accordion-header {
    padding: 15px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease-in-out;
    position: relative;
}
.accordion-header:hover {
    background: #F6F7F8;
}
.accordion-header.active {
    background: #F6F7F8;
}
.accordion-header span{
    font-size: 12px;
}
.accordion-content {
    display: none;
    background: white;
    position: relative;
    width: 100%;
    height: auto;
    padding: 20px;
}
.accordion-content a{
    padding:20px 20px;
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 20px;
    grid-gap: 20px;
    width: 100%;
    height: auto;
    border-top:1px solid #DADADA;
    transition: all 0.3s ease-in-out;
    background-color: #fff;
}
.active-accordion-link,
.accordion-content a:hover{
    background-color: #F6F7F8 !important;
}

.accordion-content a p{
    position: relative;
    width: 100%;
    height: auto;
    font-size: 15px;
    font-weight: 500;
}
.accordion-content a i.ti-pencil,
.accordion-content a i.ti-control-play{
    position: relative;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #0F3A1C;
    font-size: 15px;
    border:1px solid #0F3A1C;
    transition: all 0.3s ease-in-out;
}

.ti-angle-up {
    transform: rotate(180deg);
}

.active-accordion-link i.ti-control-play,
.accordion-content a:hover i.ti-control-play{
    background-color: #0F3A1C !important;
    color: #fff !important;
}



.accordion-content h3{
    position: relative;
    display: flex;
    align-items: center;
    gap: 8px;
    grid-gap: 8px;
    font-size: 10px;
    margin-top: 10px;
}

.accordion-content h3 span{
    display: inline-flex;
    align-items: center;
    gap: 5px;
    grid-gap: 5px;
    background-color: #D0EFDA;
    color: #0F3A1C;
    padding: 7px 10px;
    border-radius: 30px;
}

.aaaa-header{
    position: relative;
    margin-bottom:30px;
    width: 100%;
    margin-top: 40px;
}

.aaaa-header h2{
    font-size: 18px;
    font-weight: 700;
    color:#000;
}












/*comments-sec*/
.comments-sec{
	position: relative;
	width: 100%;
	height: auto;
	margin-top: 50px;
}
.comments-sec-head{
	position: relative;
	width: 100%;
	height: auto;
	margin-bottom: 30px;
}
.comments-sec-head h3{
	font-size: 18px;
	font-weight: 700;
	color:#000;
}

.comments-sec-main{
	position: relative;
	width: 100%;
	height: auto;
}

.comments-sec-box{
	position: relative;
	width: 100%;
	height: auto;
	margin-top: 10px;
	margin-bottom: 10px;
	border-bottom: 1px solid #EDEDED;
	padding: 15px 0px;
}

.s-comment{
	position: relative;
	width: 100%;
	height: auto;
	display: grid;
	grid-template-columns: auto 1fr;
	grid-gap: 80px;
}
@media screen and (max-width:700px){
	.s-comment{
		grid-gap: 40px !important;
	}
}
@media screen and (max-width:450px){
	.comments-sec-box{
		border-bottom: none !important;
	}
	.s-comment{
		display: block !important;
	}
	.s-comment-1{
		word-wrap: 100% !important;
		border-bottom: 1px solid #EDEDED;
		padding-bottom: 15px;
	}
	.s-comment-10 span{
		width: 40px !important;
		height:40px !important;
		font-size: 16px !important;
	}
	.s-comment-11 span{
		font-size: 15px !important;
	}
}
.s-comment-1{
	position: relative;
	width: auto;
	height: auto;
}
.s-comment-1-flex{
	position: relative;
	width: auto;
	height: auto;
	display: flex;
	align-items: center;
}

.s-comment-10{
	position: relative;
	width: auto;
	height: auto;
	margin-right: 20px;
}

.s-comment-10 span{
	position: relative;
	width: 50px;
	height: 50px;
	background:#E6F8FF;
	color: #000;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	text-align: center;
	border-radius: 5px;
	font-size: 18px;
	font-weight: 700;
	text-transform: uppercase;
}

.s-comment-11{
	position: relative;
	width: auto;
	height: auto;
}
.s-comment-11 span{
	font-size: 17px;
	font-weight: 500;
}
.s-comment-11 p{
	font-size: 12px;
	color: #9b9b9b;
}

.s-comment-2{
	position: relative;
	width: 100%;
	height: auto;
}

.s-comment-2 span{
    position: relative;
    width: 100%;
    height: auto;
    margin-top: 10px;
    display: flex;
    align-items: center;
    font-size: 13px;
}

.s-comment-2 span i{
	margin-left: 5px;
}
.s-comment-2 span i:first-child{
	margin-left: 0px;
}


.s-comment-2 p{
	font-size: 14px;
	color:#888888;
}

.star-on{
    color: #F6B023 !important;
}
.star-off{
    color:#E8E8E8 !important;
}



   
</style>










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
