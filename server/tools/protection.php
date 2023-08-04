<?php

function filterRequest($nameRequest)
{
    return htmlspecialchars(strip_tags($_POST[$nameRequest]));
}