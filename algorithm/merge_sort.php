<?php
function MergeSort(&$arr) {
  $start = 0;
  $end = count($arr) - 1;
  MSort($arr, $start, $end);
}

function MSort(&$arr, $start, $end) {
  if ($start < $end) {
    $mid = floor(($start + $end) / 2);
    MSort($arr, $start, $mid);
    MSort($arr, $mid + 1, $end);
    Merge($arr, $start, $mid, $end);
  }
}

function Merge(&$arr, $start, $mid, $end) {
  $i = $start;
  $j = $mid + 1;
  $k = $start;
  $tmp = [];
  while ($i != $mid + 1 && $j != $end +1) {
    if ($arr[$i] >= $arr[$j]) {
      $tmp[$k++] = $arr[$j++];
    } else {
      $tmp[$k++] = $arr[$i++];
    }
  }

  while ($i != $mid + 1) {
    $tmp[$k++] = $arr[$i++];
  }

  while ($j != $end + 1) {
    $tmp[$k++] = $arr[$j++];
  }

  for ($i = $start; $i <= $end; $i++) {
    $arr[$i] = $tmp[$i];
  }
}

$arr = [9, 1, 5, 8, 3, 7, 4, 6, 2];
MergeSort($arr);
var_dump($arr);