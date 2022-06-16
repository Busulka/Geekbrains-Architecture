<?php

const COUNT = 1000;
const MIN_RAND = 1;
const MAX_RAND = 3000;


function _randArray($count = COUNT, $minRand = MIN_RAND, $maxRand = MAX_RAND)
{
    if ($count != COUNT && $count > $maxRand - $minRand) {
        $minRand = 1;
        $maxRand = $count * 3;
    }
    $myArray = [];
    for ($i = 0; $i < $count; $i++) {
        $num = mt_rand($minRand, $maxRand);
        $myArray[] = $num;
    }
    return $myArray;
}

function getArr(): array
{
    return _randArray(1000);
}

//PHP сортировка
$arr = getArr();
$sortArr = sort($arr);


//Бинарный поиск
function binarySearch($myArray, $num)
{
    $start = 0;
    $end = count($myArray) - 1;
    $n = 0;

    while ($start <= $end) {
        $n++;

        $base = floor(($start + $end) / 2);


        if ($myArray[$base] == $num) {
            echo "Количество итераций: $n искомого числа $num" . PHP_EOL . "<br>";
            unset($myArray[$base]);
            return $base;

        } elseif ($myArray[$base] < $num) {
            $start = $base + 1;
        } else {
            $end = $base - 1;
        }
    }
    echo "Число не найдено! Количество итераций: $n -- $num" . PHP_EOL . "<br>";
    return null;
}

$num = 4;
binarySearch($arr, $num);
$test = count($arr);
echo $test;

foreach ($arr as $key) {
    $delNumber = array_search($num, $arr);
    if ($delNumber !== false) {
        unset($arr[$delNumber]);
    }
}