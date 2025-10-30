<?php
// Object Oriented Programming (OOP)
class human
{
  // property : variable
  // method function : function

  public $mulut;
  public $nama;
  public $umur;
  // kebiasaan
  public function berbicara()
  {
    echo "Halo, Nama Saya " . $this->nama . " Saya seadang belajar di PPKD";
  }
}

// intance / buat : untuk membuat objek
$human = new Human();
$human->nama = "Wawan";
$human->berbicara();
?>