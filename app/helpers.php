<?php

if(!function_exists('formatToDecimal')) {

    function formatToDecimal($valor) {
    
        if (!$valor) return null;
        $valorFormatado = str_replace(['.', ','], ['', '.'], $valor);
        return number_format((float) $valorFormatado, 2, '.', '');
    }
}