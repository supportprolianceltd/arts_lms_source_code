<?php
$shopping_cart_inner=<<<HTML
      <div class="Crrart-Pappa-Partss-1">
        <div class="Crrart-Pappa-Partss-1-header">
          <h3>$num_cart_items Courses in Cart</h3>
        </div>

        $td_shopping_cart_items

      </div>
      <div class="Crrart-Pappa-Partss-2">
        <div class="Crrart-Pappa-Partss-2-Main">
          <div class="Crrart-Pappa-Partss-1-header">
            <h3>Total</h3>
          </div>

          <div class="Crrart-Check-Boosia">
            $course_price
            <button class="LL-btn-Bg" onclick="location='$system_base_url/home/course_payment'">Proceed to Checkout <i class="ti-arrow-right"></i></button>
            <p><i class="fa fa-info-circle"></i> Transactions are 100% Safe and Secure</p>
          </div>
        </div>
      </div>
HTML;
?>