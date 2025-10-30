<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator Laravel 12</title>
</head>

<body>
    <h1>Calculator</h1>
    <form action="{{ route('calculator.store') }}" method="post">
        @csrf
        <label for="">Value 1</label><br>
        <input type="number" name="value1"><br>

        <select name="simbol" id="" required>
            <option value=""></option>
            <option value="*">*</option>
            <option value="/">/</option>
            <option value="+">+</option>
            <option value="-">-</option>
        </select><br>

        <label for="">Value 2</label><br>
        <input type="number" name="value2"><br>
        <button type="submit">Hitung</button>
    </form>

    <p>Hasilnya Adalah {{ isset($results) ? $results : 0 }}</p>
</body>

</html>
