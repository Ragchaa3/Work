<?php
// Хариултыг шалгах
if (isset($_POST['answer'])) {
    $answer = $_POST['answer'];
    
    // "poll_results.txt" файлыг уншиж, хадгалах
    $file = fopen("poll_results.txt", "a");
    if ($file) {
        fwrite($file, $answer . "\n");
        fclose($file);
    }
    
    // Санал өгсөн цагийг кукид хадгалах
    setcookie("last_poll_time", time(), time() + 180); // 180 секунд (3 минут)
    
    echo "Санал амжилттай илгээгдлээ.";
} else {
    echo "Санал илгээхэд алдаа гарлаа.";
}
?>
