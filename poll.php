<!DOCTYPE html>
<html>
<head>
    <title>Санал асуулга</title>
</head>
<body>
<?php
    // Санал өгсөн эсэхийг шалгах
    if (isset($_COOKIE['last_poll_time'])) {
        $last_poll_time = $_COOKIE['last_poll_time'];
        $current_time = time();
        $time_difference = $current_time - $last_poll_time;

        if ($time_difference < 180) {
            echo "Дахин санал өгөх боломжгүй";
        }
    }

    // poll.txt файлыг уншиж, санал асуулгыг үзүүлэх
    $lines = file("poll.txt", FILE_IGNORE_NEW_LINES);
    
    // Санал асуулгыг үзүүлэх
    echo "<h1>".$lines[0]."</h1>";
    echo "<form method='post' action='submit_poll.php'>";
    
    // Хариултуудыг үзүүлэх
    for ($i = 1; $i <= 3; $i++) {
        echo "<input type='radio' name='answer' value='$i'>".$lines[$i]."<br>";
    }
    
    // Санал өгсөн тоог файлын харгалзах талбарт хадгалах
    echo "<input type='submit' value='Санал өгөх'>";
    
    echo "</form>";
    ?>
</body>
</html>
