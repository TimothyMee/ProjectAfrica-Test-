<?php

function createCardNo($firstname, $lastname)
{
    $cardNo = substr($firstname, 0, 2). substr($lastname, -2). \Illuminate\Support\Str::random(7);
    return $cardNo;
}