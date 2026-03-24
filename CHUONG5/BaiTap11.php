<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>tvt_b11</title>
</head>

<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input = trim($_POST['mau']);

    // Kiểm tra rỗng
    if ($input == "") {
        echo "Vui lòng nhập màu.<br>";
    }

    else {

        $mau = explode(',', $input);
        $hopLe = true;

        foreach ($mau as $color) {

            $color = trim($color);//khoảng trắng

            // kiểm tra có phải chữ không
            if (!preg_match("/^[a-zA-Z]+$/", $color)) {
                $hopLe = false;
                break;
            }
        }

        if (!$hopLe) {
            echo "Vui lòng nhập đúng tên màu (chỉ chữ, phân cách bằng dấu phẩy).<br>";
        }

        else {

            foreach ($mau as $color) {

                $color = trim($color);

                echo "<p style='color:$color;'>$color</p>";
            }
        }
    }
}

?>

<form method="post">

<br>Nhập các màu (phân cách bởi dấu phẩy): 
<input type="text" name="mau"
value="<?php if(isset($_POST['mau'])) echo $_POST['mau']; ?>">

<input type="submit">

</form>

</body>
</html>