<?php
function quick_sort($arr) {
  $length = count($arr);
  if ($length <= 1) return $arr;
  $left = $right = [];
  for ($i = 1; $i < $length; $i++) {
    if ($arr[$i] <= $arr[0]) {
      $left[] = $arr[$i];
    } else {
      $right[] = $arr[$i];
    }
  }
  $left = quick_sort($left);
  $right = quick_sort($right);
  return array_merge($left, [$arr[0]], $right);
}

// 优化