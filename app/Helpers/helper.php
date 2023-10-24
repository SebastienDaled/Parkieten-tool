<?php

function cardArray() {
    $cartItems = \Cart::getContent();

    return $cartItems->toArray;
    
}