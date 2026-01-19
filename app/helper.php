<?php

function conversion($number) {
    $digit = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
    return $digit->format($number);
}
