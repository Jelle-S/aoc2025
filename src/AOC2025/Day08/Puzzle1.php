<?php

namespace Jelle_S\AOC\AOC2025\Day08;

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
    
    $distances = $this->distanceMatrix($points);
    $distances->sort();
    
    $circuits = [];
    $keys = $distances->keys();
    while (true) {
      $key = array_shift($keys);
      
      /* @var \Ds\Set $circuit */
      foreach ($circuits as $circuit) {
        if ($circuit->contains[$key[0]] && $circuit->contains($key[1])) {
          continue 2;
        }
        if ($circuit->contains($key[0])) {
          $circuit->add($key[1]);
          continue 2;
        }
        if ($circuit->contains($key[1])) {
          $circuit->add($key[0]);
        }
      }
    }
    
    

    return $result;
  }
  
  protected function distanceMatrix(array $points): \Ds\Map {
    
    $count = count($points);
    $matrix = new \Ds\Map();
    $keys = [];
    for ($i = 0; $i < $count; $i++) {
      for ($j = $i+1; $j < $count; $j++) {
        $keys[] = "$i|$j";
        $p1 = $points[$i];
        $p2 = $points[$j];
        $distance = sqrt(pow($p1[0] - $p2[0], 2) + pow($p1[1] - $p2[1], 2) + pow($p1[2] - $p2[2], 2));
        $matrix->put([$p1, $p2], $distance);
      }
    }
    return $matrix;
  }
}
