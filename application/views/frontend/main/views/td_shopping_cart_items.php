<?php
$td_shopping_cart_items.=<<<HTML
        <div class="Crrart-Pappa-CArd">
          <div class="Crrart-Pappa-CArd-1">
            <img src="$top_course_img_url" />
          </div>
          <div class="Crrart-Pappa-CArd-2">
            <div class="Crrart-Pappa-CArd-2-Top">
              <div class="Crrart-Pappa-CArd-2-Top-1">
                <h2>{$top_course['title']}</h2>
                <p>{$top_course['short_description']}</p>
              </div>
              <div class="Crrart-Pappa-CArd-2-Top-2">
                $top_course_final_price_currency
              </div>
            </div>
            <div class="Crrart-Pappa-CArd-2-Foot">
              <div class='d-none'>
                <h4>4.4
                  <span>
                    <img src="$system_assets_base_url/img/rated-star.svg" />
                    <img src="$system_assets_base_url/img/rated-star.svg" />
                    <img src="$system_assets_base_url/img/rated-star.svg" />
                    <img src="$system_assets_base_url/img/half-rated-star.svg" />
                    <img src="$system_assets_base_url/img/unrated-star.svg" />
                  </span>

                  <b>(50 Reviews)</b>
                </h4>
              </div>
              <div class="Crrart-Pappa-CArd-2-Foot-Btns">

                <button class="remove-bbbna" onclick="actionTo('$system_base_url/home/handle_cart_items/{$top_course['id']}');"><i class="icon-trash"></i>Remove</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Crrart-Pappa-CArd -->
HTML;
?>
