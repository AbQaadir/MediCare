<?php

require_once("cart-new.php");
function cartElements($productimg, $productname, $productprice, $productid, $qty)
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
              </div>
                <div class=\"quantity\">
                <form action=\"shopping_cart.php\" method=\"post\" class=\"cart-items\">
                        <input type=\"hidden\" name=\"update_quantity_id\" value=$productid>
                        <button type=\"submit\" id=\"\minusbtn\" class=\"updateBtn\" name=\"update_update_btn_mins\">-</button>
                        <input type=\"number\" name=\"update_quantity\" min=\"1\" value=$qty class=\"in\">
                        <button type=\"submit\" class=\"updateBtnn\" name=\"update_update_btn\">+</button>
                    </form>
                </div>
              <div>
                <button class=\"removee\">Remove</button>
              </div>
      
    </div>
         
</form>
       </div> 
       <hr>";
  return $element;
}
