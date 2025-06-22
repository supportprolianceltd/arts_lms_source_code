<?php
echo <<<HTML
<div class="Crrart-Pappa margon-topGen">
  <div class="site-container">
    <div class="Crrart-Pappa-header">
      <h2 class="big-text">Shopping Cart</h2>
      <p><a href="$system_base_url/home">Home</a> <span>/</span> <span class="samppl-span">Shopping Cart</span></p>
    </div>


    <div class="Crrart-Pappa-Partss" id='shoppingCart'>
      $shopping_cart_inner
    </div>



  </div>
</div>
HTML;
?>