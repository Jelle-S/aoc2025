<?php

namespace Jelle_S\AOC\AOC2025\Day01;

class Puzzle2 extends Puzzle1 {

  public function solve() {
    $result = 0;

    $h = fopen($this->input, 'r');
    $pointer = 50;

    while (($line = fgets($h)) !== false) {
      $line = intval(str_replace(['L', 'R'], ['-', ''], trim($line)));
      for ($i = min($line, 0); $i < max($line, 0); $i++) {
        $pointer += $line > 0 ? 1 : -1;
        $pointer %= 100;
        $pointer = $pointer < 0 ? 100 + $pointer : $pointer;
        if ($pointer === 0) {
          $result++;
        }
      }
    }
    fclose($h);

    return $result;
  }
}
