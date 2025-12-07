<?php

namespace Jelle_S\AOC\AOC2025\Day07;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  protected array $grid;
  
  public function __construct(protected string $input) {
    $this->grid = [];
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
    $beamStartPoints = new \Ds\Set();
    $result = $this->countBeamSplits($start, $beamStartPoints);
    return $result;
  }
  
  protected function countBeamSplits($position, \Ds\Set $beamStartPoints) {
    do {
      $posVal = $this->grid[$position[0]][$position[1]];
      $position = [$position[0] + 1, $position[1]];
    } while ($posVal !== '^' && isset($this->grid[$position[0]]));
    
    if (!isset($this->grid[$position[0]])) {
      return 0;
    }
    $left = [$position[0], $position[1] - 1];
    $right = [$position[0], $position[1] + 1];
    if ($beamStartPoints->contains($left) && $beamStartPoints->contains($right)) {
      return 0;
    }
    $count = 1;
    if (!$beamStartPoints->contains($left)) {
      $beamStartPoints->add($left);
      $count += $this->countBeamSplits($left, $beamStartPoints);
    }
    
    if (!$beamStartPoints->contains($right)) {
      $beamStartPoints->add($right);
      $count += $this->countBeamSplits($right, $beamStartPoints);
    }
    
    return $count;
  }
}
