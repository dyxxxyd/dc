<?php

function bubble_sort($arr)
{
    $length = count($arr) - 1;
    for ($i = 0; $i < $length; ++$i) {
        for ($j = 0; $j <= $i - 1; ++$j) {
            if ($arr[$j] > $arr[$j++]) {
                $tmp = $arr[$j];
                $arr[$j + 1] = $arr[$j];
                $arr[$j] = $tmp;
            }
        }
    }

    return $arr;
}
