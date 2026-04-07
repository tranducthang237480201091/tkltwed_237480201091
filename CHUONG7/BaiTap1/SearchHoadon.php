<?php
// Gọi file kết nối CSDL
include 'Connection.php';

// Kiểm tra xem người dùng đã submit form hay chưa (dùng GET)
if (isset($_GET['makh'])) {
    $makh = $_GET['makh'];

    // --- BƯỚC 1: KIỂM TRA KHÁCH HÀNG CÓ TỒN TẠI KHÔNG ---
    $check_kh = "SELECT tenkh FROM khachhang WHERE makh = '$makh'";
    $result_kh = $conn->query($check_kh);

    if ($result_kh->num_rows == 0) {
        echo "<h3 style='color:red;'>Không tìm thấy khách hàng nào có mã: $makh</h3>";
    } else {
        // Lấy tên khách hàng để hiển thị cho đẹp
        $row_kh = $result_kh->fetch_assoc();
        $tenkh = $row_kh['tenkh'];
        
        echo "<h3>Lịch sử mua hàng của khách: <span style='color:blue;'>$tenkh ($makh)</span></h3>";

        // --- BƯỚC 2: TRUY VẤN LỊCH SỬ MUA HÀNG (DÙNG JOIN) ---
        // Lấy Mã HĐ, Tên Hàng Hóa, và Số Lượng
        $sql = "SELECT hoadon.mahd, hanghoa.tenhang, hoadon.soluong 
                FROM hoadon 
                INNER JOIN hanghoa ON hoadon.mahang = hanghoa.mahang 
                WHERE hoadon.makh = '$makh'";
        
        $result = $conn->query($sql);

        // --- BƯỚC 3: HIỂN THỊ KẾT QUẢ RA BẢNG HTML ---
        if ($result->num_rows > 0) {
            echo "<table border='1' cellpadding='10' cellspacing='0'>";
            echo "<tr style='background-color: #f2f2f2;'>
                    <th>Mã Hóa Đơn</th>
                    <th>Tên Mặt Hàng</th>
                    <th>Số Lượng</th>
                  </tr>";
            
            // Dùng vòng lặp while để duyệt qua từng dòng dữ liệu trả về
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['mahd'] . "</td>";
                echo "<td>" . $row['tenhang'] . "</td>";
                echo "<td>" . $row['soluong'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<p>Tổng cộng có <b>" . $result->num_rows . "</b> lượt mua hàng.</p>";
        } else {
            echo "<p>Khách hàng này chưa mua mặt hàng nào.</p>";
        }
    }

    echo "<br><a href='SearchHoadon.html'>Quay lại trang tìm kiếm</a>";
}

$conn->close();
?>