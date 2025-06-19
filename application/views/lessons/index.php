<?php
$language_dir = 'ltr';
$language_dirs = get_settings('language_dirs');
if($language_dirs){
	$current_language = $this->session->userdata('language');
	$language_dirs_arr = json_decode($language_dirs, true);
	if(array_key_exists($current_language, $language_dirs_arr)){
		$language_dir = $language_dirs_arr[$current_language];
	}
}
?>

<!DOCTYPE html>
<html lang="en" dir="<?php echo $language_dir; ?>">
<head>
	<title><?php echo $course_details['title'].' | '.get_settings('system_name'); ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="author" content="<?php echo get_settings('author') ?>" />
	<meta name="keywords" content="<?php echo $course_details['meta_keywords']; ?>"/>
	<meta name="description" content="<?php echo $course_details['meta_description']; ?>" />
	<link name="favicon" type="image/x-icon" href="<?php echo base_url('uploads/system/'.get_frontend_settings('favicon')); ?>" rel="shortcut icon" />

	<?php include 'includes_top.php';?>
	
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap" rel="stylesheet">


	<style type="text/css">
		.custom-accordion .accordion-button{
			padding: 13px 0px !important;
		}
		.course-content-items .item a{
			font-family: "Inter", sans-serif;
			line-height: 20px !important;
		    font-size: 15px;
		    font-weight: 500;
		    line-height: 34px;
		    color: #737982;
		    transition: all 0.3s;
		}
		.course-content-items .item a > i{
			border-radius: 50%;
		    height: 29px;
		    width: 29px;
		    padding: 10.5px 11.5px;
		    font-size: 8px;
		    background-color: rgba(115, 121, 130, 0.2);
		    color: #6f7a8b;
		}
		.course-content-items .item.active a > i{
		    background-color: #fff;
		    color: #1663d4;
		}
		.course-content-items .item a .checkbox, .course-content-items .item .checkbox{
			min-height: 20.5px;
    		min-width: 35px;
    		position: relative;
		}
		.course-content-items .item a input, .course-content-items .item input{
		    min-width: 20px;
		    min-height: 20px;
		    position: absolute;
    		top: 4px;
    		left: 4.5px;
		}
		.course-content-items .lesson-icon{
			font-size: 10px;
		    margin-top: -2px !important;
		    display: inline-block;
		    font-weight: 700;
		}
		.course-content-items .item.active a{
			color: #fff;
		}
		.lesson_checkbox, .lesson_checkbox:hover{
			accent-color: #e3e4e6;
		}
		.d-none{
			display: none!important;
		}
	</style>
	
	
	
	
	
	
	<style>
	    body {
    font-family: "Sora", sans-serif !important;
    color: #0f1114 !important;
    background: #fff !important;
    overflow-x: hidden;
}


/*kkjk-Navb*/

.kkjk-Navb{
     position: fixed;
    width: 100%;
    height: 60px;
    background-color: #fff;
    top: 0;
    left: 0;
    z-index: 1000;
    /*padding-left: 300px;*/
   border-bottom: 1px solid #dbe0e1;
}


.kkjk-Navb-Main{
       position: relative;
    width: 100%;
    padding: 0px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    height: 100%;
}
@media screen and (max-width:1000px){
    .kkjk-Navb-Main{
        padding:0px 20px !important;
    }
}


.Dash-Nav-Logo{
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.Dash-Nav-Logo img{
    width: 80px;
    max-height: 40px;
    object-fit: contain;
}

.Dash-Nav-Logo span{
    position: relative;
    font-size: 10px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    width: 35px;
    height: 20px;
    border-radius: 30px;
    background-color: #fff;
    color: #000 !important;
    padding: 0px !important;
    padding-top: 2px !important;
    border:1px solid #E0E0E0;
}

@media screen and (max-width:400px){
    .Dash-Nav-Logo span{
        display:none !important;
    }
}

.kkjk-Navb-Main-1{
    position:relative;
    display:inline-flex;
    /*gap:40px;*/
    align-items:center;
}

.kik-OOk{
    position:relative;
    display:inline-flex;
    gap:10px;
    align-items:center;
}

.kik-OOk a{
    position:relative;
    width:500px;
    height:40px;
    background: #EFF2F6;
    display:none;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    padding:0px 20px;
    border-radius:8px;
    /*border:2px solid #3F8AEF;*/
}
.kik-OOk a p{
    font-size: 15px;
    font-weight: 500;
    width: 100%;
    height: auto;
    overflow: hidden;
    line-clamp: 1;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    display: -webkit-box;
}

.kik-OOk a i{
    font-size:13px;
}

.PPop-Lla{
   font-size:14px;
   color:#666;
}


.kkjk-Navb-Main-2{
    position:relative;
    display:inline-flex;
    align-items:center;
    gap:15px;
}

.kkjk-Navb-Main-2 a.koakm-Ayha{
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 8px 15px;
    background-color: #3F8AEF;
    color: #fff;
    border-radius: 5px;
    font-size: 13px;
    transition: all 0.3s ease-in-out;
}

.kkjk-Navb-Main-2 a.koakm-Ayha:hover{
    background-color: #2877df !important;
}

.kkjk-Navb-Main-2 a.koakm-Ayha i{
    font-size:11px;
}

.kkjk-Navb-Main-2 button{
    position:relative;
    background:transparent;
    border:none;
    padding-left:15px;
    border-left:1px solid #dbe0e1;
    width:auto;
    height:auto;
}

.kkjk-Navb-Main-2 button img{
    position: relative;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    object-fit:cover;
    object-position:center;
}

.Profile-Top-Nav-Prev{
    position: relative;
    width: auto;
    height: auto;
    cursor: pointer;
}



/* Profile-GG-Dropdown */

.Profile-GG-Dropdown{
    position: absolute;
    top: 0;
    right: 30px;
    width: 250px;
    height: auto;
    padding: 20px;
    padding-top: 50px;
    display: none;
    
    z-index:2000;
}
@media screen and (max-width:1100px){
    .Profile-GG-Dropdown{
        right: 100% !important;
    }
}
@media screen and (max-width:400px){
    .Profile-GG-Dropdown{
        right: 13% !important;
        width: 90% !important;
        position: fixed !important;
        margin-top: 20px;
    }
}
.Profile-Top-Nav-Prev.Show-DropDown-OO .Profile-GG-Dropdown{
    display: block;
}


.Profile-GG-Dropdown-Box{
    position: absolute;
    left: 0;
    width: 100%;
    height: auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgb(0 0 0 / 10%);
    -webkit-box-shadow: 0 0 10px rgb(0 0 0 / 10%);
    -moz-box-shadow: 0 0 10px rgb(0 0 0 / 10%);
    text-align: center;
    margin-left: 30px;
    user-select: none;
}


.Profile-GG-Img{
    position: relative;
    width: 100%;
    height: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin-bottom: 10px;
}

.Profile-GG-Img img{
    position: relative;
    width: 70px;
    height: 70px;
    object-fit: cover;
    object-position: center;
    border-radius: 50%;
    margin-bottom: 10px;
}

.Profile-GG-Img a{
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: #3F8AEF;
    font-size: 14px;
    transition: all 0.3s ease-in-out;
}
.Profile-GG-Img a:hover{
    text-decoration: underline !important;
}
.Profile-GG-Dropdown-Box h2{
    font-size: 20px;
    font-weight: 700;
    color: #000;
}
.Profile-GG-Dropdown-Box h3{
    font-size: 13px;
    font-weight: 500;
    margin-top: 8px;
    text-transform: uppercase;
}

.Profile-GG-Dropdown-Box-Btns{
    position: relative;
    width: 100%;
    height: auto;
    margin-top: 15px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.Profile-GG-Dropdown-Box-Btns button{
    position: relative;
    width: 100%;
    height: auto;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    border: 1px solid transparent;
    border-radius: 5px;
    font-size: 14px;
    transition: all 0.3s ease-in-out;
}

.Profile-GG-Dropdown-Box-Btns button.logout-btn{
    background-color: #3F8AEF;
    color: #fff !important;
}
.Profile-GG-Dropdown-Box-Btns button.logout-btn:hover{
    background-color: #5199f8 !important;
}

.Profile-GG-Dropdown-Box-Btns button.delete-btn{
    color: #ff6262 !important;
    background-color: #ffeeee;
}

.Profile-GG-Dropdown-Box-Btns button.delete-btn:hover{
    background-color: #ffe5e5;
}











/*llef-Padtys*/


.course-playing-sidebar{
    position: fixed;
    width: 300px;
    height: 100%;
    top: 60px;
    left: 0;
      background: #EFF2F6 !important;
    border-right: 1px solid #dbe0e1;
    overflow-y: auto;
    z-index: 600;
    padding:15px 0px !important;
    padding-bottom:100px !important;
    border-radius:0px !important;
}


@media screen and (max-width:1000px){
    .course-playing-sidebar{
        position:relative !important;
        width:100% !important;
        height:auto !important;
        top:0px !important;
        padding-bottom:15px !important;
    }
}

.course-playing-sidebar > .title{
    text-align:left !important;
    color:#3F8AEF !important;
    font-size:18px !important;
    padding:0px 25px !important;
    font-weight:600 !important;
    margin-bottom:10px !important;
    text-transform: uppercase !important;
}

.custom-accordion .accordion-item .accordion-header .accordion-button,
.accordion-item{
    background:transparent !important;
    color: #0f1114 !important;
}


.course-content-items .item a .checkbox, .course-content-items .item .checkbox{
    display:none !important;
}


.course-content-items li.item.active{
    background:#3F8AEF !important;
}
.course-content-items li.item.active a{
    color:#fff !important;
}

.course-content-items .item a,
.course-content-items li{
    font-size:13px !important;
    color: #666 !important;
    padding:0px !important;
   
}

.course-content-items .item a{
     border:1px solid rgba(0,0,0,0.1) !important;
     padding:5px !important;
     border-radius:inherit !important;
}

.course-content-items li{
    margin-top:10px !important;
}

.course-content-items li:first-child{
    margin-top:0px !important;
}


.custom-accordion .accordion-item .accordion-header .accordion-button{
    padding:15px 25px !important;
    border-bottom:1px solid rgba(0,0,0,0.1) !important;
    border-color:rgba(0,0,0,0.1) !important;
}

.custom-accordion .accordion-item{
    border-color:rgba(0,0,0,0.1) !important;
}


.course-content-items .lesson-icon{
    position:relative !important;
    display:inline-flex !important;
    border-radius:50px !important;
    border:1px solid rgba(0,0,0,0.1) !important;
    max-width:100px !important;
    align-items:center !important;
    gap:3px !important;
    padding:5px 15px !important;
    margin-top:10px !important;
    background:#fff !important;
}

.course-content-items .lesson-icon i{
    font-size:10px !important;
}

.course-content-items li.item.active a  .lesson-icon{
    border:1px solid rgba(225,225,225,0.2) !important;
    background:transparent !important;
}


/*rref-Padtys*/


.rref-Padtys{
    position: fixed;
    width: 250px;
    height: 100%;
    top: 60px;
    right: 0;
    background: #EFF2F6 !important;
    border-left: 1px solid #dbe0e1;
    overflow-y: auto;
    padding-bottom:100px !important;
}



@media screen and (max-width:1000px){
   .rref-Padtys{
        position:relative !important;
        width:100% !important;
        height:auto !important;
        top:0px !important;
        display:none !important; /*remove css*/
    }
}

/*CCggef-Padtys*/


.CCggef-Padtys{
    position:relative;
    width:100%;
    height:auto;
    min-height:100vh;
    padding-left:300px;
    padding-right:250px;
    padding-top:60px;
}

@media screen and (max-width:1000px){
   .CCggef-Padtys{
        padding:80px 0px !important;
    }
    
    .CCggef-Padtys-Main{
        padding:0px 20px !important;
    }
}



.course-playing {
    padding:0px !important;
}

.CCggef-Padtys-Main{
    position:relative;
    padding:0px 50px;
}





.pol-Yha{
    position:relative;
    width:100%;
    height:auto;
}


.pol-Yha-Img{
    position:relative;
    width:100%;
    height:auto;
}


.pol-Yha-Img img{
    width:100% !important;
}


.oolua{
     position:relative;
    width:100%;
    height:auto;
}
.oolua p{
     position:relative;
    width:100%;
    height:auto;
}

.oolua p img{
     position:relative;
    width:100%;
    height:auto;
}




.olok-Header{
    position:relative;
    width:100%;
    height:auto;
    margin-bottom:30px;
}

.olok-Header h2{
    font-size:30px;
    font-weight:600;
}

.opl-Dip-Headeree{
    position:relative;
    width:100%;
    display:flex;
    align-items:center;
    gap:5px;
    overflow:hidden;
    white-space:nowrap;
    font-size:12px;
    margin-bottom:15px;
}

.opl-Dip-Headeree a{
 color:#3F8AEF;   
}

.poal-gatgs{
    position:relative;
    width:100%;
    margin-top:10px;
    /*padding:15px 0px;*/
    border-bottom:1px solid #dbe0e1;
    /*background: #EFF2F6;*/
    
    display:flex;
    align-items:center;
    gap:25px;
}
.poal-gatgs p{
    color:#3F8AEF;
    font-size:15px;
    font-weight:500;
    padding:20px 0px;
    border-bottom:3px solid #3F8AEF;
}

.poal-gatgs a{
    position:relative;
    display:inline-flex;
    align-items:center;
    gap:5px;
    font-size:13px;
    padding:8px 15px;
    border-radius:8px;
    border:1px solid #3F8AEF;
    color:#3F8AEF;
}
.poal-gatgs a:hover{
    background: #3F8AEF;
    color:#fff;
}


.mmok-Carts{
    position:relative;
    margin-top:15px;
}

.mmok-Carts h3{
    font-size:16px;
    font-weight:600;
}
.mmok-Carts h3 span{
  text-transform:uppercase;  
}







.flip{
    box-shadow:none !important;
    background: #EFF2F6 !important;
       color: #0f1114 !important;
    border-right: 1px solid #dbe0e1;
}


.flip-clock-wrapper ul li a div .shadow{
    display:none !important;
}


.flip-clock-wrapper ul li a div div.inn{
      box-shadow:none !important;
    background: #EFF2F6 !important;
       color: #0f1114 !important;
    border-right: 1px solid #dbe0e1;
    text-shadow:none !important;
    font-size:18px !important;
}


.flip-clock-dot{
    box-shadow:none !important;
    width:7px !important;
    height:7px !important;
}

.btn-primary{
    background:#3F8AEF !important;
    font-size:14px !important;
}

.btn-primary:hover{
    background-color: #2877df !important;
}



@media screen and (max-width:1000px){
    .koakm-Ayha{
        padding:10px !important;
    }
    .koakm-Ayha span{
        display:none !important;
    }
    .kkjk-Navb-Main-2 button img{
        width:25px !important;
        height:25px !important;
    }
    
    .PPop-Lla{
        font-size:10px !important;
    }
}

@media screen and (max-width:450px){
    .kkjk-Navb-Main-2 button{
        display:none !important;
    }
}
    
    @media screen and (max-width:1000px){
    .olok-Header h2{
       font-size:20px !important;
    }
    .mmok-Carts h3{
        font-size:12px !important;
    }
    .poal-gatgs a{
        padding:7px 10px !important;
        font-size:10px !important;
    }
    .custom-accordion .accordion-item .accordion-header .accordion-button,
    .course-playing-sidebar > .title{
        font-size:14px !important;
    }
    }




	</style>
	
	
	
	
	
	
	
	
	
	
	
	<?php include "style.php"; ?>
</head>

<body>
<?php $full_page = $this->session->userdata('full_page_layout'); ?>

<nav class="kkjk-Navb">
    
    <div class="kkjk-Navb-Main">
         <div class="kkjk-Navb-Main-1">
          <a href="https://temp.artstraining.co.uk/home/" class="Dash-Nav-Logo">
          <img  src="<?php echo site_url('uploads/system/'.get_frontend_settings('dark_logo')) ?>" alt="" />
          <span>LMS</span>
        </a>
        
        <div class="kik-OOk">
            <a href="<?php echo site_url('home/course/'.slugify($course_details['title']).'/'.$course_details['id']); ?>">
						<?php $number_of_lessons = $this->crud_model->get_lessons('course', $course_details['id'])->num_rows(); ?>
						
						<p><?php echo $course_details['title']; ?></p>

						<i class="fas fa-arrow-right"></i>

						</a>
			
        </div>
        
        </div>
        
        
         <div class="kkjk-Navb-Main-2">
             
             		<?php if(isset($watch_history) && !empty($watch_history['completed_lesson']) && is_array(json_decode($watch_history['completed_lesson'], true))): ?>
				<p class="PPop-Lla"><?php echo $watch_history['course_progress'].'% '.get_phrase('Completed'); ?>(<?php echo count((array)json_decode($watch_history['completed_lesson'], true)) ?>/<?php echo $number_of_lessons; ?>)</p>
				<?php endif; ?>
				

				    <a href="<?php echo site_url('admin/course_form/course_edit/'.$course_details['id']); ?>" class="koakm-Ayha"><i class="fas fa-home"></i> <span>Dashboard</span></a>
				    
				     <div class="Profile-Top-Nav-Prev">
				    <button>
				        <img src="<?php echo site_url('uploads/system/user-img.jpg'); ?>" alt="" />
				    
				    </button>
				    
				    
				            <div class="Profile-GG-Dropdown">
                            <div class="Profile-GG-Dropdown-Box">
                              <div class="Profile-GG-Img">
                                 <img src="<?php echo site_url('uploads/system/user-img.jpg'); ?>" alt="" />
                                <a href="profile-settings.html">Profile Settings</a>
                              </div>
                              <h2>Prince Godson</h2>
                              <h3>A.R.T.S ID: 000132</h3>
                  
                              <div class="Profile-GG-Dropdown-Box-Btns">
                                <button class="logout-btn">Log out</button>
                                <button class="delete-btn">Delete account</button>
                              </div>
                  
                            </div>
                  
                          </div>
                          </div>
	
						
         </div>
        
        
        
    </div>
    
</nav>


<section class="llef-Padtys">
    
        <div class="Left-nav-icon-Ul fff-Ul-Ol">
      <p>Dashboard</p>
    </div>
    
    
</section>












<section class="rref-Padtys"></section>










<section class="CCggef-Padtys">
<div class="CCggef-Padtys-Main">
    
    
    <div class="olok-Header">
        
        <div class="opl-Dip-Headeree">
            <a href="<?=base_url('home/my_courses/');?>"><?=get_settings('system_name');?></a>
            
            <span>/</span>
            
            <a href="<?php echo site_url('home/course/'.slugify($course_details['title']).'/'.$course_details['id']); ?>">
						<?php $number_of_lessons = $this->crud_model->get_lessons('course', $course_details['id'])->num_rows(); ?>
						
					<?php echo $course_details['title']; ?>


						</a>
						
						<span>/</span>
						
						<p><?php echo $lesson_details['title']; ?></p>
        </div>

						
					 <h2><?php echo $course_details['title']; ?></h2>
					 
					 
					 <div class="poal-gatgs">
					     <p>Module</p>
					     <a href="javascript:void(0);" id="showRateButton"><i class="fas fa-comment-dots"></i> Drop a Review</a>
					 </div>
					 
					 
					 <div class="mmok-Carts">
					     <h3> <?php $section_name=$this->crud_model->get_section('section', $lesson_details['section_id'])->row('title'); echo $section_name && ($pos=strpos($section_name,':'))?substr($section_name,0,$pos):$section_name; ?>: <span><?php echo $lesson_details['title']; ?></span></h3>
					 </div>
					 
					 
					  


						
        
    </div>
    
    
	<!-- Start Course Playing -->
	<section class="course-playing">
		<div class="container-fluid00">
			<div class="row00 g-300 justify-content-center00">
				<!-- Sidebar -->
				<?php if($course_details['course_type'] == 'general'): ?>
					<?php if(!is_array($lesson_details)): ?>
						<h5 class="w-100 text-center text-black"><?php echo get_phrase('Course content not found') ?></h5>
						<p class="w-100 text-center"><?php echo get_phrase(/*'Please ensure that your course has at least one section and one lesson.'*/'no_lessons_available_at_this_time!'); ?></p>
					<?php endif; ?>

					<div class="<?php if($full_page){ echo 'col-lg-1200'; }else{ echo 'col-lg-400'; } ?> order-2">
						<?php include "sidebar.php"; ?>
					</div>
					<!-- Content -->
					<div class="<?php if($full_page){ echo 'col-lg-1200'; }else{ echo 'col-lg-800'; } ?> order-1">
						<?php if(is_array($lesson_details)): ?>
							<div class="course-playing-content">
								<div class="mb-4 mt-2" <?php if($full_page) echo 'style="margin-top: -2px; margin-left: -12px; margin-right: -12px;"'; ?>>
									<?php if(in_array($lesson_details['id'], $locked_lesson_ids) && $course_details['enable_drip_content']): ?>
					                    <div class="py-5">
					                        <?php echo remove_js(htmlspecialchars_decode_($drip_content_settings['locked_lesson_message'])); ?>
					                    </div>
					                <?php else: ?>
					                	<?php if(in_array($lesson_details['section_id'], $restricted_section_ids)): ?>
					                		<div class="py-5">
					                			<div class="locked-card">
								                    <i class="fas fa-lock text-30px"></i>
								                    <h6 class="w-100 text-center text-dark my-2"><?php echo get_phrase('This section is not included in the current study plan'); ?></h6>
								                    <small class="text-12px"><?php echo date('d M Y h:i A', $section['start_date']).' - '.date('d M Y h:i A', $section['end_date']); ?></small>
								                </div>
					                		</div>
										<?php else: ?>
											<?php include $course_details['course_type'].'_course_content_body.php'; ?>
										<?php endif ?>
									<?php endif; ?>
								</div>
								<div class="content">
									<div>
										<?php include "bottom_tabs.php"; ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				<?php else: ?>
					<div class="col-lg-1200">
						
						<?php include $course_details['course_type'].'_course_content_body.php'; ?>

						<div class="row">
							<div class="col-md-1200 pt-500">
								<?php include "bottom_tabs.php"; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	
	</div>
	
	</section>
	
	
    <!-- End Course Playing -->
    <?php include "includes_bottom.php"; ?>
    <?php include "common_scripts.php"; ?>
    <?php include "init.php"; ?>
    
    
    <script>
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
  
    </script>
    
    
    
</body>
</html>
