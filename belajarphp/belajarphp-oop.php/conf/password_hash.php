<?php
// Masukkan Password Yang Di Ingin Di Sini
$password_asli = 'admin123';

// Membuat Hash Yang Aman
$hash = password_hash($password_asli, PASSWORD_DEFAULT);

echo "Gunakan Hash Di Bawah Ini Untuk Menggantikan Password Di Database Anda:";
echo "<br><br>";
// Tampilkan Hash Agar Mudah Di Copy
echo "<strong>" . $hash . "</strong>";

// New HASH
// Ganti 'admin123' dengan password yang Anda inginkan
// $password_untuk_dihash = 'admin123';

// echo password_hash($password_untuk_dihash, PASSWORD_DEFAULT);

?>