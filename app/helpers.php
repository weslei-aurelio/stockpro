<?php

if(!function_exists('formatToDecimal')) 
{
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


# Realizar a formatação do atributo data para o seguinte padrão: dia/mes/ano h:i
if (!function_exists('formatDate')) 
{
    function formatDate($date, $format = 'd/m/Y H:i')
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}

# Realizar a formatação do atributo data para o seguinte padrão: dia/mes/ano h:i
if (!function_exists('date_mask')) {
    function date_mask($date)
    {
        return Carbon\Carbon::parse($date)->format('d/m/Y');
    }
}


# Calcula a difereça entre duas datas
if (!function_exists('datetimeDifference')) {
    function datetimeDifference($date_fim, $date_ini)
    {
        $datediff = strtotime($date_fim) - strtotime($date_ini);
        return (int) round($datediff / (60 * 60 * 24));
    }
}
