<?php
// 时间复杂度：平均 O(nlog<sub>n</sub>), 最差 O(n<sup>2</sup>)
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

// 三色球问题
// 一个数组存放三种颜色的球，对数组排序，使颜色为RGB
function quick_sort_color($arr) {
  $i = 0;
  $j = count($arr) - 1;
  while ($i < $j) {
    while ($arr[$j] == 'B') --$j;
    while ($arr[$j] !== 'B') ++$i;
    if ($i >= $j) break;
    swap($arr[$i], $arr[$j]);
    ++$i;
    --$j;
  }
  $i = 0;
  while ($i < $j) {
    while ($arr[$i] == 'R') ++$i;
    while ($arr[$j] != 'R') --$j;
    if ($i >= $j) break;
    swap($arr[$i], $arr[$j]);
    ++$i;
    --$j;
  }
}