<?php

require_once("check-out.php");
function cartElements_checkOut($productimg, $productname, $productprice, $productid, $qty)
{

    $imageUrl = "../uploaded_img/$productimg";
    $productprice = $productprice * $qty;

    $element = "<hr><div class=\"item\" data-product-id=\"$productid\">
     <form action=\"shopping_cart.php?action=removee&id_P=$productid\" method=\"post\" class=\"cart-items\" >
    <div class=\"item\" data-product-id=\"<?php echo $productid; ?>\">
              <div class=\"image\">
                  <img src=\"$imageUrl\" >
              </div>
              <div class=\"productName\">
              $productname
              </div>
              <div class=\"qty\">
                Qty:$qty
                </div>

              <div class=\"totalPrice\">
              LKR $productprice/=
              </div>
                
      
    </div>
         
</form>
       </div> 
       <hr>";
    return $element;
}
?>