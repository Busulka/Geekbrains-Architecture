<?php
/*
 $n = 100;
$array[]= [];
for ($i = 0; $i < $n; $i++) {
  for ($j = 1; $j < $n; $j *= 2) {
     $array[$i][$j]= true;
} }


O(n*log(n))


$n = 100;
$array[] = [];
for ($i = 0; $i < $n; $i += 2) {
  for ($j = $i; $j < $n; $j++) {
   $array[$i][$j]= true;
} }

O(n^2)
 */