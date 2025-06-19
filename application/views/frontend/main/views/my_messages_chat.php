<?php
echo <<<HTML
  <section class="page-section">
    <div class="main-section">
      
    
      <div class="m-container m-container-2">
        <div class="m-container-body"></div>
  <div class="chat-sec">
    <div class="chat-sec-Head">
            <div class="chat-sec-header">
                <img src="$this_conversation_user_info_image" />
                  <div class="chat-sec-header-txt">
                <p>{$this_conversation_user_info['first_name']} {$this_conversation_user_info['last_name']}</p>
                <span>Instructor</span>
            </div>
            </div>

            </div>


            <div class="message-sec">
                $td_my_messages_chat

            </div><!--message-sec-->

                <form id='chat_form' action="{$system_base_url}home/my_messages_chat/send_reply/$message_thread_code" method=post>
                    <div class="chat-sec-footer">
                            <div class="chat-sec-foote-input">
                                <textarea type="text" name="message" placeholder="Type your message here.."></textarea>
                            </div>
                        <ul class="chat-sec-footer-btns">
                            <li class='d-none'>
                                <input type="file" id="upload-chat-img" name="">
                                <label for="upload-chat-img"><i class="icon-picture"></i></label>
                            </li>                      
                            <li class="send-btn" onclick='chat_form.submit();'><i class="fa fa-send"></i></li>
                        </ul>
                    </div>
                </form>


        </div><!--chat-sec-->

        </div><!--m-container-->
        
        

      

    </div><!-- main-section -->
    
    
   
        
        
HTML;
?>

<style>
    .main-section{
        padding:10px !important;
    }
    @media screen and (max-width:700px){
          .main-section{
        padding:0px 10px !important;
    }
    }
</style>