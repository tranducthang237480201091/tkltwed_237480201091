<?php
// Gọi file kết nối CSDL (Lưu ý dùng đúng tên biến $conn như đã sửa ở câu 2)
include 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mahd = $_POST['mahd'];
    $makh = $_POST['makh'];
    $mahang = $_POST['mahang'];
    $soluong = $_POST['soluong'];

    // --- BƯỚC 1: KIỂM TRA ĐIỀU KIỆN (VALIDATION) ---

    // 1. Kiểm tra Khóa ngoại: Khách hàng có tồn tại không?
    $check_makh = "SELECT makh FROM khachhang WHERE makh = '$makh'";
    $result_makh = $conn->query($check_makh);

    // 2. Kiểm tra Khóa ngoại: Hàng hóa có tồn tại không?
    $check_mahang = "SELECT mahang FROM hanghoa WHERE mahang = '$mahang'";
    $result_mahang = $conn->query($check_mahang);

    // 3. Kiểm tra Khóa chính: Chi tiết hóa đơn này đã tồn tại chưa? 
    // (Tránh nhập trùng 1 mặt hàng cho cùng 1 khách trong cùng 1 mã hóa đơn)
    $check_pk = "SELECT * FROM hoadon WHERE mahd = '$mahd' AND makh = '$makh' AND mahang = '$mahang'";
    $result_pk = $conn->query($check_pk);

    // Bắt đầu xét duyệt các lỗi
    if ($result_makh->num_rows == 0) {
        echo "<h3 style='color:red;'>Lỗi: Mã khách hàng '$makh' không tồn tại trong hệ thống!</h3>";
        
    } elseif ($result_mahang->num_rows == 0) {
        echo "<h3 style='color:red;'>Lỗi: Mã hàng hóa '$mahang' không tồn tại trong hệ thống!</h3>";
        
    } elseif ($result_pk->num_rows > 0) {
        echo "<h3 style='color:red;'>Lỗi: Chi tiết hóa đơn này đã tồn tại (Trùng Mã HĐ, Mã KH và Mã Hàng)!</h3>";
        
    } elseif ($soluong <= 0) {
        echo "<h3 style='color:red;'>Lỗi: Số lượng phải lớn hơn 0!</h3>";
        
    } else {
        // --- BƯỚC 2: NẾU VƯỢT QUA HẾT ĐIỀU KIỆN THÌ MỚI INSERT ---
        // Lưu ý: Cột thanhtien mình không insert nên MySQL sẽ tự động gán là NULL theo cấu trúc bảng
        
        $sql = "INSERT INTO hoadon (mahd, makh, mahang, soluong) 
                VALUES ('$mahd', '$makh', '$mahang', $soluong)";

        if ($conn->query($sql) === TRUE) {
            echo "<h3 style='color:green;'>Thêm chi tiết hóa đơn thành công!</h3>";
            echo "<ul>
                    <li>Mã Hóa Đơn: $mahd</li>
                    <li>Mã Khách Hàng: $makh</li>
                    <li>Mã Hàng: $mahang</li>
                    <li>Số lượng: $soluong</li>
                  </ul>";
        } else {
            echo "Lỗi hệ thống: " . $conn->error;
        }
    }
    
    // Nút quay lại trang nhập liệu
    echo "<br><br><a href='InsertHoadon.html'>Quay lại trang nhập hóa đơn</a>";
}

$conn->close();
?>