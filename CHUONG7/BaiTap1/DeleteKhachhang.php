<?php
// Gọi file kết nối CSDL
include 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $makh = $_POST['makh'];

    // --- BƯỚC 1: KIỂM TRA ĐIỀU KIỆN TRƯỚC KHI XÓA ---

    // 1. Kiểm tra xem mã khách hàng này có tồn tại không?
    $check_exist = "SELECT makh, tenkh FROM khachhang WHERE makh = '$makh'";
    $result_exist = $conn->query($check_exist);

    if ($result_exist->num_rows == 0) {
        // Không tìm thấy khách hàng
        echo "<h3 style='color:red;'>Lỗi: Không tìm thấy khách hàng có mã '$makh' để xóa!</h3>";
    } else {
        // Lấy tên khách hàng để in ra thông báo cho trực quan
        $row = $result_exist->fetch_assoc();
        $tenkh = $row['tenkh'];

        // 2. Kiểm tra xem khách hàng này đã có hóa đơn chưa? (Ràng buộc khóa ngoại)
        $check_hoadon = "SELECT makh FROM hoadon WHERE makh = '$makh'";
        $result_hoadon = $conn->query($check_hoadon);

        if ($result_hoadon->num_rows > 0) {
            // Khách hàng đã có hóa đơn -> Báo lỗi không cho xóa
            echo "<h3 style='color:red;'>Lỗi: Không thể xóa khách hàng '$tenkh' ($makh)!</h3>";
            echo "<p>Lý do: Khách hàng này đã có dữ liệu trong bảng Hóa Đơn. Bạn cần xóa các hóa đơn của người này trước khi xóa thông tin khách hàng.</p>";
        } else {
            // --- BƯỚC 2: NẾU HỢP LỆ THÌ THỰC THI LỆNH DELETE ---
            
            $sql_delete = "DELETE FROM khachhang WHERE makh = '$makh'";
            
            if ($conn->query($sql_delete) === TRUE) {
                echo "<h3 style='color:green;'>Đã xóa thành công khách hàng: $tenkh ($makh)</h3>";
            } else {
                echo "Lỗi hệ thống khi xóa: " . $conn->error;
            }
        }
    }

    // Nút quay lại
    echo "<br><br><a href='DeleteKhachhang.html'>Quay lại trang xóa</a>";
}

$conn->close();
?>