<?php

require_once("wishlist.php");
function wishCartElements($productimg, $productname, $productprice, $productid)
{

  $filename = "uploads/".basename($productimg);

  $element = "<hr><div class=\"item\" data-product-id=\"$productid\">
     <form action=\"cart-new.php?action=removee&id=$productid\" method=\"post\" class=\"cart-items\" >
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
                <button class=\"removee\">Remove</button>
              </div>
      
    </div>
         
</form>
       </div> 
       <hr>";
  return $element;
}
