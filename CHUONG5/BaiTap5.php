<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>USCLN và BSCNN</title>

<style>

body{
    font-family: Arial;
}

.khung{
    width:350px;
    border:2px solid black;
    padding:20px;
    margin:auto;
    margin-top:50px;
    text-align:center;
    border-radius:20px; /* bo góc */
    box-shadow: 0 0 10px rgba(0,0,0,0.2); /* đổ bóng */
}

input{
    padding:5px;
    border-radius:8px; /* bo input cho đẹp */
    border:1px solid #ccc;
}

button{
    padding:8px 15px;
    border:none;
    color:white;
    font-weight:bold;
    margin:5px;
    cursor:pointer;
    border-radius:10px; /* bo nút */
}

.uscln{background-color:green;}
.bscnn{background-color:blue;}

button:hover{
    opacity:0.8;
}

</style>
</head>

<body>

<div class="khung">

<h2>TÍNH USCLN - BSCNN</h2>

<form method="post">

Số thứ 1:
<input type="text" name="a" value="<?php echo isset($_POST['a']) ? $_POST['a'] : '' ?>">
<br><br>

Số thứ 2:
<input type="text" name="b" value="<?php echo isset($_POST['b']) ? $_POST['b'] : '' ?>">
<br><br>

Kết quả:
<input type="text" name="kq" value="<?php echo isset($kq) ? $kq : '' ?>" readonly>
<br><br>

<button type="submit" name="opt" value="USCLN" class="uscln">USCLN</button>
<button type="submit" name="opt" value="BSCNN" class="bscnn">BSCNN</button>

</form>

<?php

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $a=$_POST['a'];
    $b=$_POST['b'];
    $opt=$_POST['opt'];
    $kq="";

    if($a=="" || $b=="")
    {
        $kq="Vui lòng nhập đầy đủ";
    }
    elseif(!is_numeric($a) || !is_numeric($b))
    {
        $kq="Phải nhập số";
    }
    else
    {
        $a=abs($a);
        $b=abs($b);

        $x=$a;
        $y=$b;

        while($y!=0)
        {
            $r=$x%$y;
            $x=$y;
            $y=$r;
        }

        $uscln=$x;
        $bscnn=($a*$b)/$uscln;

        switch($opt)
        {
            case "USCLN":
                $kq=$uscln;
                break;

            case "BSCNN":
                $kq=$bscnn;
                break;
        }
    }

    echo "<script>document.getElementsByName('kq')[0].value='$kq';</script>";
}

?>

</div>

</body>
</html>