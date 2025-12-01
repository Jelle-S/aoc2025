<?php

namespace Jelle_S\AOC\AOC2025\Day01;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  public function __construct(protected string $input) {
  }

  public function solve() {
    $result = 0;

    $h = fopen($this->input, 'r');
    $pointer = 50;

    while (($line = fgets($h)) !== false) {
      $line = intval(str_replace(['L', 'R'], ['-', ''], trim($line)));
      $pointer += $line;
      $pointer %= 100;
      $pointer = $pointer < 0 ? 100 + $pointer : $pointer;
      if ($pointer === 0) {
        $result++;
      }
    }
    fclose($h);

    return $result;
  }
}
