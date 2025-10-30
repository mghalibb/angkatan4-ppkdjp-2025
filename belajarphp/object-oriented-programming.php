<?php
// Soal 01
class Hewan
{
  public $nama;
  public $jenis;
}

$dataHewan = [];

$hewan = new Hewan();
$hewan->nama = "Kucing";
$hewan->jenis = "Mamalia";

$dataHewan[] = [
  "nama" => $hewan->nama,
  "jenis" => $hewan->jenis
];

$hewan->nama = "Burung";
$hewan->jenis = "Aves";

$dataHewan[] = [
  "nama" => $hewan->nama,
  "jenis" => $hewan->jenis
];

foreach ($dataHewan as $hw) {
  echo "<strong>Soal 01</strong><br>";
  echo "Nama : " . $hw["nama"] . "<br>";
  echo "Jenis : " . $hw["jenis"] . "<br><br>";
}

// Soal 02
class Lingkaran
{
  public $jari2;

  public function lusa()
  {
    return 3.14 * $this->jari2 * $this->jari2;
  }
}
$lingkaran = new Lingkaran();
$lingkaran->jari2 = 7;
echo "<strong>Soal 02</strong><br>";
echo "Jari-Jari Lingkaran : " . $lingkaran->jari2 . "<br>";
echo "Luas Lingkaran : " . $lingkaran->lusa() . "<br><br>";

// Soal 03
class Mahasiswa
{
  public $nama;
  public $nim;
  public $semester;
  public $noHp;

  public function __construct($nama, $nim, $semester, $noHp)
  {
    $this->nama = $nama;
    $this->nim = $nim;
    $this->semester = $semester;
    $this->noHp = $noHp;
  }
}
$dataMahasiswa = [
  "nama" => "Ghalib",
  "nim" => "C2B018008",
  "semester" => 3,
  "noHp" => "081234567890"
];
$mahasiswa = new Mahasiswa(
  $dataMahasiswa["nama"],
  $dataMahasiswa["nim"],
  $dataMahasiswa["semester"],
  $dataMahasiswa["noHp"]
);
echo "<strong>Soal 03</strong><br>";
echo "Nama : " . $mahasiswa->nama . "<br>";
echo "NIM : " . $mahasiswa->nim . "<br>";
echo "Semester : " . $mahasiswa->semester . "<br>";
echo "No HP : " . $mahasiswa->noHp . "<br><br>";

// Soal 04
class Matakuliah
{
  public $nama;
}
class Dosen
{
  public $nama;
  public $alamat;
  public $matkul;
}
$matkul1 = new Matakuliah();
$matkul1->nama = "Web Programing";

$dosen1 = new Dosen();
$dosen1->nama = "Pak Budi";
$dosen1->alamat = "Jl. Merdeka No. 10";
$dosen1->matkul = $matkul1;

echo "<strong>Soal 04</strong><br>";
echo "Nama Dosen : " . $dosen1->nama . "<br>";
echo "Alamat : " . $dosen1->alamat . "<br>";
echo "Mengajar Mata Kuliah : " . $dosen1->matkul->nama . "<br><br>";

// Soal 05
class Pegawai
{
  public $nama;
  public function tampilkanData()
  {
    echo "Nama Pegawai : " . $this->nama . "<br>";
  }
}
class Manager extends Pegawai
{
  public $departemen;
  public function tampilkanData()
  {
    echo "Nama Manajer : " . $this->nama . "<br>";
    echo "Departemen : " . $this->departemen . "<br>";
  }
}
echo "<strong>Soal 05</strong><br>";
echo "<strong>Info Pegawai:</strong><br>";
$pegawai1 = new Pegawai();
$pegawai1->nama = "Budi";
$pegawai1->tampilkanData();

echo "<strong>Info Manajer:</strong><br>";
$manajer1 = new Manager();
$manajer1->nama = "Siti";
$manajer1->departemen = "Keuangan<br>";
$manajer1->tampilkanData();

// Soal 06
class Produk
{
  public $nama;
  protected $harga;
  private $stock;

  public function __init($nama, $harga, $stock)
  {
    $this->nama = $nama;
    $this->harga = $harga;
    $this->stock = $stock;
  }

  public function tampilkanInfoInternal()
  {
    echo "--- Akses dari Dalam Class Produk ---<br>";
    echo "Nama: " . $this->nama . " (Public)<br>";
    echo "Harga: " . $this->harga . " (Protected)<br>";
    echo "Stock: " . $this->stock . " (Private)<br>";
    echo "-------------------------------------<br><br>";
  }
}
class Elektronik extends Produk
{
  public function testAksesDariTurunan()
  {
    echo "--- Akses dari Dalam Class Turunan (Elektronik) ---<br>";
    echo "Mengakses 'nama' (public): " . $this->nama . "<br>";
    echo "Mengakses 'harga' (protected): " . $this->harga . "<br>";
    echo "Tidak bisa mengakses 'stock' (private) dari class turunan.<br>";
    echo "--------------------------------------------------<br><br>";
  }
}

echo "<strong>Soal 06</strong><br>";

$produk1 = new Produk();
$produk1->__init("Laptop", 10000000, 50);
$produk1->tampilkanInfoInternal();

$elektronik1 = new Elektronik();
$elektronik1->__init("Handphone", 5000000, 100);

echo "--- Akses dari Luar Class (Object) ---<br>";
echo "Mengakses 'nama' (public): " . $elektronik1->nama . "<br>";
echo "Tidak bisa mengakses 'harga' (protected) dari luar class.<br>";
echo "Tidak bisa mengakses 'stock' (private) dari luar class.<br>";
echo "----------------------------------------<br><br>";

$elektronik1->testAksesDariTurunan();

// Soal 07
class Laptop
{
  private $merk;

  public function setMerk($merk)
  {
    $this->merk = $merk;
  }
  public function getMerk()
  {
    return $this->merk;
  }
}

$laptopSaya = new Laptop();
$laptopSaya->setMerk("HP");

echo "<strong>Soal 07</strong><br>";
echo "Merk laptop saya adalah: " . $laptopSaya->getMerk() . "<br><br>";

// Soal 08
class Utilitas {
  public static function halo() {
    echo "Halo, Dunia!!";
  }
}
echo "<strong>Soal 08</strong><br>";
Utilitas::halo();

?>