<!DOCTYPE html>
<html>

<head>
    <title>Order Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid green;
        }

        table {
            width: 80%;
        }

        th {
            height: 70px;
        }

        td {
            text-align: center;

        }

        th {
            background-color: #212529;
        }



        .status-payment {
            background-color: green;
            color: black;
            font-weight: bold;
        }

        .status-order {
            background-color: yellow;
            color: black;
            font-weight: bold;
        }

        .print-button {
            background-color: red;
            color: white;
            font-weight: bold;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .print-button:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>
    <table class="text-center mx-auto">
        <tr class="text-white">
            <th>No.</th>
            <th>Order Code</th>
            <th>Order Date</th>
            <th>Order Amount</th>
            <th>Order Status</th>
            <th>Actions</th>
        </tr>


        <?php
        $orders = [
            ['id' => 1, 'code' => 'AB-2025-01-02', 'date' => '2025-01-02 08:17:11', 'amount' => 56000, 'status' => 'payment'],
            ['id' => 2, 'code' => 'AC-2025-01-02', 'date' => '2025-01-02 08:50:33', 'amount' => 70000, 'status' => 'payment'],
            ['id' => 3, 'code' => 'AD-2025-01-02', 'date' => '2025-01-02 10:50:33', 'amount' => 0, 'status' => 'order'],
            ['id' => 4, 'code' => 'AE-2025-01-02', 'date' => '2025-01-02 15:30:33', 'amount' => 40000, 'status' => 'payment'],
            ['id' => 5, 'code' => 'AF-2025-01-02', 'date' => '2025-01-04 15:30:33', 'amount' => 0, 'status' => 'order'],
        ];
        // SELECT * FROM orders WHERE id = $idP
        $no = 1;
        foreach ($orders as $order) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$order['code']}</td>";
            echo "<td>{$order['date']}</td>";
            echo "<td>Rp. " . number_format($order['amount'], 0, ',', '.') . "</td>";

            // Tampilkan status dengan warna
            if ($order['status'] == 'payment') {
                echo "<td class='status-payment'>Payment</td>";
            } else {
                echo "<td class='status-order'>Order</td>";
                
            }
            ?>
            <!--  Tombol aksi -->
            <td><a href="print.php?idPrint=<?php echo $order['id'] ?>" target="_blank" class="btn btn-danger">PRINT STRUK</a></td>
            <?php
            echo "</tr>";
            $no++;
        }
        
        
           ?>
    </table>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</html>