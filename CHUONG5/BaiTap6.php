<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>tvt_b6</title>

<style>
table {
    border-collapse: collapse;
    margin: auto;
    margin-top: 50px;
}

th, td {
    border: 1px solid black;
    padding: 5px;
    text-align: center;
}
</style>

</head>
<body>

<table>

<tr>
    <th>Số n</th>
    <?php
    for ($n = 0; $n <= 50; $n++) {
        echo "<td>$n</td>";
    }
    ?>
</tr>

<tr>
    <th>Số n<sup>2</sup></th>
    <?php
    for ($n = 0; $n <= 50; $n++) {
        echo "<td>" . ($n * $n) . "</td>";
    }
    ?>
</tr>

</table>

</body>
</html>