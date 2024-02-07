<?php

function generateCartRow($imageSrc, $productName, $productDescription, $unitPrice, $quantity = 1)
{

    // Calculate total amount
    $totalAmount = $unitPrice * $quantity;

    // HTML for the cart row
    $cartRowHTML = '
        <tr>
            <td class="image"><img src="' . $imageSrc . '" alt="#"></td>
            <td class="product-des">
                <p class="product-name"><a href="#">' . $productName . '</a></p>
                <p class="product-des">' . $productDescription . '</p>
            </td>
            <td class="price" data-title="Price"><span class="unit-price">' . number_format($unitPrice, 2) . '</span></td>
            <td class="qty">
                <div class="input-group">
                    <button class="btn-number" data-type="minus">-</button>
                    <input type="text" name="quant[]" class="input-number" value="' . $quantity . '">
                    <button class="btn-number" data-type="plus">+</button>
                </div>
            </td>
            <td class="total-amount"><span class="total">' . number_format($totalAmount, 2) . '</span></td>
            <td class="action"><button class="btn-number" style="background-color: red;"> Remove </button></td>
        </tr>
    ';

    return $cartRowHTML;
}
