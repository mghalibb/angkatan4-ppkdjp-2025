<?php
$students = [
  [
    "NIM" => "C2B0B1K",
    "Nama" => "Sinta Kusama Ningsih",
    "Alamat" => "Jl. Cendana",
    "HP" => 62821588754,
    "File" => "foto-1.jpg"
  ],
  [
    "NIM" => "C2B0B2K",
    "Nama" => "Rudi Hilton",
    "Alamat" => "Jl. Cendana",
    "HP" => 628215826478,
    "File" => "foto-2.jpg"
  ],
  [
    "NIM" => "C2B0B3K",
    "Nama" => "Bamabang Setya",
    "Alamat" => "Jl. Cendana",
    "HP" => 62821588564,
    "File" => "foto-3.jpg"
  ],
  [
    "NIM" => "C2B0B4K",
    "Nama" => "Sanuhi Johar",
    "Alamat" => "Jl. Cendana",
    "HP" => 62821586358,
    "File" => "foto-4.jpg"
  ],
  [
    "NIM" => "C2B0B5K",
    "Nama" => "Sahrony",
    "Alamat" => "Jl. Karet",
    "HP" => 628215878585,
    "File" => "file-5.pdf"
  ]
]

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabel Dengan Perulangan</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <div class="container-fluid my-3">
    <h2 class="text-center fw-bold">Membuat Tabel</h2>
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <div class="card-title fw-bold">Data Mahasiswa</div>
          </div>
          <div class="card-body">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>No HP</th>
                  <th>Foto</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php
                  foreach ($students as $key => $student) {
                    ?>
                  <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><?php echo $student['NIM'] ?></td>
                    <td><?php echo $student['Nama'] ?></td>
                    <td><?php echo $student['Alamat'] ?></td>
                    <td><?php echo $student['HP'] ?></td>
                    <td>
                      <?php
                      if (pathinfo($student['File'], PATHINFO_EXTENSION) == "jpg") {
                        ?>
                        <img src="assets/img/<?php echo $student['File'] ?>" width="100" alt="img">
                        <?php
                      } elseif (pathinfo($student['File'], PATHINFO_EXTENSION) == "pdf") {
                        ?>
                        <a href="assets/img/<?php echo $student['File'] ?>"
                          target="_blank"><?php echo $student['File'] ?></a>
                        <?php
                      }
                      ?>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                </tr>
              </tbody>
              <tfoot>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Foto</th>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <div class="col-2"></div>
    </div>
    <table class="table table-bordered">
      <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Foto</th>
      </tr>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
    integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
    crossorigin="anonymous"></script>
</body>

</html>