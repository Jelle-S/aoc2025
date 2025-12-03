<?php

namespace Jelle_S\AOC\AOC2025\Day03;

class Puzzle2 extends Puzzle1 {

  public function solve() {
    $result = 0;

    $h = fopen($this->input, 'r');
    $banks = [];
    while (($line = fgets($h)) !== false) {
      $line = trim($line);
      $banks[] = array_map('intval', str_split($line));
    }
    fclose($h);
    
    foreach ($banks as $bank) {
      $result += $this->getMaxJoltage($bank, 12);
    }

    return $result;
  }
}
