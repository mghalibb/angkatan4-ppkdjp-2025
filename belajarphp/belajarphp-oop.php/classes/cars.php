<?php
class Cars extends Vehicle {
  private $numberOfDoors;

  public function __construct($merk, $color, $numberOfDoors) {
    // $this->merk = $merk;
    // $this->color = $color;
    parent::__construct($merk, $color);
    $this->numberOfDoors = $numberOfDoors;
  }
  public function getNmrDoors() {
    return $this->numberOfDoors;
  }
}
?>