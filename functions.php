<?php

function getQueryResult($conn, $query)
{
    $rows = mysqli_query($conn, $query);
    return mysqli_fetch_all($rows, MYSQLI_ASSOC);
}

function toUpperLocale($str)
{
    $str = str_replace('i', 'İ', $str);
    $str = str_replace('ı', 'I', $str);
    return mb_strtoupper($str, "UTF-8");
}

function checkImageCountBoundary($currIndex, $count, $direction)
{
    if ($direction == 'left') {
        return ($currIndex - 1 == -1) ? $count - 1 : $currIndex - 1;
    }

    return ($currIndex + 1 == $count) ? 0 : $currIndex + 1;
}
