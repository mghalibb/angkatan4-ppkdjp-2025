<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabel dengan Perulangan</title>
  <style>
    table {
      border-collapse: collapse;
    }

    td {
      width: 40px;
      height: 40px;
      border: 1px solid black;
      text-align: center;
      vertical-align: middle;
    }
  </style>
</head>

<body>
  <h2>Membuat Tabel 1 Baris dan 10 Kolom</h2>
  <table>
    <?php
    $kolom = 5;
    for ($i = 1; $i <= $kolom; $i++) {
      ?>
      <tr>
        <?php
        for ($x = 1; $x <= 5; $x++) {
          if (($i + $x) % 2 == 0) {
            $bgcolor = '#ff0000ff';
          } else {
            $bgcolor = '#ffffffff';
          }
          ?>
          <td style="background-color: <?php echo $bgcolor; ?>"><?php echo $i . "," . $x ?></td>
          <?php
        }
        ?>
      </tr>
      <?php
    }
    ?>
  </table>
</body>

</html>