<!DOCTYPE html>
<html>
<head>
    <title>Санал асуулга</title>
    <!-- Bootstrap сангийн холбоосуудыг оруулах -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <?php
    // poll.txt файлыг уншиж, санал асуулгыг үзүүлэх
    $lines = file("poll.txt", FILE_IGNORE_NEW_LINES);
    echo "<h1>".$lines[0]."</h1>";
    echo "<form method='post'>";

    for ($i = 1; $i <= 3; $i++) {
        echo "<div class='form-check'>";
        echo "<input type='radio' class='form-check-input' name='answer' value='$i' id='answer$i'>";
        echo "<label class='form-check-label' for='answer$i'>".$lines[$i]."</label>";
        echo "</div>";
    }
    echo "<input type='submit' name='submit' value='Санал өгөх' class='btn btn-primary'>";
    echo "</form>";
    ?>
    <?php

    if (isset($_POST['answer']) && isset($_POST['submit'])) {
        $selectedAnswer = $_POST['answer'];
        $pollName = 'poll_form';
        if (!isset($_COOKIE[$pollName])) {
            setcookie($pollName, 'submitted', time() + 180); // 3 минут хугацаанд нэг удаа
            echo "<div class='alert alert-success'>Санал амжилттай илгээгдлээ</div>";
            // Саналыг файлд хадгалах
            $file = fopen("poll_results.txt", "a");
            if ($file) {
                fwrite($file, $selectedAnswer . "\n");
                fclose($file);
            }
        } else {
            echo "<div class='alert alert-danger'>3 минутын дотор дахин санал өгөх боломжгүй</div>";
        }
    }
    ?>
    <?php
    // "poll_results.txt" файлыг унших
    $pollResults = file("poll_results.txt", FILE_IGNORE_NEW_LINES);
    $totalVotes = count($pollResults);
    echo "<p class='mt-3'>Нийт саналын тоо: $totalVotes</p>";
    ?>
</div>
</body>
</html>
