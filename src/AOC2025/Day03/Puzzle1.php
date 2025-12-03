<?php

namespace Jelle_S\AOC\AOC2025\Day03;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  public function __construct(protected string $input) {
  }

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
      $result += $this->getMaxJoltage($bank);
    }

    return $result;
  }
  
  public function getMaxJoltage(array $bank, $digits = 2) {
    $number = '';
    $length = 0;
    $lastKey = -1;
    while ($length < $digits) {
      $slice = array_slice($bank, $lastKey + 1, count($bank) - $lastKey - $digits + $length, true);
      $max = max($slice);
      $number .= $max;
      $lastKey = array_search($max, $slice);
      $length++;
    }
    return $number;
  }
}
