<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xử lý Ma trận PHP - Auto Random</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { border-collapse: collapse; margin-top: 10px; }
        td { border: 1px solid #333; padding: 10px; text-align: center; }
        .matrix-input { margin: 2px; width: 45px; text-align: center; padding: 5px; }
        .result { margin-top: 15px; padding: 10px; background: #eef; border-left: 5px solid blue; }
        .error { color: red; }
        .btn-rand { background: #17a2b8; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; }
    </style>
</head>
<body>

<?php
// 1. Lấy thông tin cơ bản
$dong = isset($_POST['dong']) ? max(1, intval($_POST['dong'])) : 2;
$cot = isset($_POST['cot']) ? max(1, intval($_POST['cot'])) : 2;
$chucNang = isset($_POST['chucNang']) ? $_POST['chucNang'] : 'print';

// 2. Xử lý tạo ma trận số ngẫu nhiên
if (isset($_POST['btnRand'])) {
    $maTran = [];
    for ($i = 0; $i < $dong; $i++) {
        for ($j = 0; $j < $cot; $j++) {
            $maTran[$i][$j] = rand(1, 100); // Tạo số ngẫu nhiên từ 1-100
        }
    }
} else {
    $maTran = isset($_POST['maTran']) ? $_POST['maTran'] : null;
}

// 3. Các hàm xử lý
function timMax($mt) {
    $max = -PHP_INT_MAX;
    foreach($mt as $h) foreach($h as $v) if($v > $max) $max = $v;
    return $max;
}

function tinhTong($mt) {
    $tong = 0;
    foreach($mt as $h) foreach($h as $v) $tong += $v;
    return $tong;
}

function inMaTran($mt) {
    echo "<table>";
    foreach($mt as $h) {
        echo "<tr>";
        foreach($h as $v) echo "<td>$v</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<h2>Chương trình xử lý Ma trận</h2>

<form method="POST">
    Số dòng: <input type="number" name="dong" value="<?= $dong ?>" min="1" max="10">
    Số cột: <input type="number" name="cot" value="<?= $cot ?>" min="1" max="10">
    
    <button type="submit" name="btnTao">Đổi kích thước</button>
    <button type="submit" name="btnRand" class="btn-rand">Random số (Rand)</button>
    
    <br><br>

    <div id="nhapMaTran">
        <?php 
        for ($i = 0; $i < $dong; $i++) {
            for ($j = 0; $j < $cot; $j++) {
                // Nếu là bấm nút Random thì $maTran đã có số, nếu không thì mặc định là 0
                $val = isset($maTran[$i][$j]) ? $maTran[$i][$j] : 0;
                echo "<input type='text' class='matrix-input' name='maTran[$i][$j]' value='$val'>";
            }
            echo "<br>";
        }
        ?>
    </div>

    <br>
    Thực hiện: 
    <select name="chucNang">
        <option value="max" <?= $chucNang == 'max' ? 'selected' : '' ?>>Tìm Max</option>
        <option value="sum" <?= $chucNang == 'sum' ? 'selected' : '' ?>>Tính Tổng</option>
        <option value="print" <?= $chucNang == 'print' ? 'selected' : '' ?>>In Ma trận</option>
    </select>
    <button type="submit" name="btnTinh">Thực hiện tính</button>
</form>

<?php if (isset($_POST['btnTinh']) && isset($_POST['maTran'])): ?>
    <div class="result">
        <?php
        $mt = $_POST['maTran'];
        $isNumber = true;
        
        // Kiểm tra dữ liệu đầu vào
        foreach ($mt as $h) {
            foreach ($h as $v) {
                if (!is_numeric($v)) { $isNumber = false; break; }
            }
        }

        if (!$isNumber) {
            echo "<span class='error'>Lỗi: Vui lòng nhập số hợp lệ!</span>";
        } else {
            switch ($chucNang) {
                case 'max': echo "Giá trị lớn nhất là: " . timMax($mt); break;
                case 'sum': echo "Tổng ma trận là: " . tinhTong($mt); break;
                case 'print': inMaTran($mt); break;
            }
        }
        ?>
    </div>
<?php endif; ?>

</body>
</html>