<?php

namespace Jelle_S\AOC\AOC2025\Day04;

class Puzzle2 extends Puzzle1 {

  public function solve() {
    $result = 0;

    $h = fopen($this->input, 'r');
    $grid = [];
    while (($line = fgets($h)) !== false) {
      $line = trim($line);
      $grid[] = str_split($line);
    }
    fclose($h);

    do {
      $removed = false;
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
          if ($freespaces >= 5) {
            $grid[$y][$x] = '.';
            $removed = true;
            $result += 1;
          }
        }
      }
    } while ($removed);

    return $result;
  }
}
