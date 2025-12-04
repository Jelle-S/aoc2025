<?php

namespace Jelle_S\AOC\AOC2025\Day04;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  public function __construct(protected string $input) {
  }

  public function solve() {
    $result = 0;

    $h = fopen($this->input, 'r');
    $grid = [];
    while (($line = fgets($h)) !== false) {
      $line = trim($line);
      $grid[] = str_split($line);
    }
    fclose($h);
    
    foreach ($grid as $y => $row) {
      foreach ($row as $x => $pos) {
        if ($pos !== '@') {
          continue;
        }
        $neighbours = [[-1, -1], [-1, 0], [-1, 1], [0, -1], [0, 1], [1, -1], [1, 0], [1, 1]];
        $freespaces = 0;
        foreach ($neighbours as $deltas) {
          list($dx, $dy) = $deltas;
          if (!isset($grid[$y + $dy])) {
            $freespaces++;
            continue;
          }
          if (!isset($grid[$y + $dy][$x + $dx]) || $grid[$y + $dy][$x + $dx] === '.') {
            $freespaces++;
            continue;
          }
        }

        $result += $freespaces >= 5 ? 1 : 0;
      }
    }

    return $result;
  }
}
