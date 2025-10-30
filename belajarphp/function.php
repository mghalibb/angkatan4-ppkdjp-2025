<?php
// function = blok code yang diberi nama, yang bisa dipanggil kapan saja untuk menjalankan tugas tertentu 
// -menghindari perulangan code (code reuse), memecah logika menjadi bagian terkecil
// -array_push(), substr(), strlen(), strword(), ucfirst()

function panggilAku($nama)
{
  // global $nama = "Bambang";
  // return " Hallo aku sore dari masa depan";
  echo " Hallo aku $nama sore dari masa depan <br>";
}

panggilAku("Bambang");
// echo panggilAku("Bambang");
// echo panggilAku("Wawan");

// array_push()
$users = [
  [
    "id" => 123456,
    "name" => "Susi"
  ],
  [
    "id" => 654321,
    "name" => "Ronji"
  ]
];

array_push($users, ["id" => 4444, "name" => "Galih"]);
?>
<ul>
  <?php
  foreach ($users as $user) {
    ?>
    <li>ID Users : <?php echo $user['id'] ?></li>
    <li>Name Users : <?php echo $user['name'] ?></li><br>
    <?php
  }
  ?>
</ul>

<?php
// substr() = untuk memotong kalimat dengan menggunakan length 
$string = "saya sedang belajar bahasa pemograman dasar pada bahasa Pemograman PHP";
$substr = substr($string, 5);
echo $substr . "<br>";

// strlen()
$strlen = strlen($string);
echo $strlen . "<br>";

// str_word_count()
$str_word_count = str_word_count($string);
echo $str_word_count . "<br>";

// ucwords()
$ucwords = ucwords($string);
echo $ucwords . "<br>";

// ucfirst()
$ucfirst = ucfirst($string);
echo $ucfirst . "<br>";

?>