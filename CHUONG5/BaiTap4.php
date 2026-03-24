<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tvt_bt4</title>
    <style>
    .khung{
        width:350px;
        border:2px solid black;
        padding:20px;
        margin:auto;
        margin-top:50px;
        text-align:center;
        border-radius:20px; /* bo góc */
        box-shadow: 0 0 10px rgba(0,0,0,0.2); /* đổ bóng */
    }
    </style>
</head>
<body>
    <div class="khung">
    <h1>TÍNH TOÁN SỐ HỌC</h1>
    <hr color="black" size="3">
    <form method="post">
        Số thứ 1: <input type="text" name="num1" value="<?php echo isset($_POST['num1']) ? $_POST['num1'] : '' ?>"> <br><br>
        Số thứ 2: <input type="text" name="num2" value="<?php echo isset($_POST['num2']) ? $_POST['num2'] : '' ?>"> <br><br>
        Kết quả: <input type="text" name="kq" value="<?php echo isset($kq) ? $kq : '' ?>" readonly> <br><br>
        <div class="buttons">
            <input style="background-color: green; color:azure" type="submit" name="opt" value="Cộng">
            <input style="background-color: green; color:azure" type="submit" name="opt" value="Trừ">
            <input style="background-color: green; color:azure" type="submit" name="opt" value="Nhân">
            <input style="background-color: green; color:azure" type="submit" name="opt" value="Chia">
            <input style="background-color: green; color:azure" type="submit" name="opt" value="Mod">
        </div>
    </form>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $opt = $_POST['opt'];
    $kq = "";

    if ($num1 == "" || $num2 == "") {
        $kq = "Vui lòng nhập đầy đủ 2 số";
    }
    elseif (!is_numeric($num1) || !is_numeric($num2)) {
        $kq = "Phải nhập số";
    }
    else {

        $num1 = floatval($num1);
        $num2 = floatval($num2);

        switch ($opt) {
            case 'Cộng':
                $kq = $num1 + $num2;
                break;
            case 'Trừ':
                $kq = $num1 - $num2;
                break;
            case 'Nhân':
                $kq = $num1 * $num2;
                break;
            case 'Chia':
                if ($num2 == 0) {
                    $kq = "Không thể chia cho 0";
                } else {
                    $kq = $num1 / $num2;
                }
                break;
            case 'Mod':
                if ($num2 == 0) {
                    $kq = "Không thể chia cho 0";
                } else {
                    $kq = $num1 % $num2;
                }
                break;
        }
    }

    echo "<script>document.getElementsByName('kq')[0].value = '$kq';</script>";
}
?>
    </div>
</body>
</html>