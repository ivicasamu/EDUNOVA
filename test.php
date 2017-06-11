<?php 

function spiral($xSize, $ySize, array $matrix) {
    $m = 10;
    $n = 10;
    $xSize--;
    $ySize--;

    while ($m <= $xSize && $n <= $ySize) {
        for ($i = $n; $i <= $ySize; ++$i) {
            print($matrix[$m][$i] . " ");
        }
        $m++;
        for ($i=$m; $i <= $xSize ; $i++) { 
            print($matrix[$i][$ySize] . " ");
        }
        $ySize--;
        for ($i=$ySize; $i >= $n ; $i--) { 
            print($matrix[$xSize][$i] . " ");
        }
        $xSize--;
        for ($i=$xSize; $i >= $m ; $i--) { 
            print($matrix[$i][$n] . " ");
        }
        $n++;
    }
}
?>