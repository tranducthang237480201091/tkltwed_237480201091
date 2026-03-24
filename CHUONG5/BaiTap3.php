<?php
    $x = 3;
    $y = 5;
    echo "Câu a <br>";
    echo "Cộng: " . ($x + $y) . "<br>";
    echo "Trừ: " . ($x - $y) . "<br>";
    echo "Nhân: " . ($x * $y) . "<br>";
    echo "Chia: " . ($x / $y) . "<br>";
    echo "Chia dư: " . ($x % $y) . "<br><br>";
?>

<?php
    $x = rand(1,10);
    $y = rand(1,10);
    echo "Câu b <br>";
    echo "x = $x <br>";
    echo "y = $y <br>";
    
    echo "Cộng: " . ($x + $y) . "<br>";
    echo "Trừ: " . ($x - $y) . "<br>";
    echo "Nhân: " . ($x * $y) . "<br>";
    echo "Chia: " . ($x / $y) . "<br>";
    echo "Chia dư: " . ($x % $y) . "<br><br>";
?>

<?php
    do{
        $x = rand(1,10);
        $y = rand(1,10);
    }while($x > $y);
    echo "Câu c <br>";
    echo "x = $x <br>";
    echo "y = $y <br>";
    
    echo "Cộng: " . ($x + $y) . "<br>";
    echo "Trừ: " . ($x - $y) . "<br>";
    echo "Nhân: " . ($x * $y) . "<br>";
    echo "Chia: " . ($x / $y) . "<br>";
    echo "Chia dư: " . ($x % $y) . "<br>";
?>