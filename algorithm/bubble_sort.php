<?php

function bubble_sort($arr)
{
    $length = count($arr) - 1;
    $tmp = 0;
    for ($i = 0; $i < $length; ++$i) {
        for ($j = 0; $j < $length - $i; ++$j) {
            if ($arr[$j] > $arr[$j + 1]) {
                $tmp = $arr[$j + 1];
                $arr[$j + 1] = $arr[$j];
                $arr[$j] = $tmp;
            }
        }
    }

    return $arr;
}
