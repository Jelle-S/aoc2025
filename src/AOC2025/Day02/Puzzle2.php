<?php

namespace Jelle_S\AOC\AOC2025\Day02;

class Puzzle2 extends Puzzle1 {

  protected function sumInvalidIds(int $start, int $end): int {
    $sum = 0;
    for ($i = $start; $i <= $end; $i++) {
      $stri = (string) $i;
      $len = strlen($stri);
      for ($j = 2; $j <= $len; $j++) {
        if ($len % $j !== 0) {
          continue;
        }
        if (count(array_unique(str_split($stri, $len / $j))) === 1) {
          $sum +=$i;
          continue 2;
        }
      }
    }
    
    return $sum;
  }
}
