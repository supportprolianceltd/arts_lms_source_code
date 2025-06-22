<?php
//$top_courses_sub_category_card_td=null;
//$categories_td_file='header_sub_category_cards_file';
//$categories_lists=$this->crud_model->get_sub_categories($top_courses_category_card['id']);
//require(__DIR__.'/../categories_list.php');

$td_top_courses_file='td_top_courses_header';
$top_courses=$top_courses_card;
$top_courses_sub_category_card_td=null;
require(__DIR__.'/../course_list_grid.php');
$td_top_courses_file=null;

$top_courses_category_card_td.=<<<HTML
<div class="Gen-Drop-Partt">
  <h3>{$top_courses_category_card['name']}</h3>
      <ul>
      $top_courses_sub_category_card_td
      <li><a href="$system_base_url/home/category/$top_courses_category_card_name_slug/{$top_courses_category_card['id']}" class="viewAll-Lii-A">All courses</a></li>
    </ul>

</div>
HTML;
?>
