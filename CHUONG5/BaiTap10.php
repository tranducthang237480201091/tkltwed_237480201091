<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>tvt_b10</title>
</head>

<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input = trim($_POST['numbers']);

    // Kiểm tra rỗng
    if ($input == "") {
        echo "Vui lòng nhập mảng số.<br>";
    }

    else {

        $soNguyen = explode(' ', $input);

        $hopLe = true;

        // kiểm tra từng phần tử có phải số không
        foreach ($soNguyen as $so) {
            if (!is_numeric($so)) {
                $hopLe = false;
                break;
            }
        }

        if (!$hopLe) {
            echo "Vui lòng nhập đúng số nguyên.<br>";
        }

        else {

            echo "Mảng: [" . implode(" ", $soNguyen) . "].<br>";

            // đếm số chẵn
            $demSoChan = 0;
            foreach ($soNguyen as $so) {
                if ($so % 2 == 0) {
                    $demSoChan++;
                }
            }
            echo "Đếm số chẵn: " . $demSoChan . ".<br>";

            // tổng số lẻ
            $tongSoLe = 0;
            foreach ($soNguyen as $so) {
                if ($so % 2 != 0) {
                    $tongSoLe += $so;
                }
            }
            echo "Tổng số lẻ: " . $tongSoLe . ".<br>";

            // max min
            echo "Giá trị lớn nhất: " . max($soNguyen) . ".<br>";
            echo "Giá trị nhỏ nhất: " . min($soNguyen) . ".<br>";

            // đảo ngược
            $daoNguoc = array_reverse($soNguyen);
            echo "Mảng đảo ngược: [" . implode(" ", $daoNguoc) . "].<br>";
        }
    }
}

?>

<form method="post">

<br>Nhập mảng các số nguyên (phân cách bởi khoảng trắng):
<input type="text" name="numbers"
value="<?php if(isset($_POST['numbers'])) echo $_POST['numbers']; ?>">

<input type="submit">

</form>

</body>
</html>