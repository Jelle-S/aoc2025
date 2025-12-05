<?php

namespace Jelle_S\AOC\AOC2025\Day05;

class Puzzle2 extends Puzzle1 {

  public function solve() {
    $result = 0;

    list($ranges, $ids) = explode("\n\n", file_get_contents($this->input));
    
    $ranges = $this->squashRanges(array_map(fn($v) => array_map('intval', explode('-', $v)), explode("\n", $ranges)));
    
    $result = $this->countAllFreshProducts($ranges);

    return $result;
  }
  
  protected function countAllFreshProducts($ranges) {
    return array_reduce($ranges, fn ($c, $v) => $c + $v[1] - $v[0] + 1, 0);
  }
}
