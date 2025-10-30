<?php
class Vehicle {
  protected $color, $merk;

  public function __construct($color, $merk) {
    $this->color = $color;
    $this->merk = $merk;
  }

  public function getMerk() {
    return $this->merk;
  }
  public function getColor() {
    return $this->color;
  }
}
?>