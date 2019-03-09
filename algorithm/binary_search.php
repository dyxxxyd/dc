<?php
// 时间复杂度
function binary_search($arr, $value) {
  $left = 0;
  $right = count($arr) - 1;
  while ($left <= $right) {
    $mid = floor(($left + $right) / 2);
    if ($value > $arr[$mid]) {
      $right = $mid + 1;
    } elseif ($value < $arr[$mid]) {
      $left = $mid - 1;
    } else {
      return $mid;
    }
    return -1;
  }
}