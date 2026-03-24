<?php
if(isset($_POST["hienthi"])){

$hoten = $_POST["txtHoTen"];
$ngaysinh = $_POST["txtNgaySinh"];
$lop = $_POST["txtLop"];
$diem = $_POST["txtDiem"];

echo "Họ và tên: $hoten <br>";
echo "Ngày sinh: $ngaysinh <br>";
echo "Lớp: $lop <br>";
echo "Điểm: $diem";

}
?>