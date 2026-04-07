<?php
// Gọi file kết nối CSDL
include 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mahang = $_POST['mahang'];
    $tenhang = $_POST['tenhang'];
    $mansx = $_POST['mansx'];
    $namsx = $_POST['namsx'];
    $gia = $_POST['gia'];

    // --- BƯỚC 1: KIỂM TRA ĐIỀU KIỆN ---

    // Lấy năm hiện tại bằng PHP
    $nam_hientai = date("Y");

    // 1. Kiểm tra mã hàng đã tồn tại chưa (Khóa chính)
    $check_mahang = "SELECT mahang FROM hanghoa WHERE mahang = '$mahang'";
    $result_mahang = $conn->query($check_mahang);

    // 2. Kiểm tra mã nhà sản xuất có tồn tại không (Khóa ngoại)
    $check_mansx = "SELECT mansx FROM nhasanxuat WHERE mansx = '$mansx'";
    $result_mansx = $conn->query($check_mansx);

    // Bắt đầu xét duyệt các lỗi
    if ($result_mahang->num_rows > 0) {
        // num_rows > 0 nghĩa là đã tìm thấy mã hàng này trong CSDL
        echo "<h3 style='color:red;'>Lỗi: Mã hàng '$mahang' đã tồn tại! Vui lòng nhập mã khác.</h3>";
        
    } elseif ($result_mansx->num_rows == 0) {
        // num_rows == 0 nghĩa là không tìm thấy nhà sản xuất này
        echo "<h3 style='color:red;'>Lỗi: Mã nhà sản xuất '$mansx' không tồn tại! Các mã hợp lệ: AS, DE, LE, TO.</h3>";
        
    } elseif ($gia <= 0 || $namsx <= 0) {
        // Kiểm tra số liệu thực tế phải lớn hơn 0
        echo "<h3 style='color:red;'>Lỗi: Giá bán và Năm sản xuất phải lớn hơn 0!</h3>";
        
    } elseif ($namsx > $nam_hientai) {
        // KIỂM TRA MỚI: Năm sản xuất không được lớn hơn năm hiện tại
        echo "<h3 style='color:red;'>Lỗi: Năm sản xuất ($namsx) không hợp lệ! Không thể lớn hơn năm hiện tại ($nam_hientai).</h3>";
        
    } else {
        // --- BƯỚC 2: NẾU VƯỢT QUA HẾT ĐIỀU KIỆN THÌ MỚI INSERT ---
        
        $sql = "INSERT INTO hanghoa (mahang, tenhang, mansx, namsx, gia) 
                VALUES ('$mahang', '$tenhang', '$mansx', $namsx, $gia)";

        if ($conn->query($sql) === TRUE) {
            echo "<h3 style='color:green;'>Thêm dữ liệu hàng hóa thành công!</h3>";
            echo "<ul>
                    <li>Mã hàng: $mahang</li>
                    <li>Tên hàng: $tenhang</li>
                    <li>Nhà SX: $mansx</li>
                    <li>Năm SX: $namsx</li>
                  </ul>";
        } else {
            echo "Lỗi hệ thống: " . $conn->error;
        }
    }
    
    // Nút quay lại trang nhập liệu
    echo "<br><br><a href='InsertHanghoa.html'>Quay lại trang nhập</a>";
}

// Đóng kết nối
$conn->close();
?>