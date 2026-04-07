<?php
include 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bang = $_POST['bang_du_lieu'];

    // Tiêu đề bảng
    $tieu_de = "";
    if ($bang == 'hanghoa') $tieu_de = "DANH SÁCH HÀNG HÓA";
    elseif ($bang == 'khachhang') $tieu_de = "DANH SÁCH KHÁCH HÀNG";
    elseif ($bang == 'nhasanxuat') $tieu_de = "DANH SÁCH NHÀ SẢN XUẤT";
    elseif ($bang == 'hoadon') $tieu_de = "DANH SÁCH HÓA ĐƠN";

    echo "<h3 style='text-align: center;'>$tieu_de</h3>";
    echo "<table border='1' cellpadding='8' cellspacing='0' style='margin: 0 auto; text-align: center;'>";

    // Xử lý truy vấn tùy theo bảng được chọn
    switch ($bang) {
        case 'hanghoa':
            echo "<tr style='background-color: #e0e0e0;'>
                    <th>Mã hàng</th><th>Tên hàng</th><th>mansx</th><th>namsx</th><th>gia</th>
                  </tr>";
            $sql = "SELECT * FROM hanghoa";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['mahang']}</td>
                        <td>{$row['tenhang']}</td>
                        <td>{$row['mansx']}</td>
                        <td>{$row['namsx']}</td>
                        <td>{$row['gia']}</td>
                      </tr>";
            }
            echo "</table>";

            // -- PHẦN THỐNG KÊ CHO BẢNG HÀNG HÓA (GIỐNG HÌNH 7.4) --
            echo "<div style='width: 500px; margin: 20px auto; border: 1px solid black; padding: 10px;'>";
            
            // Đếm tổng số mặt hàng
            $tong_sql = "SELECT COUNT(*) as tong FROM hanghoa";
            $tong_kq = $conn->query($tong_sql)->fetch_assoc();
            echo "Danh sách gồm có <b>" . $tong_kq['tong'] . "</b> mặt hàng, trong đó:<br>";

            // Đếm số lượng theo từng nhà sản xuất (Dùng GROUP BY và JOIN)
            $nhom_sql = "SELECT nhasanxuat.tennsx, COUNT(hanghoa.mahang) as soluong 
                         FROM hanghoa 
                         JOIN nhasanxuat ON hanghoa.mansx = nhasanxuat.mansx 
                         GROUP BY hanghoa.mansx";
            $nhom_kq = $conn->query($nhom_sql);
            while($row_nhom = $nhom_kq->fetch_assoc()) {
                echo "Nhà sản xuất " . $row_nhom['tennsx'] . " có: " . $row_nhom['soluong'] . "<br>";
            }
            echo "</div>";
            break;

        case 'khachhang':
            echo "<tr style='background-color: #e0e0e0;'>
                    <th>Mã KH</th><th>Tên KH</th><th>Năm sinh</th><th>Điện thoại</th><th>Địa chỉ</th>
                  </tr>";
            $sql = "SELECT * FROM khachhang";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['makh']}</td><td>{$row['tenkh']}</td><td>{$row['namsinh']}</td><td>{$row['dienthoai']}</td><td>{$row['diachi']}</td></tr>";
            }
            echo "</table>";
            break;

        case 'nhasanxuat':
            echo "<tr style='background-color: #e0e0e0;'>
                    <th>Mã NSX</th><th>Tên NSX</th><th>Quốc gia</th>
                  </tr>";
            $sql = "SELECT * FROM nhasanxuat";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['mansx']}</td><td>{$row['tennsx']}</td><td>{$row['quocgia']}</td></tr>";
            }
            echo "</table>";
            break;

        case 'hoadon':
            echo "<tr style='background-color: #e0e0e0;'>
                    <th>Mã HĐ</th><th>Mã KH</th><th>Mã hàng</th><th>Số lượng</th>
                  </tr>";
            $sql = "SELECT * FROM hoadon";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['mahd']}</td><td>{$row['makh']}</td><td>{$row['mahang']}</td><td>{$row['soluong']}</td></tr>";
            }
            echo "</table>";
            break;
    }

    echo "<div style='text-align: center; margin-top: 20px;'><a href='List.html'>Quay lại chọn bảng khác</a></div>";
}

$conn->close();
?>