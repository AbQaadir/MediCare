<?php

require_once("wishlist.php");
function wishCartElements($productimg, $productname, $productprice, $productid)
{

  $filename = "uploads/".basename($productimg);

  $element = "<hr><div class=\"item\" data-product-id=\"$productid\">
     <form action=\"wishlist.php?action=removee&id=$productid\" method=\"post\" class=\"cart-items\" >
    <div class=\"item\" data-product-id=\"<?php echo $productid; ?>\">
              <div class=\"image\">
                  <img src=\"$filename\" >
              </div>
              <div class=\"productName\">
                   $productname
              </div>

              <div class=\"totalPrice\">
                   LKR.$productprice./=
              </div
              <div>
                    <button name='remove' class=\"removee\">Remove</button>

                    
                  <button name='add-by-wish' class='add-to-cart-btn' data-product-id='$productid'>Add to Cart</button>
                  
              </div>
              
                  
            


      
    </div>
         
</form>
      
       <hr>";
  return $element;
}
