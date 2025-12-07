<?php

namespace Jelle_S\AOC\AOC2025\Day07;

class Puzzle2 extends Puzzle1 {
  
  protected \Ds\Map $cache;
  
  public function __construct(string $input) {
    parent::__construct($input);
    
    $this->cache = new \Ds\Map();
  }

  public function solve() {
    $result = 0;

    $h = fopen($this->input, 'r');
    $start = null;
    $this->grid = [];
    while (($line = fgets($h)) !== false) {
      $line = trim($line);
      if (is_null($start)) {
        $start = [0, strpos($line, 'S')];
      }
      $this->grid[] = str_split($line);

    }
    fclose($h);
    $result = $this->countTimeLines($start);
    return $result;
  }
  
  protected function countTimeLines($position) {
    do {
      $posVal = $this->grid[$position[0]][$position[1]];
      $position = [$position[0] + 1, $position[1]];
    } while ($posVal !== '^' && isset($this->grid[$position[0]]));
    
    if (!isset($this->grid[$position[0]])) {
      return 1;
    }
    $left = [$position[0], $position[1] - 1];
    $right = [$position[0], $position[1] + 1];
    $lKey = $rKey = $position;
    $lKey[] = 'L';
    $rKey[] = 'R';
    if (!$this->cache->hasKey($lKey)) {
      $lCount = $this->countTimeLines($left);
      $this->cache->put($lKey, $lCount);
    }
    if (!$this->cache->hasKey($rKey)) {
      $rCount = $this->countTimeLines($right);
      $this->cache->put($rKey, $rCount);
    }
    return $this->cache->get($lKey) + $this->cache->get($rKey);
  }
}
