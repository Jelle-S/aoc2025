<?php

namespace Jelle_S\AOC\AOC2025\Day09;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  public function __construct(protected string $input) {
  }

  public function solve() {
    $result = 0;

    $h = fopen($this->input, 'r');
    $points = [];
    while (($line = fgets($h)) !== false) {
      $line = trim($line);
      $points[] = array_map('intval', explode(',', $line));
    }
    fclose($h);
    
    $count = count($points);
    for ($i = 0; $i < $count; $i++) {
      for ($j = $i + 1; $j < $count; $j++) {
        $result = max($result, (abs($points[$i][0] - $points[$j][0]) + 1) * (abs($points[$i][1] - $points[$j][1]) + 1));
      }
    }

    return $result;
  }
}
