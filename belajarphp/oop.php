<?php
// 01. Kelas dan Objek
class Siswa
{
  public $name;
  public $age;

  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }

  public function setAge($age)
  {
    $this->age = $age;
  }
  public function getAge()
  {
    return $this->age;
  }
}

$mhs1 = new Siswa();
$mhs1->setName("Budi");
$mhs1->setAge(24);

echo $mhs1->getName();
echo "<br>";
echo $mhs1->getAge();
echo "<br>";

// 02. Konstruktor
class Mahasiswa
{
  public $nama;
  public $umur;

  public function __construct($nama, $umur)
  {
    $this->nama = $nama;
    $this->umur = $umur;
  }

  public function getNama()
  {
    return $this->nama;
  }
  public function getUmur()
  {
    return $this->umur;
  }
}

$mhs1 = new Mahasiswa("Sandi", 25);

echo $mhs1->getNama();
echo "<br>";
echo $mhs1->getUmur();
echo "<br>";

// 03. Access Modifiers
class Penduduk
{
  public $nameP;
  protected $ageP;
  private $addressP;

  public function setAgeP($ageP)
  {
    $this->ageP = $ageP;
  }
  public function getAgeP()
  {
    return $this->ageP;
  }

  public function setAddressP($addressP)
  {
    $this->addressP = $addressP;
  }
  public function getAddressP()
  {
    return $this->addressP;
  }
}

$pddk = new Penduduk();
$pddk->setAgeP(43);
$pddk->setAddressP("Jakarta Barat");

echo $pddk->nameP = "Andri";
echo "<br>";
echo $pddk->getAgeP();
echo "<br>";
echo $pddk->getAddressP();
echo "<br>";

// 04. Inheritance
class Resident
{
  public $nameR;
  protected $ageR;
  private $addressR = "Jakarta";
}

class Bansos extends Resident
{
  public $nameR = "Anton";
  protected $ageR = 24;
  private $status = "Rich";
  private $addressR = "Jakarta";
  public function showResident()
  {
    echo $this->nameR . "<br>";
    echo $this->status . "<br>";
    echo $this->ageR . "<br>";
    echo $this->addressR . "<br><br>";
  }
}

$resident = new Bansos();
$resident->showResident();

echo $this->nameR . "<br>";
echo $this->status . "<br>";
echo $this->ageR . "<br>";
echo $this->addressR . "<br>";
?>