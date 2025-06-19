<?php

if(!function_exists('formatToDecimal')) {

    function formatToDecimal($valor) {
    
        if (!$valor) return null;
        $valorFormatado = str_replace(['.', ','], ['', '.'], $valor);
        return number_format((float) $valorFormatado, 2, '.', '');
    }
}

function money_mask($amount)
{
    return (number_format($amount, 2, ',', '') !== null ? number_format($amount, 2, ',', '.') : '');
}