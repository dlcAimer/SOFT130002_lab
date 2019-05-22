<?php

function outputOrderRow($file, $title, $quantity, $price)
{
    $total = number_format($quantity * $price, 2);
    $f_price = number_format($price, 2);
    echo <<<EOT
        <tr>
        <td><img src="images/books/tinysquare/{$file}"></td>
        <td class="mdl-data-table__cell--non-numeric">{$title}</td>
        <td>{$quantity}</td>
        <td>${$f_price}</td>
        <td>${$total}</td>
        </tr>
        EOT;
}
