<?php

function findDuplicates($arr) {
    $frequency = [];
    $duplicates = [];

    foreach ($arr as $element) {
        if (isset($frequency[$element])) {

            $duplicates[] = $element;
        } else {

            $frequency[$element] = true;
        }
    }

    return array_unique($duplicates);
}


$N = 5;
$a = [2, 3, 1, 2, 3];

$output = findDuplicates($a);
echo "Output: " . implode(' ', $output);

?>
