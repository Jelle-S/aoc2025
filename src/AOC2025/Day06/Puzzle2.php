<?php

namespace Jelle_S\AOC\AOC2025\Day06;

class Puzzle2 extends Puzzle1 {

  public function solve() {
    $result = 0;

    $homework = trim(file_get_contents($this->input));
    $lines = explode("\n", $homework);
    $operations = array_filter(explode(" ", array_pop($lines)));
    
    $max = max(array_map('strlen', $lines));
    $lines = array_map('str_split', $lines);
    $cursor = 0;
    
    foreach ($operations as $operation) {
      $numbers = [];
      while (true) {
        $number = implode('', array_map('trim', array_column($lines, $cursor)));
        $cursor++;
        if ($number === '') {
          $result += $operation === '*' ? array_product($numbers) : array_sum($numbers);
          break;
        }
        $numbers[] = intval($number);
      }
    }
    
    return $result;
  }
}
