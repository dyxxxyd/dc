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

// 优化思路：减少比较次数和交换次数

function bubble_sort_v2($arr)
{
    $tmp = 0;
    $length = count($arr);
    for ($i = 0; $i < $length; ++$i) {
        $flag = true;
        for ($j = 0; $j < $length - 1; ++$j) {
            if ($arr[$j] < $arr[$j + 1]) {
                $tmp = $arr[$j + 1];
                $arr[$j + 1] = $arr[$j];
                $arr[$j] = $tmp;
                $flag = false;
            }
        }
        if ($flag) {
            break;
        }
        echo 'loop i: '.$i.PHP_EOL;
    }

    return $arr;
}
