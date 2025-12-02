<?php

namespace Jelle_S\AOC\AOC2025\Day02;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  public function __construct(protected string $input) {
  }

  public function solve() {
    $result = 0;

    $h = fopen($this->input, 'r');
    $ranges = [];
    while (($line = fgets($h)) !== false) {
      $line = trim($line);
      $ranges = array_map(fn($v) => array_map('intval', explode('-', $v)), explode(',', $line));
    }
    fclose($h);
    
    foreach($ranges as $range) {
      $result += $this->sumInvalidIds(...$range);
    }

    return $result;
  }
  
  protected function sumInvalidIds(int $start, int $end): int {
    if (strlen((string) $start) === strlen((string) $end) && strlen((string) $start) % 2 !== 0) {
      return 0;
    }
    $sum = 0;
    for ($i = $start; $i <= $end; $i++) {
      $stri = (string) $i;
      $len = strlen($stri);
      if ($len % 2 !== 0) {
        continue;
      }
      
      if (substr($stri, 0, $len / 2) === substr($stri, $len / 2)) {
        $sum +=$i;
      }
    }
    
    return $sum;
  }
}
