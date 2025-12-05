<?php

namespace Jelle_S\AOC\AOC2025\Day05;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  public function __construct(protected string $input) {
  }

  public function solve() {
    $result = 0;

    list($ranges, $ids) = explode("\n\n", file_get_contents($this->input));
    
    $ranges = $this->squashRanges(array_map(fn($v) => array_map('intval', explode('-', $v)), explode("\n", $ranges)));
    
    $result = $this->countFreshProducts(array_map('intval', explode("\n", $ids)), $ranges);

    return $result;
  }
  
  protected function squashRanges($ranges) {
    usort($ranges, fn($a, $b) => $a[0] < $b[0] ? -1 : 1);
    $newRanges = [array_shift($ranges)];
    foreach ($ranges as $range) {
      end($newRanges);
      $lastKey = key($newRanges);
      if ($range[0] <= $newRanges[$lastKey][1]) {
        $newRanges[$lastKey][1] = max($newRanges[$lastKey][1], $range[1]);
        continue;
      }
      $newRanges[] = $range;
    }
    
    return $newRanges;
  }
  
  protected function countFreshProducts($ids, $ranges) {
    sort($ids);
    $count = 0;
    foreach ($ids as $id) {
      foreach ($ranges as $key => $range) {
        if ($id > $range[1]) {
          unset($ranges[$key]);
          continue;
        }
        if ($id >= $range[0] && $id <= $range[1]) {
          $count++;
          continue 2;
        }
      }
    }
    return $count;
  }
}
