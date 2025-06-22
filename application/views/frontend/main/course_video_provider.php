<!-- Course preview modal -->
<?php
    $course_details_provider = "";
    $video_details = array();

    $course_details_video_url=$course_details['video_url'];
    if ($course_details['course_overview_provider'] == "html5") {
        $course_details_provider = 'html5';
    } elseif($course_details['course_overview_provider'] == "system"){
      $course_details_provider = 'system';
      $course_details_video_url="$system_base_url/files?course_id={$course_details['id']}&lesson_id=-1";
    } elseif($course_details['course_overview_provider'] == "youtube"){
        $course_details_provider = 'youtube';
    } elseif($course_details['course_overview_provider'] == "vimeo") {
        $video_details = $this->video_model->getVideoDetails($course_details['video_url']);
        $course_details_provider = 'vimeo';
    }

    $course_details_provider_extension=get_video_extension($course_details['video_url']);
    $course_details_provider_mime=null;

    switch($course_details_provider_extension){
      case 'mp4':$course_details_provider_mime='video/mp4';
      break;
      case 'webm':$course_details_provider_mime='video/webm';
      break;
      default:$course_details_provider_disp='d-none';
    }

    switch($course_details_provider){
      case 'youtube':
        $course_details_video_url=$course_details['video_url']?str_replace('youtu.be/','www.youtube.com/embed/',$course_details['video_url']):null;
        $player_provider_ui.=<<<HTML
          <div class="plyr__video-embed" id="player">
            <iframe height="500" src="$course_details_video_url?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
          </div>
HTML;
        break;
        case 'vimeo':
          $player_provider_ui.=<<<HTML
            <div class="plyr__video-embed" id="player">
              <iframe height="500" src="https://player.vimeo.com/video/{$video_details['video_id']}?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" allowfullscreen allowtransparency allow="autoplay"></iframe>
            </div>
HTML;
          break;
          case 'system':
          case 'html':
            $player_provider_ui.=<<<HTML
              <video poster="$course_img_url" height='300' width='100%' id="player" class='$course_details_provider_disp' playsinline controls style='max-height:300px !important;'>
                  <source src="$course_details_video_url" type="$course_details_provider_mime">
                  <h4>Video url is not supported</h4>
              </video>
HTML;
            break;
    }

?>