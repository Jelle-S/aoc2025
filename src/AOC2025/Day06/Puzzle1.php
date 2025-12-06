<?php

namespace Jelle_S\AOC\AOC2025\Day06;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  public function __construct(protected string $input) {
  }

  public function solve() {
    $result = 0;

    $h = fopen($this->input, 'r');
    $homework = [];
    while (($line = fgets($h)) !== false) {
      $line = trim($line);
      $homework[] = array_map(fn ($v) => is_numeric($v) ? intval($v) : $v, preg_split("/\s+/", $line));
    }
    fclose($h);  
    
    $excercizes = array_map(null, ...$homework);
    
    return array_reduce($excercizes, fn($c, $v) => $c + (end($v) === '+' ? array_sum(array_slice($v, 0, -1)) : array_product(array_slice($v, 0, -1))), 0);
  }
}
