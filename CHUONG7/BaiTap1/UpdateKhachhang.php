<?php
// Nhúng file kết nối (Dùng biến $conn như đã thống nhất ở các câu trước)
include 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $makh = $_POST['makh'];
    $tenkh = $_POST['tenkh'];
    $namsinh = $_POST['namsinh'];
    $dienthoai = $_POST['dienthoai'];
    $diachi = $_POST['diachi'];

    // Lấy năm hiện tại để kiểm tra logic năm sinh
    $nam_hientai = date("Y");

    // --- BƯỚC 1: KIỂM TRA ĐIỀU KIỆN ---

    // Kiểm tra xem mã khách hàng này có thực sự tồn tại trong CSDL không?
    $check_makh = "SELECT makh FROM khachhang WHERE makh = '$makh'";
    $result = $conn->query($check_makh);

    // Xét duyệt các trường hợp lỗi
    if ($result->num_rows == 0) {
        // Không tìm thấy mã KH trong bảng khachhang
        echo "<h3 style='color:red;'>Lỗi: Không tìm thấy khách hàng có mã '$makh' trong hệ thống!</h3>";
        echo "<p>Vui lòng kiểm tra lại mã khách hàng.</p>";

    } elseif ($namsinh > $nam_hientai || $namsinh < 1900) {
        // Kiểm tra năm sinh hợp lý (không lớn hơn năm hiện tại và không quá cũ)
        echo "<h3 style='color:red;'>Lỗi: Năm sinh ($namsinh) không hợp lệ!</h3>";

    } else {
        // --- BƯỚC 2: NẾU HỢP LỆ THÌ THỰC THI LỆNH UPDATE ---
        
        $sql = "UPDATE khachhang 
                SET tenkh='$tenkh', namsinh=$namsinh, dienthoai='$dienthoai', diachi='$diachi' 
                WHERE makh='$makh'";

        if ($conn->query($sql) === TRUE) {
            echo "<h3 style='color:green;'>Cập nhật thông tin khách hàng thành công!</h3>";
            echo "<ul>
                    <li>Mã KH đã cập nhật: <b>$makh</b></li>
                    <li>Tên mới: $tenkh</li>
                    <li>SĐT mới: $dienthoai</li>
                    <li>Địa chỉ mới: $diachi</li>
                  </ul>";
        } else {
            echo "Lỗi hệ thống trong quá trình cập nhật: " . $conn->error;
        }
    }

    // Nút quay lại
    echo "<br><br><a href='UpdateKhachhang.html'>Quay lại trang cập nhật</a>";
}

// Đóng kết nối
$conn->close();
?>